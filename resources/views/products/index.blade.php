<x-layout title="Products - Invoice System">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Products</h1>
                <p>Manage your product inventory</p>
            </div>
            <a href="{{ route('products.create') }}" class="btn-primary">
                <span class="material-symbols-rounded">add</span>
                Add Product
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                <span class="material-symbols-rounded">check_circle</span>
                <div>
                    <p>{{ session('success') }}</p>
                </div>
                <button class="alert-close" onclick="this.parentElement.remove()">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
        @endif

        <!-- Products Table -->
        <div class="card">
            <div class="card-header">
                <h2>All Products</h2>
                <div class="search-box">
                    <span class="material-symbols-rounded">search</span>
                    <input type="text" id="searchInput" placeholder="Search products..." onkeyup="searchTable()">
                </div>
            </div>

            <div class="table-responsive">
                @if($products->count() > 0)
                    <table class="data-table" id="productsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><strong>#{{ $product->product_id }}</strong></td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ Str::limit($product->product_desc, 50) }}</td>
                                    <td><strong>${{ number_format($product->product_price, 2) }}</strong></td>
                                    <td>{{ $product->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('products.edit', $product->product_id) }}" class="action-btn edit"
                                                title="Edit">
                                                <span class="material-symbols-rounded">edit</span>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->product_id) }}" method="POST"
                                                class="delete-form"
                                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="action-btn delete" title="Delete">
                                                    <span class="material-symbols-rounded">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <span class="material-symbols-rounded">inventory_2</span>
                        <p>No products found. Add your first product!</p>
                        <a href="{{ route('products.create') }}" class="btn-primary">Add Product</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        // Search Table Function
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.getElementById('productsTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                let txtValue = tr[i].textContent || tr[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    </script>
</x-layout>