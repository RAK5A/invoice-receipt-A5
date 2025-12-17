// Row counter for dynamic invoice items
let rowCounter = 1;

/**
 * Add new invoice item row
 */
function addInvoiceRow() {
    const tableBody = document.getElementById("itemsTableBody");
    const newRow = document.createElement("tr");
    newRow.className = "item-row";
    newRow.innerHTML = `
        <td>
            <input type="text" name="products[${rowCounter}][name]" class="form-control item-name" placeholder="Product name" required>
        </td>
        <td>
            <input type="number" name="products[${rowCounter}][qty]" class="form-control item-qty" value="1" min="1" required onchange="calculateRow(this)">
        </td>
        <td>
            <input type="number" name="products[${rowCounter}][price]" class="form-control item-price" value="0.00" step="0.01" min="0" required onchange="calculateRow(this)">
        </td>
        <td>
            <input type="text" name="products[${rowCounter}][discount]" class="form-control item-discount" placeholder="0 or 10%" onchange="calculateRow(this)">
        </td>
        <td>
            <input type="number" name="products[${rowCounter}][subtotal]" class="form-control item-subtotal" value="0.00" step="0.01" readonly>
        </td>
        <td>
            <button type="button" class="action-btn delete-sm" onclick="removeInvoiceRow(this)" title="Remove">
                <span class="material-symbols-rounded">close</span>
            </button>
        </td>
    `;
    tableBody.appendChild(newRow);
    rowCounter++;
}

/**
 * Remove invoice item row
 */
function removeInvoiceRow(button) {
    const row = button.closest(".item-row");
    const tableBody = document.getElementById("itemsTableBody");

    // Don't remove if it's the only row
    if (tableBody.children.length > 1) {
        row.remove();
        calculateTotals();
    } else {
        alert("You must have at least one item!");
    }
}

/**
 * Calculate row subtotal
 */
function calculateRow(element) {
    const row = element.closest(".item-row");
    const qty = parseFloat(row.querySelector(".item-qty").value) || 0;
    const price = parseFloat(row.querySelector(".item-price").value) || 0;
    const discountInput = row.querySelector(".item-discount").value.trim();

    let subtotal = qty * price;
    let discountAmount = 0;

    // Calculate discount
    if (discountInput) {
        if (discountInput.includes("%")) {
            // Percentage discount
            const percentage = parseFloat(discountInput.replace("%", "")) || 0;
            discountAmount = (subtotal * percentage) / 100;
        } else {
            // Fixed amount discount
            discountAmount = parseFloat(discountInput) || 0;
        }
    }

    subtotal -= discountAmount;

    // Update subtotal
    row.querySelector(".item-subtotal").value = subtotal.toFixed(2);

    // Recalculate totals
    calculateTotals();
}

/**
 * Calculate invoice totals
 */
function calculateTotals() {
    const rows = document.querySelectorAll(".item-row");
    let subtotal = 0;
    let totalDiscount = 0;

    rows.forEach((row) => {
        const qty = parseFloat(row.querySelector(".item-qty").value) || 0;
        const price = parseFloat(row.querySelector(".item-price").value) || 0;
        const discountInput = row.querySelector(".item-discount").value.trim();
        const itemSubtotal =
            parseFloat(row.querySelector(".item-subtotal").value) || 0;

        const itemTotal = qty * price;
        subtotal += itemTotal;

        // Calculate discount amount
        if (discountInput) {
            if (discountInput.includes("%")) {
                const percentage =
                    parseFloat(discountInput.replace("%", "")) || 0;
                totalDiscount += (itemTotal * percentage) / 100;
            } else {
                totalDiscount += parseFloat(discountInput) || 0;
            }
        }
    });

    const shipping = parseFloat(document.getElementById("shipping").value) || 0;
    const subtotalAfterDiscount = subtotal - totalDiscount;

    // Calculate VAT (10% of subtotal after discount)
    const vat = subtotalAfterDiscount * 0.1;

    // Calculate grand total
    const grandTotal = subtotalAfterDiscount + shipping + vat;

    // Update fields
    document.getElementById("subtotal").value = subtotal.toFixed(2);
    document.getElementById("discount").value = totalDiscount.toFixed(2);
    document.getElementById("vat").value = vat.toFixed(2);
    document.getElementById("total").value = grandTotal.toFixed(2);
}


/**
 * Show customer selection modal
 */
function showCustomerModal() {
    document.getElementById("customerModal").style.display = "flex";
}

/**
 * Close customer selection modal
 */
function closeCustomerModal() {
    document.getElementById("customerModal").style.display = "none";
}

/**
 * Filter customers in modal
 */
function filterCustomers() {
    const input = document.getElementById("customerSearch");
    const filter = input.value.toUpperCase();
    const table = document.getElementById("customerSelectTable");
    const rows = table.getElementsByClassName("customer-row");

    for (let i = 0; i < rows.length; i++) {
        let txtValue = rows[i].textContent || rows[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

/**
 * Select customer and populate form
 */
function selectCustomer(customer) {
    // Billing information
    document.getElementById("customer_name").value = customer.name;
    document.getElementById("customer_email").value = customer.email;
    document.getElementById("customer_phone").value = customer.phone;
    document.getElementById("customer_address").value = customer.address;

    closeCustomerModal();
}

// Close modal when clicking outside
window.onclick = function (event) {
    const modal = document.getElementById("customerModal");
    if (event.target === modal) {
        closeCustomerModal();
    }
};

// Initialize calculations on page load
document.addEventListener("DOMContentLoaded", function () {
    calculateTotals();
});

function searchTable() {
    const input = document.getElementById("searchInput");
    const filter = input.value.toUpperCase();
    const table = document.getElementById("invoicesTable");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        let txtValue = tr[i].textContent || tr[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
