<x-layout title="Products - Invoice System" :navbar="true">
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
                    <input type="text" id="searchInput" placeholder="Search products">
                </div>
            </div>

            <div class="table-responsive">
                @if($products->count() > 0)
                    <table class="data-table" id="productsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Type</th>
                                <th>Description</th>
                                {{-- <th>Created</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td><strong>#{{ $product->product_id }}</strong></td>
                                    <td>{{ $product->product_name }}</td>
                                    <td><strong>${{ number_format($product->product_price, 2) }}</strong></td>
                                    <td>{{ number_format($product->quantity) }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->product_desc ? Str::limit($product->product_desc, 50) : 'N/A' }}</td>
                                    {{-- <td>{{ $product->created_at->format('M d, Y') }}</td> --}}
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
                                                <button type="button" class="action-btn delete"
                                                    onclick="showDeleteModal('{{ route('products.destroy', $product->product_id) }}', 
                                                    'Are you sure you want to delete the product &quot;{{ $product->product_name }}&quot;? This action cannot be undone.')"
                                                    title="Delete">
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
</x-layout>
<x-delete-modal></x-delete-modal>