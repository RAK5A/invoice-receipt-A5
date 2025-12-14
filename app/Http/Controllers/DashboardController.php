<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\StoreCustomer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Calculate statistics
        $salesAmount = Invoice::where('status', 'paid')->sum('total');
        $totalInvoices = Invoice::count();
        $pendingBills = Invoice::where('status', 'open')->count();
        $dueAmount = Invoice::where('status', 'open')->sum('total');
        $totalProducts = Product::count();
        $totalCustomers = StoreCustomer::count();
        $paidBills = Invoice::where('status', 'paid')->count();

        // Recent invoices
        $recentInvoices = Invoice::with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'salesAmount',
            'totalInvoices',
            'pendingBills',
            'dueAmount',
            'totalProducts',
            'totalCustomers',
            'paidBills',
            'recentInvoices'
            // return view('dashboard.index');
        ));
    }
}
