<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\StoreCustomer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices
     */
    public function index()
    {
        $invoices = Invoice::with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new invoice
     */
    public function create()
    {
        // Get next invoice number
        $lastInvoice = Invoice::orderBy('invoice', 'desc')->first();
        $nextInvoiceNumber = $lastInvoice ? (int) $lastInvoice->invoice + 1 : 1;

        // $products = Product::all();
        $products = Product::with('category')
            ->where('quantity', '>', 0)  // Optional: only show in-stock items
            ->orderBy('product_name')
            ->get();
        $customers = StoreCustomer::all();

        return view('invoices.create', compact('nextInvoiceNumber', 'products', 'customers'));
    }

    /**
     * Store a newly created invoice
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_number' => 'required|string|unique:invoices,invoice',
            'invoice_date' => 'required|string',
            'invoice_due_date' => 'required|string',
            'invoice_type' => 'required|in:invoice,quote,receipt',
            'invoice_status' => 'required|in:open,paid',

            // Customer billing
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'required|string',
            'customer_address' => 'nullable|string',

            // Invoice items
            'products' => 'required|array|min:1',
            'products.*.name' => 'required|string',
            'products.*.qty' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.discount' => 'nullable|string',
            'products.*.subtotal' => 'required|numeric|min:0',

            // Invoice totals
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'vat' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            // 'custom_email' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Create Invoice
            $invoice = Invoice::create([
                'invoice' => $validated['invoice_number'],
                // 'custom_email' => $validated['custom_email'] ?? null,
                'invoice_date' => $validated['invoice_date'],
                'invoice_due_date' => $validated['invoice_due_date'],
                'subtotal' => $validated['subtotal'],
                'discount' => $validated['discount'] ?? 0,
                'vat' => $validated['vat'] ?? 0,
                'total' => $validated['total'],
                'notes' => $validated['notes'] ?? null,
                'invoice_type' => $validated['invoice_type'],
                'status' => $validated['invoice_status'],
                'user_id' => auth()->id(),
            ]);
            
            // Create Customer
            Customer::create([
                'invoice' => $validated['invoice_number'],
                'name' => $validated['customer_name'],
                'phone' => $validated['customer_phone'],
                'email' => $validated['customer_email'],
                'address' => $validated['customer_address'],
            ]);
            
            // Check inventory availability
            foreach ($validated['products'] as $productData) {
                $product = Product::where('product_name', $productData['name'])->first();

                if ($product) {
                    if ($product->quantity < $productData['qty']) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->with('error', "Insufficient stock for {$product->product_name}. Available: {$product->quantity}, Requested: {$productData['qty']}");
                    }
                }
            }

            // Create Invoice Items
            foreach ($validated['products'] as $product) {
                InvoiceItem::create([
                    'invoice' => $validated['invoice_number'],
                    'product' => $product['name'],
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                    'discount' => $product['discount'] ?? null,
                    'subtotal' => $product['subtotal'],
                ]);
                // Reduce product quantity
                $product = Product::where('product_name', $productData['name'])->first();
                if ($product) {
                    $product->decrement('quantity', $productData['qty']);
                }
            }

            DB::commit();

            return redirect()->route('invoices.index')
                ->with('success', 'Invoice has been created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create invoice: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing an invoice
     */
    public function edit($id)
    {
        $invoice = Invoice::with(['customer', 'items'])->where('id', $id)->firstOrFail();
        // $products = Product::all();
        $products = Product::with('category')->get();
        ;
        $customers = StoreCustomer::all();

        return view('invoices.edit', compact('invoice', 'products', 'customers'));
    }

    /**
     * Update the specified invoice
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $validated = $request->validate([
            'invoice_date' => 'required|string',
            'invoice_due_date' => 'required|string',
            'invoice_type' => 'required|in:invoice,quote,receipt',
            'invoice_status' => 'required|in:open,paid',

            // Customer billing
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'nullable|email',
            'customer_phone' => 'required|string',
            'customer_address' => 'nullable|string',

            // Invoice items
            'products' => 'required|array|min:1',
            'products.*.name' => 'required|string',
            'products.*.qty' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.discount' => 'nullable|string',
            'products.*.subtotal' => 'required|numeric|min:0',

            // Invoice totals
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'vat' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Restore old inventory quantities
            foreach ($invoice->items as $oldItem) {
                $product = Product::where('product_name', $oldItem->product)->first();
                if ($product) {
                    $product->increment('quantity', $oldItem->qty);
                }
            }

            // Check new inventory availability
            foreach ($validated['products'] as $productData) {
                $product = Product::where('product_name', $productData['name'])->first();

                if ($product) {
                    if ($product->quantity < $productData['qty']) {
                        DB::rollBack();
                        return redirect()->back()
                            ->withInput()
                            ->with('error', "Insufficient stock for {$product->product_name}. Available: {$product->quantity}, Requested: {$productData['qty']}");
                    }
                }
            }

            // Update Invoice
            $invoice->update([
                'invoice_date' => $validated['invoice_date'],
                'invoice_due_date' => $validated['invoice_due_date'],
                'subtotal' => $validated['subtotal'],
                'discount' => $validated['discount'] ?? 0,
                'vat' => $validated['vat'] ?? 0,
                'total' => $validated['total'],
                'notes' => $validated['notes'] ?? null,
                'invoice_type' => $validated['invoice_type'],
                'status' => $validated['invoice_status'],
            ]);

            // Update Customer
            $invoice->customer->update([
                'name' => $validated['customer_name'],
                'email' => $validated['customer_email'],
                'phone' => $validated['customer_phone'],
                'address' => $validated['customer_address'],
            ]);

            // Delete old items and create new ones
            $invoice->items()->delete();

            foreach ($validated['products'] as $product) {
                InvoiceItem::create([
                    'invoice' => $invoice->invoice,
                    'product' => $product['name'],
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                    'discount' => $product['discount'] ?? null,
                    'subtotal' => $product['subtotal'],
                ]);
                // Reduce product quantity
                $product = Product::where('product_name', $productData['name'])->first();
                if ($product) {
                    $product->decrement('quantity', $productData['qty']);
                }
            }

            DB::commit();

            return redirect()->route('invoices.index')
                ->with('success', 'Invoice has been updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update invoice: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified invoice
     */
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        DB::beginTransaction();

        try {
            // Restore inventory before deleting
            foreach ($invoice->items as $item) {
                $product = Product::where('product_name', $item->product)->first();
                if ($product) {
                    $product->increment('quantity', $item->qty);
                }
            }

            // Delete related records
            $invoice->customer()->delete();
            $invoice->items()->delete();
            $invoice->delete();

            DB::commit();

            return redirect()->route('invoices.index')
                ->with('success', 'Invoice has been deleted and inventory restored!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', 'Failed to delete invoice: ' . $e->getMessage());
        }
    }

    /**
     * Download CSV of all invoices
     */
    public function downloadCsv()
    {
        $invoices = Invoice::with('customer')->get();

        $filename = 'invoices-' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // CSV Headers
        fputcsv($handle, [
            'Invoice Number',
            'Customer Name',
            'Customer Email',
            'Invoice Date',
            'Due Date',
            'Type',
            'Status',
            'Subtotal',
            'Discount',
            'VAT',
            'Total',
        ]);

        // CSV Data
        foreach ($invoices as $invoice) {
            fputcsv($handle, [
                $invoice->invoice,
                $invoice->customer->name ?? 'N/A',
                $invoice->invoice_date,
                $invoice->invoice_due_date,
                ucfirst($invoice->invoice_type),
                ucfirst($invoice->status),
                $invoice->subtotal,
                $invoice->discount,
                $invoice->vat,
                $invoice->total,
            ]);
        }

        fclose($handle);
        exit;
    }

    /**
     * Generate PDF for invoice
     */
    public function generatePdf($id)
    {
        // return redirect()->back()->with('info', 'PDF generation coming soon!');
        // $invoice = Invoice::with(['customer', 'items'])->findOrFail($id);
        $invoice = Invoice::with(['customer', 'items', 'user'])->findOrFail($id);

        // Generate PDF
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));

        // Download PDF
        return $pdf->download('invoice-' . $invoice->invoice . '.pdf');
    }
}
