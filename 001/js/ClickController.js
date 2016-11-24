function ClickController() {
  var self = this;

  self.startUpTodo = function() {
    $('.app-list').fadeOut();
    $('.todo').fadeIn(500);
    $('.todo').animate({left: 0},500);
  };

  self.startUpMemo = function() {
    $('.app-list').fadeOut();
    $('.memo').fadeIn(500);
    $('.memo').animate({left: 0},500);
  };

  self.back = function() {
    var width = '-'+ $(window).width() + 'px';
    $('.app').animate({left: width},500);
    $('.app').fadeOut();
    $('.app-list').animate({left: 0},500);
    $('.app-list').fadeIn();
  };

  self.backList = function() {
    $('.sidein-content').animate({left: -50 + '%'},200);
  }
  
}