const ticketForm = document.getElementById('ticketForm');
const vehicleList = document.getElementById('vehicleList');
const vehicleSelect = document.getElementById('vehicleSelect');

fetch('server.php?action=getVehicles')
    .then(response => response.json())
    .then(data => {
        let vehicleHTML = '';
        data.forEach(vehicle => {
            vehicleHTML += `<div class="vehicle">
                                <h3>${vehicle.vehicle_number} (${vehicle.vehicle_type})</h3>
                                <p>Capacity: ${vehicle.capacity}</p>
                            </div>`;
            vehicleSelect.innerHTML += `<option value="${vehicle.id}">${vehicle.vehicle_number}</option>`;
        });
        vehicleList.innerHTML = vehicleHTML;
    });

ticketForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const ticketData = {
        passenger_name: document.getElementById('passengerName').value,
        vehicle_id: document.getElementById('vehicleSelect').value,
        seat_number: document.getElementById('seatNumber').value,
        ticket_price: 50.00  // Fixed ticket price, can be dynamic based on vehicle type
    };

    fetch('server.php?action=bookTicket', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(ticketData),
    }).then(response => response.text())
      .then(data => alert(data));
});
