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
  </head>
  <body>
    <?php include_once("analyticstracking.php") ?>
    <h1>ログイン画面</h1>
      <!-- <a id="a" href="#a" onmousedown="ga('send', 'event', 'カテゴリ', 'アクション', 'cm/sptop/btn', 10); sample();">テスト１</a>
      <a id="b" href="#b" onclick="sample2(); ga('send', 'event', 'カテゴリ', 'アクション', 'cm2/sptop/btn', 10);">テスト２</a> -->
      <form id='loginForm' name='loginForm' action='' method='POST'>
        <fieldset>
          <legend>ログインフォーム</legend>
            <div style='color: #f00;'>
              <?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
            </div>
            <label for='username'>ユーザーID</label><input type='text' id='username' name='username' placeholder='ユーザーIDを入力' value='<?php if (!empty($_POST['username'])) {echo htmlspecialchars($_POST['username'], ENT_QUOTES);} ?>'>
            <br>
            <label for='password'>パスワード</label><input type='password' id='password' name='password' value='' placeholder='パスワードを入力'>
            <br>
            <input type='submit' id='login' name='login' value='ログイン'>
        </fieldset>
      </form>
      <br>
      <form action='signup.php'>
        <fieldset>          
          <legend>新規登録フォーム</legend>
          <input type='submit' value='新規登録' >
        </fieldset>
      </form>
    </body>
</html>