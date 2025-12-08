{{-- @extends('layouts.app')

@section('content')
<h2>Create New Invoice</h2>
<form action="{{ route('invoices.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <label>Customer</label>
            <select name="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label>Date</label>
            <input type="date" name="invoice_date" class="form-control" required>
        </div>
    </div>

    <table class="table mt-4" id="invoiceTable">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th><button type="button" class="btn btn-sm btn-success" id="addRow">+</button></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="product_name[]" class="form-control" required></td>
                <td><input type="number" name="quantity[]" class="form-control qty" required></td>
                <td><input type="number" step="0.01" name="price[]" class="form-control price" required></td>
                <td><input type="number" step="0.01" name="row_total[]" class="form-control total" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm removeRow">x</button></td>
            </tr>
        </tbody>
    </table>

    <div class="row justify-content-end">
        <div class="col-md-4">
            <label>Subtotal</label>
            <input type="number" name="subtotal" id="subtotal" class="form-control" readonly>
            <label>Tax</label>
            <input type="number" name="tax" class="form-control">
            <label>Total</label>
            <input type="number" name="total" id="finalTotal" class="form-control" readonly>
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Save Invoice</button>
</form>

@push('scripts')
<script>
    // Add simple JS here to handle row addition and calculation
    // You can adapt the code from the original `scripts.js`
    $(document).ready(function () {
        $('#addRow').click(function () {
            // Logic to append a new tr to tbody
        });
        // Logic to calculate totals on change of .qty or .price
    });
</script>
@endpush
@endsection --}}

@push('scripts')
    <script>
        $(document).ready(function () {

            // 1. Function to fetch a new row html
            function getNewRow() {
                return `<tr>
                <td><input type="text" name="product_name[]" class="form-control" required></td>
                <td><input type="number" name="quantity[]" class="form-control qty" value="1" required></td>
                <td><input type="number" step="0.01" name="price[]" class="form-control price" value="0.00" required></td>
                <td><input type="number" step="0.01" class="form-control total" value="0.00" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm removeRow">x</button></td>
            </tr>`;
            }

            // 2. Add Row Event
            $('#addRow').click(function () {
                $('#invoiceTable tbody').append(getNewRow());
            });

            // 3. Remove Row Event
            $(document).on('click', '.removeRow', function () {
                $(this).closest('tr').remove();
                calcTotals(); // Recalculate after deleting
            });

            // 4. Calculation Logic
            $('#invoiceTable').on('keyup change', '.qty, .price', function () {
                var row = $(this).closest('tr');
                var qty = parseFloat(row.find('.qty').val()) || 0;
                var price = parseFloat(row.find('.price').val()) || 0;
                var total = qty * price;

                row.find('.total').val(total.toFixed(2));
                calcTotals();
            });

            // 5. Grand Total Calculation
            function calcTotals() {
                var subtotal = 0;
                $('.total').each(function () {
                    subtotal += parseFloat($(this).val()) || 0;
                });

                $('#subtotal').val(subtotal.toFixed(2));

                var tax = parseFloat($('input[name="tax"]').val()) || 0; // Tax amount, not percent
                var discount = parseFloat($('input[name="discount"]').val()) || 0;

                var finalTotal = subtotal + tax - discount;
                $('#finalTotal').val(finalTotal.toFixed(2));
            }

            // Trigger calc on Tax/Discount change
            $('input[name="tax"], input[name="discount"]').on('keyup change', function () {
                calcTotals();
            });
        });
    </script>
@endpush