const parkingForm = document.getElementById('parkingForm');
const parkingList = document.getElementById('parkingList');

parkingForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const location = document.getElementById('location').value;
    const totalSpaces = document.getElementById('totalSpaces').value;
    const availableSpaces = document.getElementById('availableSpaces').value;

    fetch('server.php?action=addParking', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            location, totalSpaces, availableSpaces
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadParkingSpaces();
        }
    });
});

function loadParkingSpaces() {
    fetch('server.php?action=getParkingSpaces')
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach(space => {
                html += `<li>${space.location} - ${space.available_spaces} available</li>`;
            });
            parkingList.innerHTML = html;
        });
}

loadParkingSpaces();
