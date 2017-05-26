<?php
require_once('config.php');
$selectAnswer = $_POST['selectAnswer'];
$answer = $_POST['answer'];
$answerTag = $_POST['answerTag'];
$correctAnswer = intval($_POST['point']);

if ($answer === $selectAnswer) {
  $result['point'] = ++$correctAnswer;
  $result['correctAnswer'] = $correctAnswer;
  $result['text'] = '前回の問題は『正解』です';
  $result['answerTag'] = '';
  $result['successFlag'] = 1;
} else {
  $result['point'] = $correctAnswer;
  $result['correctAnswer'] = $correctAnswer;
  $result['text'] = '前回の問題は『不正解』です';
  $result['answerTag'] = '前回の正解は『<' . $answerTag . '>』タグです';
  $result['successFlag'] = 0;
  $result['answer'] = $answer;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);

?>
