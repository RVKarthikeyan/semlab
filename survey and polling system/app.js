const surveyForm = document.getElementById('surveyForm');
const surveyList = document.getElementById('surveyList');

surveyForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const question = document.getElementById('question').value;
    const options = document.getElementById('options').value.split(',');

    fetch('server.php?action=createSurvey', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ question, options })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            loadSurveys();
        }
    });
});

function loadSurveys() {
    fetch('server.php?action=getSurveys')
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach(survey => {
                html += `<li>${survey.question} - Options: ${survey.options.join(', ')}</li>`;
            });
            surveyList.innerHTML = html;
        });
}

loadSurveys();
