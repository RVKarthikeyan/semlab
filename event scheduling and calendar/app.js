const eventForm = document.getElementById('eventForm');
const eventList = document.getElementById('eventList');

eventForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const event = {
        title: document.getElementById('title').value,
        description: document.getElementById('description').value,
        eventDate: document.getElementById('eventDate').value,
    };

    fetch('server.php?action=add', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(event),
    }).then(response => response.text())
      .then(data => {
          alert(data);
          loadEvents();
      });
});

function loadEvents() {
    fetch('server.php?action=list')
        .then(response => response.json())
        .then(events => {
            eventList.innerHTML = '';
            events.forEach(event => {
                eventList.innerHTML += `
                    <div class="event">
                        <h3>${event.title}</h3>
                        <p>${event.description}</p>
                        <p><strong>Date:</strong> ${event.event_date}</p>
                    </div>
                `;
            });
        });
}

loadEvents();
