$(function () {
  onkeydown = function(e) {
    if (e.keyCode === 32) {
      $('.main-contents, .question').removeClass('is-hide');
      $('.start-announce').addClass('is-hide');
    }
  }

  selectCard();

});

var count = 0;
var point = 0;
var $script = $('#script');
var mean = JSON.parse($script.attr('data-maen'));
var answer = JSON.parse($script.attr('data-answer'));
var answerTag = JSON.parse($script.attr('data-answerTag'));

function selectCard() {
  $('.js-karuta-card').on('click', function () {
    $(this).parent().addClass('is-selected');
    $.post('questionCheck.php', {
      selectAnswer : $(this).val(),
      answer : answer[count],
      answerTag : answerTag[count],
      point : point
    }, function(data) {
      count++;
      point = data.point;
      $('.karuta-card').removeClass('is-selected');
      $('.question').text(mean[count]);
      $('.answer-text').text(data.text);
      $('.answer-text-tag').text(data.answerTag);
      $('.answer-text-count').text(data.correctAnswer);
    });
  });
}