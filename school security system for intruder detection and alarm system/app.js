const alertForm = document.getElementById('alertForm');
const alertList = document.getElementById('alertList');

alertForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const location = document.getElementById('location').value;
    const status = document.getElementById('status').value;

    fetch('server.php?action=triggerAlert', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            location, status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadAlerts();
        }
    });
});

function loadAlerts() {
    fetch('server.php?action=getAlerts')
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach(alert => {
                html += `<li>${alert.location} - Status: ${alert.status} - Time: ${alert.alert_time}</li>`;
            });
            alertList.innerHTML = html;
        });
}

loadAlerts();
