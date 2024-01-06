/*LOADER ANIMATION*/
$(window).on('load', function() { 

    $('#status').fadeOut();

    
    $('#preloader').delay(150).fadeOut('slow');


    $('body').delay(150).css({'overflow':'visible'});
});

/*AUTO FOCUS*/
window.onload = function() {
    document.getElementById("fname").focus();
  };
  

/*DATE AND TIME PICKER */
// Function to format the date and time
function formatDateTime(date) {
    const formattedDate = date.toISOString().split('T')[0];
    const hours = String(date.getHours()).padStart(2, '0');
    const minutes = String(date.getMinutes()).padStart(2, '0');
    return {
        dateString: formattedDate,
        timeString: `${hours}:${minutes}`
    };
}

/*REMOVE SUNDAY DATES*/
document.addEventListener('DOMContentLoaded', function () {

    var datepicker = document.getElementById('datepicker');

    datepicker.addEventListener('input', function () {

      var selectedDate = new Date(datepicker.value);
   
      if (selectedDate.getDay() === 0) {
        alert('No Operations every Sundays. Please choose another date.');
        datepicker.value = ''; 
      }
    });
  });


/*  RESTRICT PAST DATE AND TIME */
document.addEventListener('DOMContentLoaded', function () {
    var datepicker = document.getElementById('datepicker');
    var timepicker = document.getElementById('timepicker');

    datepicker.addEventListener('input', function () {
      var currentDate = new Date();
      var selectedDate = new Date(datepicker.value);

     
      currentDate.setHours(0, 0, 0, 0);
      selectedDate.setHours(0, 0, 0, 0);

      if (selectedDate < currentDate) {
        alert('Please choose a date and time in the future.');
        datepicker.value = '';
        timepicker.value = '';
      } else if (selectedDate.getDay() === 0) {
        alert('Sundays are not allowed. Please choose another date.');
        datepicker.value = '';
        timepicker.value = '';
      }
    });

    timepicker.addEventListener('input', function () {
      var currentDate = new Date();
      var selectedDate = new Date(datepicker.value + 'T' + timepicker.value);

      // Check if the selected time is in the past
      if (selectedDate < currentDate) {
        alert('Please choose a date and time in the future.');
        
        timepicker.value = '';
      }
    });
  });


 /* DROPDOWN COLOR CHANGE*/
function changeFontColor() {
  var selectBox = document.getElementById("bussSelect");
  var selectedOption = selectBox.options[selectBox.selectedIndex].value;

  if (selectedOption === "Sole Proprietorship" || selectedOption === "Partnership" || selectedOption === "Corporation" || selectedOption === "Cooperative") {
      selectBox.style.color = "#000000"; 
  } else {
      selectBox.style.color = "#757575"; 
  }
}
