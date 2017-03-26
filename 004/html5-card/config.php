<?php
//データベースの接続に必要なデータソースを変数に格納
define('DB_DATABASE', 'LAA0825490-htmlcard');
define('DB_USERNAME', 'LAA0825490');
define('DB_PASSWORD', '03401881ht');
define('DSN', 'mysql:host=mysql114.phy.lolipop.lan;dbname=' . DB_DATABASE . ';charset=utf8;');

require 'password.php';

session_start();

?>