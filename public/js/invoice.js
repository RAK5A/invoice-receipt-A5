let selectedProducts = [];
let productRowCounter = 0;

// Product Modal Functions
function showProductModal() {
    document.getElementById('productModal').style.display = 'flex';
}

function closeProductModal() {
    document.getElementById('productModal').style.display = 'none';
}

function filterProducts() {
    const search = document.getElementById('productSearch').value.toLowerCase();
    const rows = document.querySelectorAll('#productSelectTable .product-row');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(search) ? '' : 'none';
    });
}

function selectProduct(product) {
    // console.log('=== DEBUG: Product Data ===');
    // console.log('Full product object:', product);
    
    const productId = typeof product.product_id === 'string' ? 
                     parseInt(product.product_id, 10) : 
                     Number(product.product_id);
    
    // console.log('Product ID from product_id:', productId, 'Type:', typeof productId);
    
    // Check current selected products
    // console.log('Current selected IDs:', selectedProducts.map(p => ({
    //     id: p.id, 
    //     name: p.name
    // })));
    
    // Find if product already exists
    const existingIndex = selectedProducts.findIndex(p => {
        return p.id === productId;
    });
    
    console.log('Found at index:', existingIndex);
    
    if (existingIndex !== -1) {
        // Product exists - increase quantity
        const currentQuantity = selectedProducts[existingIndex].quantity;
        const maxStock = selectedProducts[existingIndex].stock;
        
        if (currentQuantity < maxStock) {
            updateProductQuantity(existingIndex, currentQuantity + 1);
            closeProductModal();
            return;
        } else {
            alert(`Maximum stock reached (${maxStock} items)`);
            return;
        }
    }
    
    // Add new product
    selectedProducts.push({
        id: productId, // Use product_id
        name: product.product_name,
        price: parseFloat(product.product_price),
        stock: parseInt(product.quantity),
        quantity: 1,
        subtotal: parseFloat(product.product_price)
    });
    
    // console.log('Added product. New list:', selectedProducts);
    
    // Update UI
    renderSelectedProducts();
    calculateTotals();
    closeProductModal();
}

function selectProductFromButton(button) {
    const product = JSON.parse(button.getAttribute('data-product'));
    selectProduct(product);
}

function updateProductQuantity(index, quantity) {
    if (quantity < 1) quantity = 1;
    
    // Check stock limit
    const maxQuantity = selectedProducts[index].stock;
    if (quantity > maxQuantity) {
        alert(`Only ${maxQuantity} items available in stock.`);
        quantity = maxQuantity;
    }
    
    selectedProducts[index].quantity = quantity;
    selectedProducts[index].subtotal = selectedProducts[index].price * quantity;
    
    renderSelectedProducts();
    calculateTotals();
}

function removeProduct(index) {
    selectedProducts.splice(index, 1);
    renderSelectedProducts();
    calculateTotals();
}

function renderSelectedProducts() {
    const tbody = document.getElementById('selectedProductsBody');
    const productFields = document.getElementById('productFields');
    
    // Clear existing
    tbody.innerHTML = '';
    productFields.innerHTML = '';
    
    // Render each product
    selectedProducts.forEach((product, index) => {
        // Add to table (keep your existing table HTML)
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <strong>${product.name}</strong>
            </td>
            <td>$${product.price.toFixed(2)}</td>
            <td>
                <span class="stock-badge ${product.stock <= 5 ? 'low-stock' : ''}">
                    ${product.stock}
                </span>
            </td>
            <td>
                <input type="number" 
                    class="form-control quantity-input" 
                    value="${product.quantity}" 
                    min="1" 
                    max="${product.stock}"
                    onchange="updateProductQuantity(${index}, this.value)">
            </td>
            <td>$${product.subtotal.toFixed(2)}</td>
            <td>
                <button type="button" class="action-btn delete-sm" onclick="removeProduct(${index})" title="Remove">
                    <span class="material-symbols-rounded">close</span>
                </button>
            </td>
        `;
        tbody.appendChild(row);
        
        // FIXED: Update hidden fields to match controller validation
        productFields.innerHTML += `
            <input type="hidden" name="products[${index}][name]" value="${product.name}">
            <input type="hidden" name="products[${index}][qty]" value="${product.quantity}">
            <input type="hidden" name="products[${index}][price]" value="${product.price}">
            <input type="hidden" name="products[${index}][subtotal]" value="${product.subtotal}">
            <!-- Keep product_id for reference if needed -->
            <input type="hidden" name="products[${index}][product_id]" value="${product.id}">
        `;
    });
    
    // If no products, show message
    if (selectedProducts.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    No products selected. Please add products to the invoice.
                </td>
            </tr>
        `;
    }
}

function calculateTotals() {
    // Calculate subtotal from selected products
    let subtotal = selectedProducts.reduce((sum, product) => sum + product.subtotal, 0);
    
    // Calculate discount
    const discountAmount = parseFloat(document.getElementById('discount_amount').value) || 0;
    const discountType = document.getElementById('discount_type').value;
    let discount = discountType === 'percent' ? (subtotal * discountAmount / 100) : discountAmount;
    
    // Calculate tax
    const taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;
    const taxableAmount = subtotal - discount;
    const taxAmount = taxableAmount * taxRate / 100;
    
    const total = taxableAmount + taxAmount;
    
    // Update displays
    document.getElementById('subtotalDisplay').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('subtotal').value = subtotal.toFixed(2);
    document.getElementById('taxAmountDisplay').textContent = '$' + taxAmount.toFixed(2);
    document.getElementById('tax_amount').value = taxAmount.toFixed(2);
    document.getElementById('totalDisplay').textContent = '$' + total.toFixed(2);
    document.getElementById('total').value = total.toFixed(2);
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

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Clear selectedProducts array first
    selectedProducts = [];
    
    // Check if we have invoice items from Blade
    if (window.invoiceItems && window.invoiceItems.length > 0) {
        window.invoiceItems.forEach(function(item) {
            selectedProducts.push({
                id: item.product_id || 0,
                name: item.product,
                price: parseFloat(item.price),
                stock: window.availableProducts.find(p => p.id == item.product_id)?.quantity || 0,
                quantity: parseInt(item.qty),
                subtotal: parseFloat(item.subtotal)
            });
        });
        // console.log('Loaded', selectedProducts.length, 'items from invoice');
    }

    renderSelectedProducts();
    calculateTotals();
});