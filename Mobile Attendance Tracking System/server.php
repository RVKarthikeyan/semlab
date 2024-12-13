<?php
$conn = new mysqli('localhost', 'root', '', 'attendance_tracking');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'getStudents') {
    $query = "SELECT * FROM students";
    $result = $conn->query($query);
    $students = [];
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
    echo json_encode($students);
}

if ($action === 'markAttendance') {
    $data = json_decode(file_get_contents('php://input'), true);
    $student_id = $conn->real_escape_string($data['student_id']);
    $status = $conn->real_escape_string($data['status']);
    $date = date('Y-m-d');

    $query = "INSERT INTO attendance (student_id, date, status) 
              VALUES ('$student_id', '$date', '$status')";
    echo $conn->query($query) ? 'Attendance marked successfully!' : 'Error marking attendance.';
}

$conn->close();
?>
