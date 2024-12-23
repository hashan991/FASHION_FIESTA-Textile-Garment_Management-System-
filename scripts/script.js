const cartItems = [];
const products = document.querySelectorAll('.add-to-cart');

products.forEach(product => {
    product.addEventListener('click', () => {
        const productName = product.getAttribute('data-product');
        const price = productName.includes("Men's Shirt") ? 29.99 : 39.99;

        cartItems.push({
            name: productName,
            price: price
        });

        updateCart();
    });
});

function updateCart() {
    const cartList = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    let total = 0;

    cartList.innerHTML = '';
    cartItems.forEach(item => {
        const listItem = document.createElement('li');
        listItem.innerText = `${item.name} - $${item.price.toFixed(2)}`;
        cartList.appendChild(listItem);
        total += item.price;
    });

    cartTotal.innerText = `$${total.toFixed(2)}`;
}

const checkoutBtn = document.getElementById('checkout-btn');
checkoutBtn.addEventListener('click', () => {
    alert('Thank you for your purchase!');
    cartItems.length = 0;
    updateCart();
});