<?php
function display_members($status) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_management";

    // 데이터베이스 연결
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

    // 상태에 따라 회원 조회
    $sql = "SELECT * FROM signup_requests WHERE status='$status'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>아이디</th>
                        <th>닉네임</th>
                        <th>은행명</th>
                        <th>계좌번호</th>
                        <th>예금주</th>
                        <th>전화번호</th>
                    </tr>
                </thead>
                <tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['username']) . "</td>
                    <td>" . htmlspecialchars($row['nickname']) . "</td>
                    <td>" . htmlspecialchars($row['bank_name']) . "</td>
                    <td>" . htmlspecialchars($row['account_number']) . "</td>
                    <td>" . htmlspecialchars($row['account_holder']) . "</td>
                    <td>" . htmlspecialchars($row['phone_number']) . "</td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>해당 상태의 회원이 없습니다.</p>";
    }

    $conn->close();
}

function display_blocked_members() {
    display_members('rejected'); // 차단된 회원 조회
}
?>
