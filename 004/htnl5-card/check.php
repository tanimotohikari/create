<?php
require_once('config.php');

// ログイン状態チェック
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$point = 0;
$answer = $_POST['answer'];

if ($answer === $_POST['q1']) {
  $point++;
} else {
  $point = 0;
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
  <h1>結果</h1> 
  <p class='point'>前回の記録：<?php echo '今回の得点は' . $point . 'ポイントです'; ?></p>
  <p><a href ='./index.php'>TOPへ</a></p>
  <p><a href ='./karuta.php'>もう一度</a></p>
</body>
</html>