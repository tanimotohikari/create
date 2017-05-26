<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset='utf-8'>
  <title>HTNL5かるた</title>
  <script src='./js/umbrella.min.js'></script>
</head>
<body>
  <h1>HTML5かるた</h1> 
  <p><a href='vacabulary.php'>単語帳</a></p>
  <p><a href='karuta.php'>かるたをはじめる</a></p>
  <p><a href='logout.php'>ログアウト</a></p>
</body>
</html>