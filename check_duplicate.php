<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$field = $conn->real_escape_string($data['field']);
$value = $conn->real_escape_string($data['value']);

$sql = "SELECT COUNT(*) AS count FROM signup_requests WHERE $field = '$value'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    echo json_encode(['success' => true, 'exists' => $row['count'] > 0]);
} else {
    echo json_encode(['success' => false, 'error' => 'Query failed']);
}

$conn->close();
?>
