// ─── Loader Animation ────────────────────────────────────────────────────────

$(window).on('load', function () {

  $('#status').fadeOut();


  $('#preloader').delay(150).fadeOut('slow');


  $('body').delay(150).css({ 'overflow': 'visible' });
});



// ─── Auto Focus ──────────────────────────────────────────────────────────────

window.onload = function () {
  document.getElementById("fname").focus();
};



// ─── Date And Time Picker ────────────────────────────────────────────────────

function formatDateTime(date) {
  const formattedDate = date.toISOString().split('T')[0];
  const hours = String(date.getHours()).padStart(2, '0');
  const minutes = String(date.getMinutes()).padStart(2, '0');
  return {
    dateString: formattedDate,
    timeString: `${hours}:${minutes}`
  };
}


// ─── Remove Sunday Dates ─────────────────────────────────────────────────────

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


  // ─── Restrict Past Date And Time ─────────────────────────────────────

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


 // ─── Dropdown Color Change ───────────────────────────────────────────────────

function changeFontColor() {
  var selectBox = document.getElementById("bussSelect");
  var selectedOption = selectBox.options[selectBox.selectedIndex].value;

  if (selectedOption === "Sole Proprietorship" || selectedOption === "Partnership" || selectedOption === "Corporation" || selectedOption === "Cooperative") {
    selectBox.style.color = "#000000";
  } else {
    selectBox.style.color = "#757575";
  }
}


// ─── Burger Menu ─────────────────────────────────────────────────────────────

function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}


// ─── Prompt Confirmation Message Modal ───────────────────────────────────────

window.onload = function() {
  var overlay = document.getElementById("overlay");
  var modal = document.getElementById("logoutModal");

  overlay.style.display = "block";
  modal.style.display = "block";
};

function hideModal() {
  var overlay = document.getElementById("overlay");
  var modal = document.getElementById("logoutModal");

  overlay.style.animation = "fadeOut 0.5s ease-out";
  modal.style.animation = "fadeOut 0.5s ease-out";

  overlay.addEventListener("animationend", function() {
    overlay.style.display = "none";
  });

  modal.addEventListener("animationend", function() {
    modal.style.display = "none";
  });
}

function showSecondModal() {
  var overlay2 = document.getElementById("overlay2");
  var modal2 = document.getElementById("logoutModal2");

  overlay2.style.display = "block";
  modal2.style.display = "block";
}

function redirectToHomePage() {
  window.location.href = "homepage.html#contactus";
}