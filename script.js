document.addEventListener('DOMContentLoaded', () => { 
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        // Display an alert if you wish, but let form submission proceed.
        alert('Form submitted successfully!');
        // No preventDefault here; allows PHP to handle redirection on successful login.
    });
});

// Add to Cart Functionality
document.querySelectorAll('.add-to-cart-btn').forEach(button => {
    button.addEventListener('click', () => {
        const productId = button.parentElement.getAttribute('data-product-id');
        
        // Here, we can send the product ID to a backend script to handle the cart logic (e.g., adding the product to session cart)
        fetch('cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product added to cart!');
            } else {
                alert('Failed to add product to cart.');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
