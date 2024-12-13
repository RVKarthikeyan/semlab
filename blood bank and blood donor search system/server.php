<?php
$conn = new mysqli('localhost', 'root', '', 'blood_bank');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'add') {
    $data = json_decode(file_get_contents('php://input'), true);
    $name = $conn->real_escape_string($data['name']);
    $bloodGroup = $conn->real_escape_string($data['bloodGroup']);
    $contact = $conn->real_escape_string($data['contact']);
    $city = $conn->real_escape_string($data['city']);

    $query = "INSERT INTO donors (name, blood_group, contact, city) VALUES ('$name', '$bloodGroup', '$contact', '$city')";
    echo $conn->query($query) ? 'Donor added successfully!' : 'Error adding donor.';
}

if ($action === 'search') {
    $city = $conn->real_escape_string($_GET['city']);
    $query = "SELECT name, blood_group, contact FROM donors WHERE city='$city'";
    $result = $conn->query($query);
    $donors = [];
    while ($row = $result->fetch_assoc()) {
        $donors[] = $row;
    }
    echo json_encode($donors);
}

$conn->close();
?>
