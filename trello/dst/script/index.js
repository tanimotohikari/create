$(function(){
  $('.card').hover(
    function(){
      console.log('test');
      $(this).('.card-foundation').css({'display': 'block'});
      // $(this).css({
      //   'display': 'block'
      // });
    }
  );
});