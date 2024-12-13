const pollForm = document.getElementById('pollForm');
const pollList = document.getElementById('pollList');

pollForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const question = document.getElementById('question').value;
    const options = document.getElementById('options').value.split(',');

    fetch('server.php?action=createPoll', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            question,
            options
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadPolls();
        }
    });
});

function loadPolls() {
    fetch('server.php?action=getPolls')
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach(poll => {
                html += `<div>
                            <h3>${poll.question}</h3>
                            <ul>`;
                poll.options.split(',').forEach((option, index) => {
                    html += `<li><input type="radio" name="poll${poll.id}" value="${index}" /> ${option}</li>`;
                });
                html += `</ul></div>`;
            });
            pollList.innerHTML = html;
        });
}

loadPolls();
