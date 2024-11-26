<?php
// get_reply.php - 유저 페이지에서 관리자의 답변을 불러오는 파일

if (isset($_GET['id'])) {
    $support_id = $_GET['id'];

    // 데이터베이스 연결
    $conn = new mysqli("localhost", "root", "", "user_management");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 해당 ID에 대한 관리자의 답변을 조회
    $sql = "SELECT admin_reply FROM customer_support WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $support_id);
    $stmt->execute();
    $stmt->bind_result($admin_reply);
    $stmt->fetch();

    echo $admin_reply ? $admin_reply : "관리자의 답변이 아직 없습니다.";

    $stmt->close();
    $conn->close();
}
?>
