const donateForm = document.getElementById('donateForm');
const wasteList = document.getElementById('wasteList');

donateForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const donateData = {
        food_item: document.getElementById('foodItem').value,
        quantity: document.getElementById('quantity').value,
        donor_name: document.getElementById('donorName').value
    };

    fetch('server.php?action=donateFood', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(donateData),
    }).then(response => response.text())
      .then(data => alert(data));
});

function loadWasteFood() {
    fetch('server.php?action=getWasteList')
        .then(response => response.json())
        .then(waste => {
            wasteList.innerHTML = '';
            waste.forEach(item => {
                wasteList.innerHTML += `
                    <div class="waste-item">
                        <h3>${item.food_item}</h3>
                        <p>Quantity: ${item.quantity}</p>
                        <p>Status: ${item.donation_status}</p>
                    </div>
                `;
            });
        });
}

loadWasteFood();
