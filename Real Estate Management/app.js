const propertyForm = document.getElementById('propertyForm');
const propertyList = document.getElementById('propertyList');

propertyForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const name = document.getElementById('name').value;
    const type = document.getElementById('type').value;
    const price = document.getElementById('price').value;
    const location = document.getElementById('location').value;
    const description = document.getElementById('description').value;

    fetch('server.php?action=addProperty', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            name, type, price, location, description
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadProperties();
        }
    });
});

function loadProperties() {
    fetch('server.php?action=getProperties')
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach(property => {
                html += `<li>${property.name} - ${property.type} - $${property.price} - ${property.location}</li>`;
            });
            propertyList.innerHTML = html;
        });
}

loadProperties();
