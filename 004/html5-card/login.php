<?php
require_once('config.php'); 

$errorMessage = '';
// $db['host'] = 'localhost';  // DBサーバのURL
// $db['user'] = 'hogeUser';  // ユーザー名
// $db['pass'] = 'hogehoge';  // ユーザー名のパスワード
// $db['dbname'] = 'loginManagement';  // データベース名

if (isset($_POST['login'])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST['userid'])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST['password'])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST['userid']) && !empty($_POST['password'])) {
        // 入力したユーザIDを格納
        $userid = $_POST['userid'];

        // 3. エラー処理
        try {
            $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $stmt = $pdo->prepare('SELECT * FROM userData WHERE id = ?');
            $stmt->execute(array($userid));

            $password = $_POST['password'];

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);

                    // 入力したIDのユーザー名を取得
                    $id = $row['id'];
                    $sql = 'SELECT * FROM userData WHERE id = $id';  //入力したIDからユーザー名を取得
                    $stmt = $pdo->query($sql);
                    foreach ($stmt as $row) {
                        $row['name'];  // ユーザー名
                    }
                    $_SESSION['NAME'] = $row['name'];
                    header('Location: Main.php');  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
        }
    }
}
?>

<!doctype html>
<html>
  <head>
  <meta charset='UTF-8'>
  <title>ログイン</title>
  </head>
  <body>
    <h1>ログイン画面</h1>
      <form id='loginForm' name='loginForm' action='' method='POST'>
        <fieldset>
          <legend>ログインフォーム</legend>
            <div>
              <font color='#ff0000'><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font>
            </div>
            <label for='userid'>ユーザーID</label><input type='text' id='userid' name='userid' placeholder='ユーザーIDを入力' value='<?php if (!empty($_POST['userid'])) {echo htmlspecialchars($_POST['userid'], ENT_QUOTES);} ?>'>
            <br>
            <label for='password'>パスワード</label><input type='password' id='password' name='password' value='' placeholder='パスワードを入力'>
            <br>
            <input type='submit' id='login' name='login' value='ログイン'>
        </fieldset>
      </form>
      <br>
      <form action='SignUp.php'>
        <fieldset>          
          <legend>新規登録フォーム</legend>
          <input type='submit' value='新規登録'>
        </fieldset>
      </form>
    </body>
</html>