<?php
session_start();

if (isset($_SESSION["NAME"])) {
    header('Location: login.php');
} else {
    $errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();
header('Location: login.php');
?>