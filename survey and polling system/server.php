<?php
$conn = new mysqli('localhost', 'root', '', 'survey_system');

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$action = $_GET['action'] ?? '';

if ($action === 'createSurvey') {
    $data = json_decode(file_get_contents('php://input'), true);
    $question = $conn->real_escape_string($data['question']);
    $options = $data['options'];

    $query = "INSERT INTO surveys (question) VALUES ('$question')";
    if ($conn->query($query)) {
        $survey_id = $conn->insert_id;
        foreach ($options as $option) {
            $option = $conn->real_escape_string(trim($option));
            $conn->query("INSERT INTO options (survey_id, option_text) VALUES ('$survey_id', '$option')");
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

if ($action === 'getSurveys') {
    $query = "SELECT * FROM surveys";
    $result = $conn->query($query);
    $surveys = [];
    while ($row = $result->fetch_assoc()) {
        $options = [];
        $optionQuery = "SELECT option_text FROM options WHERE survey_id = " . $row['id'];
        $optionResult = $conn->query($optionQuery);
        while ($optionRow = $optionResult->fetch_assoc()) {
            $options[] = $optionRow['option_text'];
        }
        $row['options'] = $options;
        $surveys[] = $row;
    }
    echo json_encode($surveys);
}

$conn->close();
?>
