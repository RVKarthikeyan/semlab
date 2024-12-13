const authForm = document.getElementById('authForm');
const registerButton = document.getElementById('registerButton');

authForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const pin = document.getElementById('pin').value;

    fetch('server.php?action=login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ pin }),
    }).then(response => response.text())
      .then(data => alert(data));
});

registerButton.addEventListener('click', () => {
    alert('Fingerprint Registration Not Implemented in this Demo');
});
