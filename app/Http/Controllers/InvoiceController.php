<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use App\Models\StoreCustomer;
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

        $products = Product::all();
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
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_address_1' => 'required|string',
            'customer_address_2' => 'nullable|string',
            'customer_town' => 'required|string',
            'customer_county' => 'required|string',
            'customer_postcode' => 'required|string',

            // Customer shipping
            'customer_name_ship' => 'required|string|max:255',
            'customer_address_1_ship' => 'required|string',
            'customer_address_2_ship' => 'nullable|string',
            'customer_town_ship' => 'required|string',
            'customer_county_ship' => 'required|string',
            'customer_postcode_ship' => 'required|string',

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
            'shipping' => 'nullable|numeric|min:0',
            'vat' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'custom_email' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Create Invoice
            $invoice = Invoice::create([
                'invoice' => $validated['invoice_number'],
                'custom_email' => $validated['custom_email'] ?? null,
                'invoice_date' => $validated['invoice_date'],
                'invoice_due_date' => $validated['invoice_due_date'],
                'subtotal' => $validated['subtotal'],
                'shipping' => $validated['shipping'] ?? 0,
                'discount' => $validated['discount'] ?? 0,
                'vat' => $validated['vat'] ?? 0,
                'total' => $validated['total'],
                'notes' => $validated['notes'] ?? null,
                'invoice_type' => $validated['invoice_type'],
                'status' => $validated['invoice_status'],
            ]);

            // Create Customer
            Customer::create([
                'invoice' => $validated['invoice_number'],
                'name' => $validated['customer_name'],
                'email' => $validated['customer_email'],
                'address_1' => $validated['customer_address_1'],
                'address_2' => $validated['customer_address_2'] ?? null,
                'town' => $validated['customer_town'],
                'county' => $validated['customer_county'],
                'postcode' => $validated['customer_postcode'],
                'phone' => $validated['customer_phone'],
                'name_ship' => $validated['customer_name_ship'],
                'address_1_ship' => $validated['customer_address_1_ship'],
                'address_2_ship' => $validated['customer_address_2_ship'] ?? null,
                'town_ship' => $validated['customer_town_ship'],
                'county_ship' => $validated['customer_county_ship'],
                'postcode_ship' => $validated['customer_postcode_ship'],
            ]);

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
            }

            DB::commit();

            // TODO: Generate PDF here (we'll add this later)

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
        $products = Product::all();
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
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'customer_address_1' => 'required|string',
            'customer_address_2' => 'nullable|string',
            'customer_town' => 'required|string',
            'customer_county' => 'required|string',
            'customer_postcode' => 'required|string',

            // Customer shipping
            'customer_name_ship' => 'required|string|max:255',
            'customer_address_1_ship' => 'required|string',
            'customer_address_2_ship' => 'nullable|string',
            'customer_town_ship' => 'required|string',
            'customer_county_ship' => 'required|string',
            'customer_postcode_ship' => 'required|string',

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
            'shipping' => 'nullable|numeric|min:0',
            'vat' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
            'custom_email' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Update Invoice
            $invoice->update([
                'custom_email' => $validated['custom_email'] ?? null,
                'invoice_date' => $validated['invoice_date'],
                'invoice_due_date' => $validated['invoice_due_date'],
                'subtotal' => $validated['subtotal'],
                'shipping' => $validated['shipping'] ?? 0,
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
                'address_1' => $validated['customer_address_1'],
                'address_2' => $validated['customer_address_2'] ?? null,
                'town' => $validated['customer_town'],
                'county' => $validated['customer_county'],
                'postcode' => $validated['customer_postcode'],
                'phone' => $validated['customer_phone'],
                'name_ship' => $validated['customer_name_ship'],
                'address_1_ship' => $validated['customer_address_1_ship'],
                'address_2_ship' => $validated['customer_address_2_ship'] ?? null,
                'town_ship' => $validated['customer_town_ship'],
                'county_ship' => $validated['customer_county_ship'],
                'postcode_ship' => $validated['customer_postcode_ship'],
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
            }

            DB::commit();

            // TODO: Regenerate PDF here

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

        // Delete related records (cascade)
        $invoice->customer()->delete();
        $invoice->items()->delete();
        $invoice->delete();

        // TODO: Delete PDF file if exists

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice has been deleted successfully!');
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
            'Shipping',
            'VAT',
            'Total',
        ]);

        // CSV Data
        foreach ($invoices as $invoice) {
            fputcsv($handle, [
                $invoice->invoice,
                $invoice->customer->name ?? 'N/A',
                $invoice->customer->email ?? 'N/A',
                $invoice->invoice_date,
                $invoice->invoice_due_date,
                ucfirst($invoice->invoice_type),
                ucfirst($invoice->status),
                $invoice->subtotal,
                $invoice->discount,
                $invoice->shipping,
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
        // TODO: Implement PDF generation
        return redirect()->back()->with('info', 'PDF generation coming soon!');
    }

    /**
     * Send invoice via email
     */
    public function sendEmail($id)
    {
        // TODO: Implement email sending
        return redirect()->back()->with('info', 'Email sending coming soon!');
    }
}
