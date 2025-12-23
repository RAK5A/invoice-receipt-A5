/**
 * Universal Table Search Function
 * Searches through table rows and hides/shows based on match
 *
 * @param {string} inputId - ID of the search input field
 * @param {string} tableId - ID of the table to search
 */
function searchTable(inputId = "searchInput", tableId = null) {
    const input = document.getElementById(inputId);

    if (!input) {
        console.error(`Search input with ID "${inputId}" not found`);
        return;
    }

    const filter = input.value.toUpperCase();

    // If no tableId provided, try to find the first data-table
    let table;
    if (tableId) {
        table = document.getElementById(tableId);
    } else {
        table = document.querySelector(".data-table");
    }

    if (!table) {
        console.error(`Table with ID "${tableId}" not found`);
        return;
    }

    const tr = table.getElementsByTagName("tr");

    // Start from 1 to skip header row
    for (let i = 1; i < tr.length; i++) {
        const txtValue = tr[i].textContent || tr[i].innerText;

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}

/**
 * Initialize search on page load
 * Automatically binds search to input with id="searchInput"
 */
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");

    if (searchInput) {
        // Auto-detect table ID
        const table = document.querySelector(".data-table");
        const tableId = table ? table.id : null;

        // Bind search on keyup
        searchInput.addEventListener("keyup", function () {
            searchTable("searchInput", tableId);
        });
    }
});

/**
 * Custom search for specific tables
 * Usage: customSearch('mySearchInput', 'myTableId')
 */
function customSearch(inputId, tableId) {
    searchTable(inputId, tableId);
}

/**
 * Clear search and show all rows
 */
function clearSearch(inputId = "searchInput", tableId = null) {
    const input = document.getElementById(inputId);
    if (input) {
        input.value = "";
        searchTable(inputId, tableId);
    }
}

/**
 * Search with debounce (performance optimization for large tables)
 * Waits for user to stop typing before searching
 */
let searchTimeout;
function debouncedSearch(inputId = "searchInput", tableId = null, delay = 300) {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        searchTable(inputId, tableId);
    }, delay);
}

/**
 * Delete confirmation modal
 */
// Show delete modal
function showDeleteModal(url, message = null) {
    const modal = document.getElementById("deleteModal");
    const form = document.getElementById("deleteForm");
    const messageEl = document.getElementById("deleteMessage");

    // Set form action
    form.action = url;

    // Set custom message if provided
    if (message) {
        messageEl.textContent = message;
    } else {
        messageEl.textContent =
            "Are you sure you want to delete this item? This action cannot be undone.";
    }

    // Show modal
    modal.style.display = "flex";
    document.body.style.overflow = "hidden";
}

// Close delete modal
function closeDeleteModal() {
    const modal = document.getElementById("deleteModal");
    modal.style.display = "none";
    document.body.style.overflow = "auto";
}

// Close on ESC key
document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
        closeDeleteModal();
    }
});
