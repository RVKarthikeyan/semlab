<?php
$conn = new mysqli('localhost', 'root', '', 'school_security');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'triggerAlert') {
    $data = json_decode(file_get_contents('php://input'), true);
    $location = $conn->real_escape_string($data['location']);
    $status = $conn->real_escape_string($data['status']);

    $query = "INSERT INTO intruder_alerts (location, status) VALUES ('$location', '$status')";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getAlerts') {
    $query = "SELECT * FROM intruder_alerts";
    $result = $conn->query($query);
    $alerts = [];
    while ($row = $result->fetch_assoc()) {
        $alerts[] = $row;
    }
    echo json_encode($alerts);
}

$conn->close();
?>
