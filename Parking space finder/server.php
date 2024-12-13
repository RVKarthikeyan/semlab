<?php
$conn = new mysqli('localhost', 'root', '', 'parking_system');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'addParking') {
    $data = json_decode(file_get_contents('php://input'), true);
    $location = $conn->real_escape_string($data['location']);
    $totalSpaces = $conn->real_escape_string($data['totalSpaces']);
    $availableSpaces = $conn->real_escape_string($data['availableSpaces']);

    $query = "INSERT INTO parking_spaces (location, total_spaces, available_spaces) 
              VALUES ('$location', '$totalSpaces', '$availableSpaces')";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getParkingSpaces') {
    $query = "SELECT * FROM parking_spaces";
    $result = $conn->query($query);
    $spaces = [];
    while ($row = $result->fetch_assoc()) {
        $spaces[] = $row;
    }
    echo json_encode($spaces);
}

$conn->close();
?>
