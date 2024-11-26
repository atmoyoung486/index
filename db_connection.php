<?php
$servername = "localhost";  // 서버 이름 (보통 로컬에서는 localhost 사용)
$username = "root";         // MySQL 사용자 이름
$password = "";             // MySQL 비밀번호 (기본 설정은 빈 값)
$dbname = "user_management";  // 사용할 데이터베이스 이름

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
