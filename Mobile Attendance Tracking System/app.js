const attendanceForm = document.getElementById('attendanceForm');
const studentSelect = document.getElementById('studentSelect');
const attendanceList = document.getElementById('attendanceList');

fetch('server.php?action=getStudents')
    .then(response => response.json())
    .then(data => {
        let studentHTML = '';
        data.forEach(student => {
            studentHTML += `<option value="${student.id}">${student.name} (${student.roll_number})</option>`;
        });
        studentSelect.innerHTML = studentHTML;
    });

attendanceForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const attendanceData = {
        student_id: studentSelect.value,
        status: document.getElementById('statusSelect').value
    };

    fetch('server.php?action=markAttendance', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(attendanceData),
    }).then(response => response.text())
      .then(data => alert(data));
});
