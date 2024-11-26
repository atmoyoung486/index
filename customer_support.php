<?php
// customer_support.php
session_start();
include 'db_connection.php'; // 데이터베이스 연결 파일 포함

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = '사용자';
    $created_at = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO customer_support (user_id, title, content, author, created_at) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $title, $content, $author, $created_at);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
