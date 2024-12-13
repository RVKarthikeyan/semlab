const donorForm = document.getElementById('donorForm');
const searchCity = document.getElementById('searchCity');
const results = document.getElementById('results');

donorForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const donor = {
        name: document.getElementById('name').value,
        bloodGroup: document.getElementById('bloodGroup').value,
        contact: document.getElementById('contact').value,
        city: document.getElementById('city').value
    };

    fetch('server.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(donor),
    }).then(response => response.text())
      .then(data => alert(data));
});

function searchDonors() {
    const city = searchCity.value;

    fetch(`server.php?action=search&city=${city}`)
        .then(response => response.json())
        .then(data => {
            results.innerHTML = '<h3>Donors Found:</h3>';
            data.forEach(donor => {
                results.innerHTML += `<p>${donor.name} (${donor.blood_group}) - ${donor.contact}</p>`;
            });
        });
}
