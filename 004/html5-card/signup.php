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

          $stmt = $pdo->prepare('SELECT * FROM users WHERE name = "' . $username .'"');
          $stmt->execute(array($username));

          if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['password'] == $password) {
              $_SESSION['id'] = $row['id'];
              header('Location: index.php');
              exit();
            }
          }
        
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
      <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
      <div><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>
      <label for='username'>ニックネーム</label><input type='text' id='username' name='username' placeholder='ニックネームを入力' value='<?php if (!empty($_POST['username'])) {echo htmlspecialchars($_POST['username'], ENT_QUOTES);} ?>'>
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