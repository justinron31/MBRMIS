/*LOADER ANIMATION*/
$(window).on('load', function() { 

    $('#status').fadeOut();

    
    $('#preloader').delay(350).fadeOut('slow');


    $('body').delay(350).css({'overflow':'visible'});
});

/*AUTO FOCUS*/
window.onload = function() {
    document.getElementById("name").focus();
  };
  