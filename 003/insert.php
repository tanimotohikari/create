<?php 
  require_once './settings/dsn.php';
  $graphtype   = $_REQUEST['graphtype'];
  $data01 = $_REQUEST['data01'];
  $data02 = $_REQUEST['data02'];
  $data03 = $_REQUEST['data03'];
  $data04 = $_REQUEST['data04'];
  $data05 = $_REQUEST['data05'];
  $data06 = $_REQUEST['data06'];
  $data07 = $_REQUEST['data07'];

  try {
    $stmt = $db -> prepare("INSERT INTO data (type, data01, data02, data03, data04, data05, data06, data07) VALUES (:type, :data01, :data02, :data03, :data04, :data05, :data06, :data07)");
    $stmt->bindValue(':type', $graphtype, PDO::PARAM_INT);
    $stmt->bindValue(':data01', $data01, PDO::PARAM_INT);
    $stmt->bindValue(':data02', $data02, PDO::PARAM_INT);
    $stmt->bindValue(':data03', $data03, PDO::PARAM_INT);
    $stmt->bindValue(':data04', $data04, PDO::PARAM_INT);
    $stmt->bindValue(':data05', $data05, PDO::PARAM_INT);
    $stmt->bindValue(':data06', $data06, PDO::PARAM_INT);
    $stmt->bindValue(':data07', $data07, PDO::PARAM_INT);
    $stmt->execute();

  } catch (PDOException $e) {
    echo $e->getMessage();
   
    exit;
  }
?>

<?php
header( 'Location: http://tanimotohikari.com/' ) ; 
?>