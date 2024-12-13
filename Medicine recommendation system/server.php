<?php
$conn = new mysqli('localhost', 'root', '', 'medicine_recommendation');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'addUserSymptoms') {
    $data = json_decode(file_get_contents('php://input'), true);
    $symptoms = $conn->real_escape_string($data['symptoms']);

    $query = "INSERT INTO user_symptoms (symptoms) VALUES ('$symptoms')";
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getMedicineRecommendations') {
    $query = "SELECT * FROM medicines";
    $result = $conn->query($query);
    $medicines = [];
    while ($row = $result->fetch_assoc()) {
        $medicines[] = $row;
    }
    echo json_encode($medicines);
}

$conn->close();
?>
