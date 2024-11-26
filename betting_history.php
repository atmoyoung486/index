<?php
// betting_history.php
session_start();
include 'db_connection.php'; // 데이터베이스 연결 파일 포함

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // 유저 ID 세션에서 가져오기
    $bet_date = $_POST['bet_date'];
    $type = $_POST['type'];
    $team1 = $_POST['team1'];
    $odds1 = $_POST['odds1'];
    $team2 = $_POST['team2'];
    $odds2 = $_POST['odds2'];

    $stmt = $conn->prepare("INSERT INTO betting_history (user_id, bet_date, type, team1, odds1, team2, odds2) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssdds", $user_id, $bet_date, $type, $team1, $odds1, $team2, $odds2);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
