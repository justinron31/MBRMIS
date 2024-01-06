/*HOME BUTTON*/
$(document).ready(function() {
  var servicesLink = $("#homeButton");
  var servicesSection = $("#home");
  var navbarHeight = $("#nav-links").height();
  var margin = 0; // Adjust the margin value as needed

  servicesLink.click(function(event) {
    event.preventDefault();

    var targetPosition = servicesSection.offset().top;

    $('html, body').animate({
      scrollTop: targetPosition - navbarHeight - margin
    }, 350); // Adjust the animation duration as needed
  });
});

/*SERVICE BUTTON */
  $(document).ready(function() {
    var servicesLink = $("#servicesButton");
    var servicesSection = $("#service");
    var navbarHeight = $("#nav-links").height();
    var margin = 0; // Adjust the margin value as needed

    servicesLink.click(function(event) {
      event.preventDefault();

      var targetPosition = servicesSection.offset().top;

      $('html, body').animate({
        scrollTop: targetPosition - navbarHeight - margin
      }, 350); // Adjust the animation duration as needed
    });
  });

/*ABOUT US BUTTON*/
  $(document).ready(function() {
    var aboutUsButton = $("#aboutUsButton");
    var mainSection = $("#main");
    var navbarHeight = $("#nav-links").height();
    var margin = 0; // Adjust the margin value as needed

    aboutUsButton.click(function(event) {
      event.preventDefault();

      var targetPosition = mainSection.offset().top;

      $('html, body').animate({
        scrollTop: targetPosition - navbarHeight - margin
      }, 350); // Adjust the animation duration as needed
    });
  });

  /*CONTACT US*/
  $(document).ready(function() {
    var aboutUsButton = $("#contactusButton");
    var mainSection = $("#contactus");
    var navbarHeight = $("#nav-links").height();
    var margin = 0; // Adjust the margin value as needed

    aboutUsButton.click(function(event) {
      event.preventDefault();

      var targetPosition = mainSection.offset().top;

      $('html, body').animate({
        scrollTop: targetPosition - navbarHeight - margin
      }, 350); // Adjust the animation duration as needed
    });
  });

 

/*LOADER ANIMATION*/
$(window).on('load', function() { 

  $('#status').fadeOut();

  
  $('#preloader').delay(10).fadeOut('fast');


  $('body').delay(10).css({'overflow':'visible'});
});


/*BURGER MENU*/
function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}