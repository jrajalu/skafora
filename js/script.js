( function( $ ) {

  // css menu
  
  $( document ).ready(function() {
  $('#cssmenu').prepend('<div id="menu-button">Menu</div>');
    $('#cssmenu #menu-button').on('click', function(){
      var menu = $(this).next('ul');
      if (menu.hasClass('open')) {
        menu.removeClass('open');
      }
      else {
        menu.addClass('open');
      }
    });
  });

  // flex slider

  $('.flexslider').flexslider({
    animation: "slide"
  });


} )( jQuery );