<?php
// アプリケーション設定
define('CONSUMER_KEY', '606198733398-5p7ehdptutqd1d9tct6tohjk9jotbeu3.apps.googleusercontent.com');
define('CONSUMER_SECRET', '5AiOpSUoXWuw9nc3ORiF2GmP');
define('CALLBACK_URL', 'http://tanimotohikari.com/google/oauth.php');

define('TOKEN_URL', 'https://accounts.google.com/o/oauth2/token');
define('INFO_URL', 'https://www.googleapis.com/oauth2/v1/userinfo');

$params = array(
  'code' => $_GET['code'],
  'grant_type' => 'authorization_code',
  'redirect_uri' => CALLBACK_URL,
  'client_id' => CONSUMER_KEY,
  'client_secret' => CONSUMER_SECRET,
);

$params = http_build_query($params, "", "&");

$header = array(
  'Content-Type: application/x-www-form-urlencoded',
  'Content-Length: ' .strlen($params)
);

// POST送信
$options = array('http' => array(
  'method' => 'POST',
  'header' => implode("\r\n", $header),
  'content' => $params
));

// アクセストークンの取得
$res = file_get_contents(TOKEN_URL, false, stream_context_create($options));

// レスポンス取得
$token = json_decode($res, true);
if(isset($token['error'])){
  echo 'エラー発生';
  exit;
}

$access_token = $token['access_token'];

$params = array('access_token' => $access_token);

// ユーザー情報取得
$res = file_get_contents(INFO_URL . '?' . http_build_query($params));

//表示
echo $res;
?>