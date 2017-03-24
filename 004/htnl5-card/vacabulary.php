<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset='utf-8'>
  <title>HTNL5かるた 単語帳</title>
  <script src='./js/umbrella.min.js'></script>
</head>
<body>
  <h1>HTML5かるた</h1> 
  <p><a href='./index.php'>TOPへ</a></p>
  <p><a href='karuta.php'>かるたをはじめる</a></p>
</body>
</html>