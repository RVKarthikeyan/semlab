<?php
$conn = new mysqli('localhost', 'root', '', 'ticket_system');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'bookTicket') {
    $data = json_decode(file_get_contents('php://input'), true);
    $ticketId = $conn->real_escape_string($data['ticketId']);
    $name = $conn->real_escape_string($data['name']);
    $email = $conn->real_escape_string($data['email']);

    $query = "INSERT INTO bookings (ticket_id, customer_name, customer_email) VALUES ('$ticketId', '$name', '$email')";
    if ($conn->query($query)) {
        $conn->query("UPDATE tickets SET status = 'Booked' WHERE id = '$ticketId'");
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getTickets') {
    $query = "SELECT * FROM tickets";
    $result = $conn->query($query);
    $tickets = [];
    while ($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }
    echo json_encode($tickets);
}

$conn->close();
?>

