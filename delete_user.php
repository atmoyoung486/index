<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    $id = intval($_POST['id']); // 전달된 회원 ID

    $sql = "DELETE FROM signup_requests WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('회원이 삭제되었습니다.'); window.location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('회원 삭제 중 오류가 발생했습니다: " . $conn->error . "'); window.location.href = 'admin.php';</script>";
    }

    $conn->close();
}
?>
