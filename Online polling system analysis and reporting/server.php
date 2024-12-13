<?php
$conn = new mysqli('localhost', 'root', '', 'polling_system');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'createPoll') {
    $data = json_decode(file_get_contents('php://input'), true);
    $question = $conn->real_escape_string($data['question']);
    $options = implode(",", $data['options']);

    $query = "INSERT INTO polls (question, options) VALUES ('$question', '$options')";
    
    if ($conn->query($query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getPolls') {
    $query = "SELECT * FROM polls";
    $result = $conn->query($query);
    $polls = [];
    while ($row = $result->fetch_assoc()) {
        $polls[] = $row;
    }
    echo json_encode($polls);
}

$conn->close();
?>
