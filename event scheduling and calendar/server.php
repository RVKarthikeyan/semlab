<?php
$conn = new mysqli('localhost', 'root', '', 'event_scheduler');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'add') {
    $data = json_decode(file_get_contents('php://input'), true);
    $title = $conn->real_escape_string($data['title']);
    $description = $conn->real_escape_string($data['description']);
    $eventDate = $conn->real_escape_string($data['eventDate']);

    $query = "INSERT INTO events (title, description, event_date) VALUES ('$title', '$description', '$eventDate')";
    echo $conn->query($query) ? 'Event added successfully!' : 'Error adding event.';
}

if ($action === 'list') {
    $query = "SELECT * FROM events ORDER BY event_date ASC";
    $result = $conn->query($query);
    $events = [];
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
    echo json_encode($events);
}

$conn->close();
?>
