<?php
$conn = new mysqli('localhost', 'root', '', 'food_waste_management');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'donateFood') {
    $data = json_decode(file_get_contents('php://input'), true);
    $food_item = $conn->real_escape_string($data['food_item']);
    $quantity = $conn->real_escape_string($data['quantity']);
    $donor_name = $conn->real_escape_string($data['donor_name']);

    $query = "INSERT INTO food_waste (food_item, quantity, location, donation_status) 
              VALUES ('$food_item', '$quantity', 'unknown', 'pending')";
    echo $conn->query($query) ? 'Food donated successfully!' : 'Error donating food.';
}

if ($action === 'getWasteList') {
    $query = "SELECT * FROM food_waste WHERE donation_status = 'pending'";
    $result = $conn->query($query);
    $waste = [];
    while ($row = $result->fetch_assoc()) {
        $waste[] = $row;
    }
    echo json_encode($waste);
}

$conn->close();
?>
