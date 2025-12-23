<x-layout title="Edit Category - Invoice System" :navbar="true">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1>Edit Category</h1>
                <p>Update category information</p>
            </div>
            <a href="{{ route('categories.index') }}" class="btn-secondary">
                <span class="material-symbols-rounded">arrow_back</span>
                Back to Categories
            </a>
        </div>

        <!-- Form Card -->
        <div class="form-card">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    <!-- Category Name -->
                    <div class="form-group">
                        <label for="name">
                            <span class="material-symbols-rounded">category</span>
                            Category Name
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}" required placeholder="e.g., Electronics, Furniture">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div class="form-group">
                        <label for="sort_order">
                            <span class="material-symbols-rounded">sort</span>
                            Display Order
                        </label>
                        <input type="number" id="sort_order" name="sort_order"
                            class="form-control @error('sort_order') is-invalid @enderror"
                            value="{{ old('sort_order', $category->sort_order) }}" min="0" placeholder="0">
                        @error('sort_order')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <small class="form-hint">Lower numbers appear first in lists</small>
                    </div>

                    <!-- Description (Full Width) -->
                    <div class="form-group full-width">
                        <label for="description">
                            <span class="material-symbols-rounded">description</span>
                            Description
                        </label>
                        <textarea id="description" name="description"
                            class="form-control @error('description') is-invalid @enderror" rows="4"
                            placeholder="Optional description for this category">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="form-group full-width">
                        <label class="checkbox-label">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                            <span>
                                <span class="material-symbols-rounded">check_circle</span>
                                Active (visible in product selection)
                            </span>
                        </label>
                        <small class="form-hint">Uncheck to temporarily hide this category without deleting it</small>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <a href="{{ route('categories.index') }}" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-submit">
                        <span class="material-symbols-rounded">save</span>
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>