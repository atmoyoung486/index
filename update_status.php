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
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "UPDATE signup_requests SET status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            alert('회원 상태가 업데이트되었습니다.');
            window.location.href = 'admin.php';
        </script>";
    } else {
        echo "오류: " . $conn->error;
    }

    $conn->close();
}
?>
