<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_management";

    // 데이터베이스 연결
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    // 입력값 가져오기
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // 유저 데이터 조회
    $sql = "SELECT * FROM signup_requests WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // 상태에 따라 메시지 처리
        if ($user['status'] === 'pending') {
            echo "<script>
                alert('승인 대기중입니다.');
                window.location.href = 'index.html';
            </script>";
        } elseif ($user['status'] === 'rejected') {
            echo "<script>
                alert('차단된 회원입니다.');
                window.location.href = 'index.html';
            </script>";
        } elseif ($user['status'] === 'approved' && password_verify($password, $user['password'])) {
            echo "<script>
                alert('로그인 성공!');
                window.location.href = 'main.html'; // 어드민 페이지로 이동
            </script>";
        } else {
            echo "<script>
                alert('아이디 또는 비밀번호가 잘못되었습니다.');
                window.location.href = 'index.html';
            </script>";
        }
    } else {
        echo "<script>
            alert('등록되지 않은 회원입니다.');
            window.location.href = 'index.html';
        </script>";
    }

    $conn->close();
}
?>
