<?php
if (isset($_POST['save_admin_reply'])) {
    // 답변을 저장하려는 글의 ID와 관리자 답변을 받아오기
    $support_id = $_POST['save_admin_reply'];
    $admin_reply = $_POST['admin_reply'][$support_id];

    // 데이터베이스 연결
    $conn = new mysqli("localhost", "root", "", "user_management");

    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    // 관리자의 답변을 customer_support 테이블에 저장
    $sql = "UPDATE customer_support SET admin_reply = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $admin_reply, $support_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // 성공적인 저장 후, 어드민 페이지로 리다이렉트
        echo "<script>alert('답변이 저장되었습니다.'); window.location.href = 'admin_page.php';</script>";
    } else {
        // 실패 시 오류 메시지 출력
        echo "<script>alert('답변 저장에 실패했습니다.'); window.location.href = 'admin_page.php';</script>";
    }

    // 데이터베이스 연결 종료
    $stmt->close();
    $conn->close();
} else {
    echo "잘못된 요청입니다.";
}
?>
