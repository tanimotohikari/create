<?php
require_once('config.php');

// ログイン状態チェック
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
//初期のポイント
if (empty($_SESSION['challengeFlag']) or $_SESSION['challengeFlag'] !== 1) {
  $_SESSION['challengeFlag'] = 1;
  $_SESSION['point'] = 0;
}


if ($_SESSION['answer'] === $_POST['q1']) {
  $_SESSION['point']++;
  $_SESSION['result'] = '正解';
} else {
  $_SESSION['result'] = '不正解';
}

header('Location: http://tanimotohikari.com/karuta.php');
exit;

?>
