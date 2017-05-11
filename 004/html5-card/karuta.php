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
</head>
<?php 
$tagNumber = range(1,30);
shuffle($tagNumber);
$length = count($tagNumber);

function json_safe_encode($data){
    return json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}

for ($i = 0; $i < $length; $i ++) {
  $rand[$i] = mt_rand(0, 29); 
}

try {
  $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
  for ($i = 0; $i < $length; $i++) {
    $stmt = $pdo->prepare('SELECT id, tag, mean FROM tags WHERE id = "' . $tagNumber[$i] .'"');
    $stmt->execute();
    $rowTag[] = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  for ($i = 0; $i < $length; $i++) {
    $mean[] = $rowTag[$rand[$i]]['mean'];
    $answerTag[] = $rowTag[$rand[$i]]['tag'];
    $answer[] = $rowTag[$rand[$i]]['id'];
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
  .clearfix:after {
    content:" ";
    display:block;
    clear:both;
  }

  .is-hide {
    display: none;
  }

  .is-selected {
    background: #e53!important;
  }

  body {
    
  }

  header {
    position: fixed;
    width: 100%;
    padding: 10px 5%;
    background: #fff;
    z-index: 1;
  }

  input {
    appearance: none;
    -webkit-appearance: none;
  }

  label {
    cursor: pointer;
  }

  .contents-warapper {
    width: 95%;
    margin: 0 5%;
    padding-top: 150px;
  }

  .karuta {
    display: table;
    text-align: center;
    width: 130px;
    height: 185px;
    float: left;
    margin: 5px;
    background: #333;
    border-radius: 3px;
    box-sizing: border-box;
  }

  .karuta:hover {
    opacity: .8;
  }

  .karuta-card {
    height: 148px;
    display: table-cell;
    margin: 3px;
    color: #fff;
    font-size: 15px;
    font-weight: bold;
    vertical-align: middle;
  }

</style>
<body>
  <?php 
    include_once("analyticstracking.php");
    $_SESSION['question'] = $rowTag[$rand[0]]['mean'];
    $_SESSION['answerTag'] = $rowTag[$rand[0]]['tag'];
    $_SESSION['answer'] = $rowTag[$rand[0]]['id'];
  ?>
  <header>
    <p><a href ='./index.php'>TOPへ戻る</a></p>
    <h1>HTML5かるた</h1> 
    <p class='answer-text'></p>
    <p class='answer-text-tag'></p>
    <p class='answer-text-count'></p>
    <p class='start-announce'>Space Keyを押すとスタートします。</p>
    <p class='question is-hide'><?php echo $mean[0]; ?></p>
  </header>
  <div class='contents-warapper'>
    <div class='main-contents is-hide'>
      <form id='answer' name='' action='questionCheck.php' method='POST'>
        <ul class='clearfix'>
          <?php 
            foreach ($rowTag as $rowTags) {
              echo '<label><li class="karuta"><span class="karuta-card"><<input class=" js-karuta-card" type="radio" value="' . $rowTags['id'] . '">' . $rowTags['tag'] . '></span></li></label>';
            }
          ?>
        </ul>
      </form>
    </div>
  </div>
</body>
</html>