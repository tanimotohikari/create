<?php
//データベースの接続に必要なデータソースを変数に格納
define('DB_DATABASE', 'LAA0825490-tanimoto');
define('DB_USERNAME', 'LAA0825490');
define('DB_PASSWORD', '03401881ht');
define('PDO_DSN', 'mysql:host=mysql114.phy.lolipop.lan;dbname=' . DB_DATABASE . ';charset=utf8;');

try {
  $db = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch (PDOException $e) {
  // エラーメッセージを表示させる
  echo $e->getMessage();
 
  // 強制終了
  exit;
 
}

?>