function ClickController() {
  var self = this;

  self.startUpTodo = function() {
    $('.app-list').fadeOut();
    $('.todo').animate({'left':'0'},500);
    $('.todo').fadeIn();
  };

  self.startUpMemo = function() {
    $('.app-list').fadeOut();
    $('.memo').animate({'left':'0'},500);
    $('.memo').fadeIn();
  };

  self.back = function() {
    $('.app').fadeOut();
    $('.app-list').animate({'left':'0'},500);
    $('.app-list').fadeIn();
  };
}