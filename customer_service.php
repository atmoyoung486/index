<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// POST 요청으로 제목과 내용을 받아옴
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = "사용자"; // 간단히 사용자로 표시, 실제로는 로그인된 사용자의 정보를 이용해야 함

    $sql = "INSERT INTO customer_support (title, content, author, created_at) VALUES ('$title', '$content', '$author', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "성공적으로 작성되었습니다.";
    } else {
        echo "오류: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
