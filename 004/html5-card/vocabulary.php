<?php
require_once('config.php');

// ログイン状態チェック
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$tagNumber = range(1,30);
$length = count($tagNumber);

try {
  $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  for ($i = 0; $i < $length; $i++) {
    $stmt = $pdo->prepare('SELECT id, tag, mean FROM tags WHERE id = "' . $tagNumber[$i] .'"');
    $stmt->execute();
    $rowTag[] = $stmt->fetch(PDO::FETCH_ASSOC);
  }

} catch (PDOException $e) {
  $errorMessage = 'データベースエラー';
}

?>

<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset='utf-8'>
  <title>HTML5かるた 単語帳</title>
  <script src='./js/jquery-3.2.1.min.js'></script>
  <link rel='stylesheet' type='text/css' href='./css/minireset.css'>
  <link rel='stylesheet' type='text/css' href='./css/base.css'>
  <link rel='stylesheet' type='text/css' href='./css/index.css'>
</head>
<body>
  <?php include_once("analyticstracking.php") ?>
  <header>
    <h1>HTML5かるた</h1> 
    <p><a href='./index.php'>TOPへ</a></p>
    <p><a href='karuta.php'>かるたをはじめる</a></p>
  </header>

  <div class='contents-warapper'>
    <div class='main-contents'>
      <ul class='clearfix'>
        <?php 
          foreach ($rowTag as $rowTags) {
            echo 
              '<label>
                <li class="karuta">
                  <span class="karuta-card">' . $rowTags['tag'] . '</span>
                  <p class="karuta-card">' . $rowTags['mean'] . '</p>
                </li>
              </label>';
          }
        ?>
      </ul>
    </div>
  </div>
</body>
</html>