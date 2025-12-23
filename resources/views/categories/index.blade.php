<x-layout title="Categories - Invoice System" :navbar="true">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Product Categories</h1>
                <p>Organize your products by categories</p>
            </div>
            <a href="{{ route('categories.create') }}" class="btn-primary">
                <span class="material-symbols-rounded">add</span>
                Add Category
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

        @if(session('error'))
            <div class="alert alert-danger">
                <span class="material-symbols-rounded">error</span>
                <div>
                    <p>{{ session('error') }}</p>
                </div>
                <button class="alert-close" onclick="this.parentElement.remove()">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
        @endif

        <!-- Categories Table -->
        <div class="card">
            <div class="card-header">
                <h2>All Categories</h2>
                <div class="search-box">
                    <span class="material-symbols-rounded">category_search</span>
                    <input type="text" id="searchInput" placeholder="Search categories">
                </div>
            </div>

            <div class="table-responsive">
                @if($categories->count() > 0)
                    <table class="data-table" id="categoriesTable">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Products</th>
                                <th>Description</th>
                                {{-- <th>Created</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td><strong>#{{ $category->sort_order }}</strong></td>
                                    <td><strong>{{ $category->name }}</strong></td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="status-badge active">Active</span>
                                        @else
                                            <span class="status-badge inactive">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-count">{{ $category->products_count }} products</span>
                                    </td>
                                    <td>{{ Str::limit($category->description, 50) ?: 'N/A' }}</td>
                                    {{-- <td>{{ $category->created_at->format('M d, Y') }}</td> --}}
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('categories.edit', $category->id) }}" class="action-btn edit"
                                                title="Edit">
                                                <span class="material-symbols-rounded">edit</span>
                                            </a>
                                            <button type="button" class="action-btn delete"
                                                onclick="showDeleteModal('{{ route('categories.destroy', $category->id) }}', 
                                                'Are you sure you want to delete the category &quot;{{ $category->name }}&quot;? This action cannot be undone.')"
                                                title="Delete">
                                                <span class="material-symbols-rounded">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $categories->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <span class="material-symbols-rounded">category</span>
                        <p>No categories found. Add your first category!</p>
                        <a href="{{ route('categories.create') }}" class="btn-primary">Add Category</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layout>
<x-delete-modal />