const lightForm = document.getElementById('lightForm');
const lightList = document.getElementById('lightList');

lightForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const location = document.getElementById('location').value;
    const status = document.getElementById('status').value;

    fetch('server.php?action=controlLight', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            location, status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadLights();
        }
    });
});

function loadLights() {
    fetch('server.php?action=getLights')
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach(light => {
                html += `<li>${light.location} - Status: ${light.status}</li>`;
            });
            lightList.innerHTML = html;
        });
}

loadLights();
