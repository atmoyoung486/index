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

    $id = intval($_POST['id']);

    // 'rejected' 상태의 회원을 'approved'로 업데이트
    $sql = "UPDATE signup_requests SET status='approved' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('회원이 재승인되었습니다.'); window.location.href='admin.php';</script>";
    } else {
        echo "오류: " . $conn->error;
    }

    $conn->close();
}
?>
