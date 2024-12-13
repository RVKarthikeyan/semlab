<?php
header("Content-Type: application/json");

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'chat_app';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["reply" => "Failed to connect to database."]));
}

// Get the input from the client
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = $data["message"] ?? "";

// Save the user message to the database
$stmt = $conn->prepare("INSERT INTO chat_messages (sender, message) VALUES (?, ?)");
$stmt->bind_param("ss", $sender, $message);

$sender = "user";
$message = $userMessage;
$stmt->execute();

// Generate an AI reply (simple echo)
$reply = "You said: " . $userMessage;

// Save the AI reply to the database
$sender = "AI";
$message = $reply;
$stmt->execute();

// Close the statement and connection
$stmt->close();
$conn->close();

// Return the reply as JSON
echo json_encode(["reply" => $reply]);
?>
