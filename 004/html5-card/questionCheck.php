<?php
require_once('config.php');
$selectAnswer = $_POST['selectAnswer'];
$answer = $_POST['answer'];
$answerTag = $_POST['answerTag'];
$correctAnswer = intval($_POST['point']);

if ($answer === $selectAnswer) {
  $result['point'] = ++$correctAnswer;
  $result['correctAnswer'] = '現在の正解数は' . $correctAnswer . '問です';
  $result['text'] = '前回の問題は『正解』です';
  $result['answerTag'] = '';
} else {
  $result['point'] = $correctAnswer;
  $result['correctAnswer'] = '現在の正解数は' . $correctAnswer . '問です';
  $result['text'] = '前回の問題は『不正解』です';
  $result['answerTag'] = '前回の正解は『<' . $answerTag . '>』タグです';
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);

?>
