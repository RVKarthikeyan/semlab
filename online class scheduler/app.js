const classForm = document.getElementById('classForm');
const classList = document.getElementById('classList');

classForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const className = document.getElementById('className').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;
    const dayOfWeek = document.getElementById('dayOfWeek').value;

    fetch('server.php?action=addClass', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            className, startTime, endTime, dayOfWeek
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadClasses();
        }
    });
});

function loadClasses() {
    fetch('server.php?action=getClasses')
        .then(response => response.json())
        .then(data => {
            let html = '<ul>';
            data.forEach(classItem => {
                html += `<li>${classItem.class_name} - ${classItem.start_time} to ${classItem.end_time} (${classItem.day_of_week})</li>`;
            });
            html += '</ul>';
            classList.innerHTML = html;
        });
}

loadClasses();
