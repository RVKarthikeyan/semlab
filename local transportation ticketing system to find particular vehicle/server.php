<?php
$conn = new mysqli('localhost', 'root', '', 'transport_ticketing');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'getVehicles') {
    $query = "SELECT * FROM vehicles";
    $result = $conn->query($query);
    $vehicles = [];
    while ($row = $result->fetch_assoc()) {
        $vehicles[] = $row;
    }
    echo json_encode($vehicles);
}

if ($action === 'bookTicket') {
    $data = json_decode(file_get_contents('php://input'), true);
    $passenger_name = $conn->real_escape_string($data['passenger_name']);
    $vehicle_id = $conn->real_escape_string($data['vehicle_id']);
    $seat_number = $conn->real_escape_string($data['seat_number']);
    $ticket_price = $conn->real_escape_string($data['ticket_price']);

    $query = "INSERT INTO tickets (passenger_name, vehicle_id, seat_number, ticket_price) 
              VALUES ('$passenger_name', '$vehicle_id', '$seat_number', '$ticket_price')";
    echo $conn->query($query) ? 'Ticket booked successfully!' : 'Error booking ticket.';
}

$conn->close();
?>
