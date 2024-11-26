<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// POST 데이터 받기
$title = $_POST['title'];
$content = $_POST['content'];
$author = $_POST['author'];

// 글 저장
$sql = "INSERT INTO customer_support (title, content, author, created_at) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $content, $author);
$stmt->execute();

// 저장 성공 여부 확인 후 응답 반환
if ($stmt->affected_rows > 0) {
    echo "글이 작성되었습니다.";
} else {
    echo "글 작성에 실패했습니다.";
}

$stmt->close();
$conn->close();
?>
