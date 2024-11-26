<?php
session_start();
session_unset(); // 세션 데이터 초기화
session_destroy(); // 세션 종료

// index.html로 리디렉션
header('Location: index.html');
exit;
?>
