<?php
$conn = new mysqli('localhost', 'root', '', 'food_delivery');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'getMenu') {
    $query = "SELECT * FROM food_items";
    $result = $conn->query($query);
    $menu = [];
    while ($row = $result->fetch_assoc()) {
        $menu[] = $row;
    }
    echo json_encode($menu);
}

if ($action === 'placeOrder') {
    $data = json_decode(file_get_contents('php://input'), true);
    $user_name = $conn->real_escape_string($data['user_name']);
    $food_item_id = $conn->real_escape_string($data['food_item_id']);
    $customization = $conn->real_escape_string($data['customization']);
    $quantity = $conn->real_escape_string($data['quantity']);
    $total_price = $conn->real_escape_string($data['total_price']);

    $query = "INSERT INTO orders (user_name, food_item_id, customization, quantity, total_price) 
              VALUES ('$user_name', '$food_item_id', '$customization', '$quantity', '$total_price')";
    echo $conn->query($query) ? 'Order placed successfully!' : 'Error placing order.';
}

$conn->close();
?>
