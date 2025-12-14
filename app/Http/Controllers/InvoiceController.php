<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Replaces the PDF generation logic
    /* public function download($id)
    {
         $invoice = Invoice::with('items', 'customer')->findOrFail($id);
         // Note: Install "barryvdh/laravel-dompdf" for this to work
         $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
         return $pdf->download('invoice-'.$invoice->id.'.pdf');
    }  */
}
