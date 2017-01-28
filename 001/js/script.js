angular.module('App', [])
.controller('ClickController', ClickController)
.controller('TodoController', TodoController)
.controller('MemoController',MemoController)
.run(['$window', function ($window) {
  $('.body-wrapper').fadeIn();
}]);