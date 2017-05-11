<?php
session_start();

// ログイン状態チェック
if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset='utf-8'>
  <title>HTML5かるた</title>
  <script src='./js/jquery-3.2.1.min.js'></script>
  <script type="text/javascript">
 
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-92256551-1']);
    _gaq.push(['_trackPageview']);
     
    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl (https://ssl/)' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
     
  </script>
  <?php include_once("analyticstracking.php") ?>
</head>
<body>
  <a class="test01" href="#test" onClick="_gaq.push(['_trackEvent', ‘内部リンク’, ‘クリック’, ‘/index/test01/aaa’, true]);">テスト</a>
  <h1>HTML5かるた</h1> 
  <p><a href='vocabulary.php'>単語帳</a></p>
  <p><a href='karuta.php'>かるたをはじめる</a></p>
  <p><a href='logout.php'>ログアウト</a></p>
</body>
<script type="text/javascript">
  $(function() {  
    $(".test01").on('click', function() {        
      console.log('test');
    });
        
    });
</script>
</html>