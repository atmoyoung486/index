<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 데이터베이스 연결
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_management";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    // POST 데이터 수집
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT);
    $nickname = $conn->real_escape_string($_POST['nickname']);
    $bank_name = $conn->real_escape_string($_POST['bank-name']);
    $account_number = $conn->real_escape_string($_POST['account_number']);
    $account_holder = $conn->real_escape_string($_POST['account_holder']);
    $phone_number = $conn->real_escape_string($_POST['phone_number']);
    $referral_code = $conn->real_escape_string($_POST['referral_code']);

    // 추천인 코드 검증
    $code_query = "SELECT * FROM generated_codes WHERE code='$referral_code'";
    $code_result = $conn->query($code_query);

    if ($code_result->num_rows > 0) {
        // 추천인 코드가 유효하면 회원가입 신청 추가
        $sql = "INSERT INTO signup_requests (username, password, nickname, bank_name, account_number, account_holder, phone_number, referral_code, status)
                VALUES ('$username', '$password', '$nickname', '$bank_name', '$account_number', '$account_holder', '$phone_number', '$referral_code', 'pending')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('회원가입 신청이 완료되었습니다 관리자 검토 후 승인처리됩니다.'); window.location.href='index.html';</script>";
        } else {
            echo "오류: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // 추천인 코드가 유효하지 않으면 경고 메시지
        echo "<script>alert('존재하지 않는 코드입니다.'); window.history.back();</script>";
    }

    $conn->close();
}
?>
