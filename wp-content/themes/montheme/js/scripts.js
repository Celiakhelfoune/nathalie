jQuery(document).ready(function($) {
    $('.burger-menu').click(function() {
      $(this).toggleClass('active');
      $('.monmenu ul').toggleClass('left-align');
      $('.monmenu ul').slideToggle();
    });
  });
  