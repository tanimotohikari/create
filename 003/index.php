<?php
  require_once './settings/dsn.php';
  $sql = 'select * from data';
  $db->query($sql);
  
  $id = array();
  $type = array();
  $data01 = array();
  $data02 = array();
  $data03 = array();
  $data04 = array();
  $data05 = array();
  $data06 = array();
  $data07 = array();
  $sqls = array();
  $count = array();
  
  foreach ($db->query($sql) as $row) {
    $id[] = $row['id'];
    $type[] = $row['type'];
    $data01[] = $row['data01'];
    $data02[] = $row['data02'];
    $data03[] = $row['data03'];
    $data04[] = $row['data04'];
    $data05[] = $row['data05'];
    $data06[] = $row['data06'];
    $data07[] = $row['data07'];
  }

  for ($i=0; $i<6; $i++){
    $sqls[] = 'select count(*) from data where type =' . ($i + 1);
    $count[] = $db->query($sqls[$i]);
    $typeCount[] = $count[$i]->fetch(PDO::FETCH_NUM);
  }

  $countNum = 'select count(*) from data';
  $stmt = $db->query($countNum);
  $dataCount = $stmt->fetch(PDO::FETCH_NUM);

?>
<!DOCTYPE html>
<html lang='ja'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta http-equiv='X-UA-Compatible' content='ie=edge'>
<link rel='stylesheet' type='text/css' href='./dst/css/style.css' media='all' />
<script type='text/javascript' src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js'></script>
<script src='./src/script/script.js'></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92256551-1', 'auto');
  ga('send', 'pageview');

</script>
<title>graph</title>
<style type='text/css'>

</style>
  
</style>
</head>
<body>
<button id='js-add-graph'>グラフ作成</button>
<div id='modal-content'>
  <form action='insert.php' method='post'>
    <select name='graphtype'>
      <option value='1'>レーダー</option>
      <option value='2'>棒グラフ</option>
      <option value='3'>ドーナッツ</option>
    </select>
    data01<input type='text' name='data01'>
    data02<input type='text' name='data02'>
    data03<input type='text' name='data03'>
    data04<input type='text' name='data04'>
    data05<input type='text' name='data05'>
    data06<input type='text' name='data06'>
    data07<input type='text' name='data07'>
    <button type='submit' id='js-add-btn'>グラフを作成</button>
  </form>
</div>
<div id='grapharea'>

<?php
for($i = 0; $i < $dataCount[0]; $i++){
  if ($type[$i] == '1') {
    echo '<canvas id="graph' . ($i + 1) . '"></canvas>';
  } else if ($type[$i] == '2') {
    echo '<canvas id="graph' . ($i + 1) . '"></canvas>';
  } else if ($type[$i] == '3') {
    echo '<canvas id="graph' . ($i + 1) . '"></canvas>';
  }
?>
<script type="text/javascript">
var type = '<?php echo json_encode((int)$type[$i]); ?>'
switch (type) {
  case '1':
    graphtype = 'radar';
    break;
  case '2':
    graphtype = 'bar';
    break;
  case '3':
    graphtype = 'doughnut';
    break;
}
if (graphtype == 'radar' || graphtype == 'bar') {
  var ctx = document.getElementById('graph' + '<?php echo $i +1 ?>');
    var myChart = new Chart(ctx, {
    type: graphtype,
    data: {
      labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
      datasets: [{
        label: 'apples',
        backgroundColor: 'rgba(153,255,51,0.4)',
        borderColor: 'rgba(153,255,51,1)',
        data: [<?php echo $data01[$i] ?>, <?php echo $data02[$i]; ?>, <?php echo $data03[$i]; ?>, <?php echo $data04[$i]; ?>,<?php echo $data05[$i]; ?>, <?php echo $data06[$i]; ?>, <?php echo $data07[$i]; ?>]
      }]
    }
  });
} else if (graphtype == 'doughnut') {
  ctx = document.getElementById('graph' + '<?php echo $i +1 ?>').getContext('2d');
  var mydoughnut = new Chart(ctx, {
    type: 'doughnut',
    data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
    datasets: [{
      backgroundColor: [
        '#2ecc71',
        '#3498db',
        '#95a5a6',
        '#9b59b6',
        '#f1c40f',
        '#e74c3c',
        '#34495e'
      ],
      data: [<?php echo $data01[$i] ?>, <?php echo $data02[$i]; ?>, <?php echo $data03[$i]; ?>, <?php echo $data04[$i]; ?>,<?php echo $data05[$i]; ?>, <?php echo $data06[$i]; ?>, <?php echo $data07[$i]; ?>]
    }]
    }
  });
}

</script>
<?php
}
?>
</div>
</body>
<script type='text/javascript'>
  
</script>
</html>
