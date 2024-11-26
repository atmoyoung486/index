<?php
function display_users_by_status($status) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "user_management";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("데이터베이스 연결 실패: " . $conn->connect_error);
    }

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
                        <th>승인</th>
                        <th>거절</th>
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
                    <td>
                        <form method='POST' action='update_status.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='hidden' name='status' value='approved'>
                            <button type='submit' class='button approve'>승인</button>
                        </form>
                    </td>
                    <td>
                        <form method='POST' action='update_status.php' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <input type='hidden' name='status' value='rejected'>
                            <button type='submit' class='button reject'>거절</button>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<p>회원이 없습니다.</p>";
    }

    $conn->close();
}
?>
