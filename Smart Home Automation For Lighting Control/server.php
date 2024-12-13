<?php
$conn = new mysqli('localhost', 'root', '', 'home_automation');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'controlLight') {
    $data = json_decode(file_get_contents('php://input'), true);
    $location = $conn->real_escape_string($data['location']);
    $status = $conn->real_escape_string($data['status']);

    $query = "INSERT INTO lights (location, status) VALUES ('$location', '$status')";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getLights') {
    $query = "SELECT * FROM lights";
    $result = $conn->query($query);
    $lights = [];
    while ($row = $result->fetch_assoc()) {
        $lights[] = $row;
    }
    echo json_encode($lights);
}

$conn->close();
?>
