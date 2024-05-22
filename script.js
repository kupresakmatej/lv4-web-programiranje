// Get elements
const cartButton = document.querySelector('.cart-icon');
const cartBadge = document.querySelector('.cart-badge');
const modal = document.querySelector('.modal');
const modalClose = document.querySelector('.close');
const buyButton = document.querySelector('.buy-btn');
const cartItemsList = document.querySelector('.cart-items');
const cartTotal = document.querySelector('.cart-total');
const itemsGrid = document.querySelector('.items-grid');
const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

let cart = [];

// Attach event listeners to add-to-cart buttons
function fillItemsGrid() {
    for (const item of items) {
        let itemElement = document.createElement('div');
        itemElement.classList.add('item');
        itemElement.innerHTML = `
            <img src="https://picsum.photos/200/300?random=${item.id}" alt="${item.name}">
            <h2>${item.name}</h2>
            <p>$${item.price}</p>
            <button class="add-to-cart-btn" onclick="addToCart(${item.id})">Add to cart</button>
        `;
        itemsGrid.appendChild(itemElement);
    }
}

// Adds an item to the cart
function addToCart(itemId) {
    const item = items.find(item => item.id === itemId);
    const existingItem = cart.find(cartItem => cartItem.id === itemId);
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({ ...item, quantity: 1 });
    }
    updateCartDisplay();
    updateBuyButtonState();
}

// Updates the modal with cart items
function updateCartDisplay() {
    cartItemsList.innerHTML = '';
    let total = 0;
    cart.forEach(item => {
        total += item.price * item.quantity;
        const itemElement = document.createElement('li');
        itemElement.innerHTML = `${item.name} - $${item.price} x ${item.quantity} <button class="add-to-cart-btn" onclick="removeItemFromCart(${item.id})">Remove</button>`;
        cartItemsList.appendChild(itemElement);
    });
    cartTotal.innerText = `$${total.toFixed(2)}`;
    cartBadge.innerText = cart.reduce((acc, item) => acc + item.quantity, 0).toString();
}

// Removes an item from the cart
function removeItemFromCart(itemId) {
    const itemIndex = cart.findIndex(item => item.id === itemId);
    if (cart[itemIndex].quantity > 1) {
        cart[itemIndex].quantity--;
    } else {
        cart.splice(itemIndex, 1);
    }
    updateCartDisplay();
    updateBuyButtonState();
}

// Clears the cart and updates UI after purchase
function purchaseItems() {
    if (cart.length === 0) {
        alert('Your cart is empty. Please add some items before purchasing.');
        return;
    }
    alert('Purchase successful! Thank you for your order.');
    cart = [];
    updateCartDisplay();
    updateBuyButtonState();
    toggleModal();
}

function searchItems() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase();
    const filteredItems = items.filter(item => item.name.toLowerCase().includes(searchTerm));

    itemsGrid.innerHTML = '';

    for (const item of filteredItems) {
        let itemElement = document.createElement('div');
        itemElement.classList.add('item');
        itemElement.innerHTML = `
            <img src="https://picsum.photos/200/300?random=${item.id}" alt="${item.name}">
            <h2>${item.name}</h2>
            <p>$${item.price}</p>
            <button class="add-to-cart-btn" onclick="addToCart(${item.id})">Add to cart</button>
        `;
        itemsGrid.appendChild(itemElement);
    }
}

// Updates the buy button state based on cart content
function updateBuyButtonState() {
    if (cart.length === 0) {
        buyButton.disabled = true;
        buyButton.classList.add('disabled');
    } else {
        buyButton.disabled = false;
        buyButton.classList.remove('disabled');
    }
}

// Adding the .show-modal class to an element will make it visible
function toggleModal() {
    modal.classList.toggle('show-modal');
}

// Call fillItemsGrid function when page loads
fillItemsGrid();
updateBuyButtonState();

// Example of DOM methods for adding event handling
cartButton.addEventListener('click', toggleModal);
modalClose.addEventListener('click', toggleModal);
buyButton.addEventListener('click', purchaseItems);

document.getElementById('search-input').addEventListener('keyup', function (event) {
    searchItems();
});
