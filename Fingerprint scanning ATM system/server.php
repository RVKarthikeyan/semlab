<?php
$conn = new mysqli('localhost', 'root', '', 'atm_system');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'login') {
    $data = json_decode(file_get_contents('php://input'), true);
    $pin = $conn->real_escape_string($data['pin']);

    $query = "SELECT * FROM users WHERE pin='$pin'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo 'Login successful';
    } else {
        echo 'Invalid PIN';
    }
}

$conn->close();
?>
