<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Replaces the list view
    public function index()
    {
        $invoices = Invoice::with('customer')->latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    // Replaces invoice-create.php (The Form)
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('invoices.create', compact('customers', 'products'));
    }

    // Handles the form submission (POST)
    public function store(Request $request)
    {
        // 1. Create Invoice
        $invoice = Invoice::create([
            'customer_id' => $request->customer_id,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'subtotal' => $request->subtotal,
            'tax' => $request->tax,
            'discount' => $request->discount,
            'total' => $request->total,
        ]);

        // 2. Create Invoice Items
        foreach ($request->items as $item) {
            $invoice->items()->create($item);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created!');
    }
    
    // Replaces the PDF generation logic
    public function download($id)
    {
         $invoice = Invoice::with('items', 'customer')->findOrFail($id);
         // Note: Install "barryvdh/laravel-dompdf" for this to work
         $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
         return $pdf->download('invoice-'.$invoice->id.'.pdf');
    }
}
