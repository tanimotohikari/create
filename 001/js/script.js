angular.module('App', [])
.controller('TodoController', TodoController)
.controller('MemoController',MemoController);

$(window).load(function(){
  $('.body-wrapper').fadeIn();

  $('.start-up-todo').on('click', function() {
    $('.app-list').fadeOut();
    $('.todo').fadeIn();
  });

  $('.start-up-memo').on('click', function() {
    $('.app-list').fadeOut();
    $('.memo').fadeIn();
  });

  $('.btn-back').on('click', function() {
    $('.app').fadeOut();
    $('.app-list').fadeIn();
  });
});

