const bookingForm = document.getElementById('bookingForm');
const ticketList = document.getElementById('ticketList');
const ticketSelect = document.getElementById('ticket');

bookingForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const ticketId = ticketSelect.value;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;

    fetch('server.php?action=bookTicket', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ ticketId, name, email })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadTickets();
        }
    });
});

function loadTickets() {
    fetch('server.php?action=getTickets')
        .then(response => response.json())
        .then(data => {
            let ticketHtml = '';
            data.forEach(ticket => {
                ticketHtml += `<div><h3>${ticket.ticket_name}</h3><p>Price: $${ticket.price}</p><p>Status: ${ticket.status}</p></div>`;
                ticketSelect.innerHTML += `<option value="${ticket.id}">${ticket.ticket_name} - $${ticket.price}</option>`;
            });
            ticketList.innerHTML = ticketHtml;
        });
}

loadTickets();
