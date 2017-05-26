$(function () {
  
  startGame();
  selectCard();

});

var count = 0;
var point = 0;
var $script = $('#script');
var mean = JSON.parse($script.attr('data-maen'));
var answer = JSON.parse($script.attr('data-answer'));
var answerTag = JSON.parse($script.attr('data-answerTag'));


function startGame() {
  $('.btn-start').on('click', function () {
    $(this).addClass('is-hide');
    $('.main-contents, .question').removeClass('is-hide');
  })
}

function selectCard() {
  $('.js-karuta-card').on('click', function () {
    $.post('questionCheck.php', {
      selectAnswer : $(this).val(),
      answer : answer[count],
      answerTag : answerTag[count],
      point : point
    }, function(data) {
      count++;
      if (count === 30) {
        $('.modal-overlay').fadeIn();
      }
      point = data.point;
      var kardNumber = '#' + data.answer;
      
      if (data.successFlag) {
        $(kardNumber).css({'background': '#e53'});
      } else {
        $(kardNumber).css({
          'background': '#fff',
          'pointer-events' : 'none'
        });
      }
      $('.question').text(mean[count]);
      $('.answer-text').text(data.text);
      $('.answer-text-tag').text(data.answerTag);
      $('.answer-text-count').text(data.correctAnswer);
    });
  });
}