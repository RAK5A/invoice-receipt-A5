<x-layout title="Add Product - Invoice System" :navbar="true">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Add New Product</h1>
                <p>Create a new product for your inventory</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded">arrow_back</span>
                Back to Products
            </a>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="form-grid">
                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="product_name">
                            <span class="material-symbols-rounded">inventory_2</span>
                            Product Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="product_name" name="product_name"
                            class="form-control @error('product_name') is-invalid @enderror"
                            value="{{ old('product_name') }}" 
                            required placeholder="Enter product name">
                        @error('product_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Product Price -->
                    <div class="form-group">
                        <label for="product_price">
                            <span class="material-symbols-rounded">payments</span>
                            Product Price
                            <span class="required">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-prefix">$</span>
                            <input type="number" id="product_price" name="product_price"
                                class="form-control @error('product_price') is-invalid @enderror"
                                value="{{ old('product_price') }}" step="0.01" min="0" required placeholder="0.00">
                        </div>
                        @error('product_price')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Product Description (Full Width) -->
                    <div class="form-group full-width">
                        <label for="product_desc">
                            <span class="material-symbols-rounded">description</span>
                            Product Description
                        </label>
                        <textarea id="product_desc" name="product_desc"
                            class="form-control @error('product_desc') is-invalid @enderror" rows="4"
                            placeholder="Enter product description">{{ old('product_desc') }}</textarea>
                        @error('product_desc')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('products.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <span class="material-symbols-rounded">save</span>
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>