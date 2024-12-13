<?php
$conn = new mysqli('localhost', 'root', '', 'real_estate_management');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'addProperty') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $conn->real_escape_string($data['name']);
    $type = $conn->real_escape_string($data['type']);
    $price = $conn->real_escape_string($data['price']);
    $location = $conn->real_escape_string($data['location']);
    $description = $conn->real_escape_string($data['description']);

    $query = "INSERT INTO properties (name, type, price, location, description) 
              VALUES ('$name', '$type', '$price', '$location', '$description')";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getProperties') {
    $query = "SELECT * FROM properties";
    $result = $conn->query($query);
    $properties = [];
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row;
    }
    echo json_encode($properties);
}

$conn->close();
?>
