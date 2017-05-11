<?php
require_once('config.php');

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = '';
$signUpMessage = '';

// ログインボタンが押された場合
if (isset($_POST['signUp'])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST['username'])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST['password'])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST['password2'])) {
        $errorMessage = 'パスワードが未入力です。';
    }

  if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2']) && $_POST['password'] === $_POST['password2']) {
      // 入力したユーザIDとパスワードを格納
      $username = $_POST['username'];
      $password = $_POST['password'];

      // 3. エラー処理
      try {
          $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

          $stmt = $pdo->prepare('INSERT INTO users(name, password) VALUES (?, ?)');

          $stmt->execute(array($username, $password));  
          $userid = $pdo->lastinsertid();
          echo 'test';
          exit;
          header('Location: index.php');
      } catch (PDOException $e) {
          $errorMessage = 'データベースエラー';
      }
    } else if($_POST['password'] != $_POST['password2']) {
        $errorMessage = 'パスワードに誤りがあります。';
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset='UTF-8'>
    <title>新規登録</title>
  </head>
  <body>
    <?php include_once("analyticstracking.php") ?>
    <h1>新規登録画面</h1>
    <form id='loginForm' name='loginForm' action='' method='POST'>
      <fieldset>
      <legend>新規登録フォーム</legend>
      <div style='color: #ff0000;'><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
      <div style='color: #0000ff;'><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
      <label for='username'>ユーザー名</label><input type='text' id='username' name='username' placeholder='ユーザー名を入力' value='<?php if (!empty($_POST['username'])) {echo htmlspecialchars($_POST['username'], ENT_QUOTES);} ?>'>
      <br>
      <label for='password'>パスワード</label><input type='password' id='password' name='password' value='' placeholder='パスワードを入力'>
      <br>
      <label for='password2'>パスワード(確認用)</label><input type='password' id='password2' name='password2' value='' placeholder='再度パスワードを入力'>
      <br>
      <input type='submit' id='signUp' name='signUp' value='新規登録'>
      </fieldset>
    </form>
  </body>
</html>