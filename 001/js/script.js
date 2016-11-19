angular.module('App', [])
.controller('ClickController', ClickController)
.controller('TodoController', TodoController)
.controller('MemoController',MemoController)
.run(['$window', function ($window) {
  $('.body-wrapper').fadeIn();
    $(window).on('load resize', function(){
      var height = $(window).height();
      $('.sidein-content').css('height', height + 'px');
    });
}]);