<x-layout :navbar="true">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h2>
    {{-- <h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Overview</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded shadow border-l-4 border-blue-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase">Total Customers</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCustomers ?? 0 }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow border-l-4 border-green-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase">Total Invoices</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalInvoices ?? 0 }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow border-l-4 border-purple-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase">Revenue</h3>
            <p class="text-3xl font-bold text-gray-800 mt-2">${{ number_format($totalRevenue ?? 0, 2) }}</p>
        </div>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Latest Invoices</h3>
        @if(isset($latestInvoices) && count($latestInvoices) > 0)
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="pb-2">ID</th>
                        <th class="pb-2">Customer</th>
                        <th class="pb-2">Date</th>
                        <th class="pb-2">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestInvoices as $inv)
                        <tr class="border-b last:border-0 hover:bg-gray-50">
                            <td class="py-2">#{{ $inv->id }}</td>
                            <td class="py-2">{{ $inv->customer->name }}</td>
                            <td class="py-2">{{ $inv->invoice_date }}</td>
                            <td class="py-2 font-bold">${{ number_format($inv->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No invoices generated yet.</p>
        @endif
    </div> --}}
</x-layout>