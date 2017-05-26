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
  <title>HTML5かるた 単語帳</title>
  <script src='./js/jquery-3.2.1.min.js'></script>
  <link rel='stylesheet' type='text/css' href='./css/minireset.css'>
  <link rel='stylesheet' type='text/css' href='./css/base.css'>
  <link rel='stylesheet' type='text/css' href='./css/index.css'>
</head>
<?php 
$tagNumber = range(1,30);
shuffle($tagNumber);
$length = count($tagNumber);

function json_safe_encode($data){
    return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}

try {
  $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  for ($i = 0; $i < $length; $i++) {
    $stmt = $pdo->prepare('SELECT id, tag, mean FROM tags WHERE id = "' . $tagNumber[$i] .'"');
    $stmt->execute();
    $rowTag[] = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  $Number = range(0,29);
  shuffle($Number);

  for ($i = 0; $i < $length; $i++) {
    $mean[] = $rowTag[$Number[$i]]['mean'];
    $answerTag[] = $rowTag[$Number[$i]]['tag'];
    $answer[] = $rowTag[$Number[$i]]['id'];
  }

} catch (PDOException $e) {
  $errorMessage = 'データベースエラー';
}

?>
<script id="script" type='text/javascript' src='./js/index.js' 
  data-maen = '<?php echo json_safe_encode($mean); ?>';
  data-answer = '<?php echo json_safe_encode($answer); ?>';
  data-answerTag = '<?php echo json_safe_encode($answerTag); ?>';
>
</script>
<style>
.modal-overlay {
  height: 100%;
  background: rgba(0,0,0,0.5);
  position: fixed;
  z-index: 5;
  top: 0;
  left: 0;
  width: 100%;
  display: none;
}

.modal-content {
  width:50%;
  margin:1.5em auto 0;
  padding:10px 20px;
  border:2px solid #aaa;
  background:#fff;
  z-index:10;
}
</style>
<body>
  <?php include_once("analyticstracking.php"); ?>
  <header>
    <p><a href ='./index.php'>TOPへ戻る</a></p>
    <h1>HTML5かるた</h1> 
    <p>問題は全<?php echo $length?>問です</p>
    <p class='answer-text'></p>
    <p class='answer-text-tag'></p>
    <p class='btn btn-start'>ここをクリックするとゲームがスタートします。</p>
    <p class='question is-hide'><?php echo $mean[0]; ?></p>
  </header>
  <div class='contents-warapper'>
    <div class='main-contents is-hide'>
      <form id='answer' name='' action='questionCheck.php' method='POST'>
        <ul class='clearfix'>
          <?php 
            foreach ($rowTag as $rowTags) {
              echo '<label><li id="' . $rowTags['id'] . '" class="karuta"><span class="karuta-card"><<input class=" js-karuta-card" type="radio" value="' . $rowTags['id'] . '">' . $rowTags['tag'] . '></span></li></label>';
            }
          ?>
        </ul>
      </form>
    </div>
  </div>
  <div class='modal-overlay'>
    <div class='modal-content'>
      <p>今回の結果</p>
      <span class='answer-text-count'></span>
      <span>問正解です。</span>
      <p><a href='karuta.php'>もう一度挑戦する</a></p>
    </div>
  </div>
</body>
</html>