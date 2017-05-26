<?php
require_once('config.php'); 
$errorMessage = '';

if (isset($_POST['login'])) {
  // 1. ユーザIDの入力チェック
  if (empty($_POST['username'])) {  // emptyは値が空のとき
      $errorMessage = 'ユーザー名が未入力です。';
  } else if (empty($_POST['password'])) {
      $errorMessage = 'パスワードが未入力です。';
  }

  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    // 入力したユーザIDを格納
    $username = $_POST['username'];

    // 3. エラー処理
    try {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        $stmt = $pdo->prepare('SELECT * FROM users WHERE name = "' . $username .'"');
        $stmt->execute(array($username));
        $password = $_POST['password'];

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          if ($row['password'] == $password) {
            $_SESSION['id'] = $row['id'];
            header('Location: index.php');
            exit();
          } else {
            // 認証失敗
            $errorMessage = 'ユーザー名あるいはパスワードに誤りがあります。';
          }
        } else {
          $errorMessage = 'ユーザー名あるいはパスワードに誤りがあります。';
        }
    } catch (PDOException $e) {
      $errorMessage = 'データベースエラー';
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset = 'UTF-8'>
  <title>ログイン</title>
  <script>var _gaq = _gaq || [];</script>
  <script>
  var me = document.getElementById('a');
  function sample() { console.log("I was clicked!"); }
  function sample2() { console.log("I was clicked2!"); }
  </script>
  <link rel='stylesheet' type='text/css' href='./css/minireset.css'>
  <link rel='stylesheet' type='text/css' href='./css/base.css'>
  <link rel='stylesheet' type='text/css' href='./css/index.css'>
  </head>
  <body>
    <?php include_once("analyticstracking.php") ?>
    <h1 class='text-title'>HTML5かるた</h1>
    <div class='content'>
      <form id='loginForm' class='content-form' name='loginForm' action='' method='POST'>
        <fieldset class='content-form-inner'>
          <legend class='content-form-label'>ログインフォーム</legend>
            <div>
              <p class='text-error'><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></p>
            </div>
            <label for='username'>ニックネーム</label><input class='input-text' type='text' id='username' name='username' placeholder='ニックネームを入力' value='<?php if (!empty($_POST['username'])) {echo htmlspecialchars($_POST['username'], ENT_QUOTES);} ?>'>
            <br>
            <label for='password'>パスワード</label><input class='input-text' type='password' id='password' name='password' value='' placeholder='パスワードを入力'>
            <br>
            <input class='btn-login' type='submit' id='login' name='login' value='ログイン'>
        </fieldset>
      </form>
      <form class='content-form' action='signup.php'>
        <fieldset class='content-form-inner'>          
          <legend class='content-form-label'>新規登録フォームはこちら</legend>
          <input class='btn-add' type='submit' value='新規登録' >
        </fieldset>
      </form>
    </div>
  </body>
</html>