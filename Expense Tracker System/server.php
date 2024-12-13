<?php
$conn = new mysqli('localhost', 'root', '', 'expense_tracker');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'add') {
    $data = json_decode(file_get_contents('php://input'), true);
    $category = $conn->real_escape_string($data['category']);
    $description = $conn->real_escape_string($data['description']);
    $amount = $conn->real_escape_string($data['amount']);
    $date = $conn->real_escape_string($data['date']);

    $query = "INSERT INTO expenses (category, description, amount, date) VALUES ('$category', '$description', '$amount', '$date')";
    echo $conn->query($query) ? 'Expense added successfully!' : 'Error adding expense.';
}

if ($action === 'list') {
    $query = "SELECT * FROM expenses ORDER BY date DESC";
    $result = $conn->query($query);
    $expenses = [];
    while ($row = $result->fetch_assoc()) {
        $expenses[] = $row;
    }
    echo json_encode($expenses);
}

$conn->close();
?>
