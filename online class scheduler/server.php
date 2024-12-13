<?php
$conn = new mysqli('localhost', 'root', '', 'class_scheduler');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'addClass') {
    $data = json_decode(file_get_contents('php://input'), true);
    $className = $conn->real_escape_string($data['className']);
    $startTime = $conn->real_escape_string($data['startTime']);
    $endTime = $conn->real_escape_string($data['endTime']);
    $dayOfWeek = $conn->real_escape_string($data['dayOfWeek']);

    $query = "INSERT INTO classes (class_name, start_time, end_time, day_of_week) 
              VALUES ('$className', '$startTime', '$endTime', '$dayOfWeek')";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getClasses') {
    $query = "SELECT * FROM classes";
    $result = $conn->query($query);
    $classes = [];
    while ($row = $result->fetch_assoc()) {
        $classes[] = $row;
    }
    echo json_encode($classes);
}

$conn->close();
?>
