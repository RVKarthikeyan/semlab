const orderForm = document.getElementById('orderForm');
const foodMenu = document.getElementById('foodMenu');
const foodItemSelect = document.getElementById('foodItem');

fetch('server.php?action=getMenu')
    .then(response => response.json())
    .then(data => {
        let menuHTML = '';
        data.forEach(item => {
            menuHTML += `<div class="food-item">
                            <h3>${item.name}</h3>
                            <p>${item.description}</p>
                            <p>Price: $${item.price}</p>
                          </div>`;
            foodItemSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
        });
        foodMenu.innerHTML = menuHTML;
    });

orderForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const orderData = {
        user_name: document.getElementById('userName').value,
        food_item_id: document.getElementById('foodItem').value,
        customization: document.getElementById('customization').value,
        quantity: document.getElementById('quantity').value,
        total_price: document.getElementById('quantity').value * parseFloat(foodItemSelect.selectedOptions[0].getAttribute('data-price'))
    };

    fetch('server.php?action=placeOrder', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(orderData),
    }).then(response => response.text())
      .then(data => alert(data));
});
