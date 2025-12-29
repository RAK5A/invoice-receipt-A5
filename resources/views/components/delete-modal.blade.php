<div id="deleteModal" class="modal">
    <div class="modal-overlay" onclick="closeDeleteModal()"></div>
    <div class="modal-dialog">
        <div class="modal-content delete-modal-content">
            <div class="modal-header">
                <div class="delete-icon">
                    <span class="material-symbols-rounded">warning</span>
                </div>
                <h3>Confirm Delete</h3>
                <button type="button" class="modal-close" onclick="closeDeleteModal()">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </div>
            
            <div class="modal-body">
                <p id="deleteMessage">Are you sure you want to delete this item? This action cannot be undone.</p>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <span class="material-symbols-rounded">delete</span>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>