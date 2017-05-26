<?php
require_once('config.php');

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
<script type='text/javascript'>

  var count = 0;
  var tagNumber;
  var questionNumber = 0;
  var choice = [];
  document.onkeydown = function(e) {
    if (e.keyCode === 32) {
      u('.main-contents').removeClass('is-hide');
      u('.start-announce').addClass('is-hide');
    }
  }

  function check() {
    u('.check').addClass('is-hide');
    u('.point').removeClass('is-hide');
  }

</script>
<?php 
$point = 0;
$tagNumber = range(1,30);
$meanNumber = range(1, 30);
shuffle($tagNumber);
shuffle($meanNumber);
try {
  $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  for ($i = 0; $i < 10; $i++) {
    $stmt = $pdo->prepare('SELECT id, tag FROM tags WHERE id = "' . $tagNumber[1] .'"');
    $stmt->execute();
  }
  $rowTag = $stmt->fetch(PDO::FETCH_ASSOC);
  $answer = $rowTag['id'];
  
} catch (PDOException $e) {
  $errorMessage = 'データベースエラー';
}

for ($i = 0; $i < 2; $i++) {
  $select[$i] = $meanNumber[$i];
}
array_push($select, $tagNumber[1]);
shuffle($select);

try {
  $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  $stmt = $pdo->prepare('SELECT id, mean FROM tagmean WHERE id = "' . $select[0] .'" or id = "' . $select[1] . '" or id = "' . $select[2] . '"');
  $stmt->execute();
} catch (PDOException $e) {
  $errorMessage = 'データベースエラー';
}

?>
<style>
  .is-hide {
    display: none;
  }
</style>
<body>
  <h1>HTML5かるた</h1> 
  <p class='point'>前回の記録：<?php echo $point; ?></p>
  <p><a href ='./index.php'>TOPへ</a></p>
  <p class ='start-announce'>Space Keyを押すとスタートします。</a></p>
  <div class ='main-contents is-hide'>
    <form id='answer' name='' action='check.php' method='POST'>
      <p class='question'><?php echo $rowTag['tag']; ?></p>
      <?php 
        foreach ($stmt as $rowMean) {
          echo '<input name="q1" type="radio" value="' . $rowMean['id'] . '">' . $rowMean['mean'] . '<br>';
        }
      ?>
      <input type="hidden" name='answer' value='<?php echo $answer; ?>'>
      <input class='check' type='submit' name='check' value='送信'>
    </form>
  </div>
</body>
</html>