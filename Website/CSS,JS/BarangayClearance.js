// ─── Loader Animation ────────────────────────────────────────────────────────

$(window).on("load", function () {
  $("#status").fadeOut();

  $("#preloader").delay(150).fadeOut("slow");

  $("body").delay(150).css({ overflow: "visible" });
});

// ─── Auto Focus ──────────────────────────────────────────────────────────────

window.onload = function () {
  document.getElementById("fname").focus();
};

// ─── Date And Time Picker ────────────────────────────────────────────────────

function formatDateTime(date) {
  const formattedDate = date.toISOString().split("T")[0];
  const hours = String(date.getHours()).padStart(2, "0");
  const minutes = String(date.getMinutes()).padStart(2, "0");
  return {
    dateString: formattedDate,
    timeString: `${hours}:${minutes}`,
  };
}

// ─── Restrict Past Date And Time ─────────────────────────────────────
document.addEventListener("DOMContentLoaded", function () {
  var datepicker = document.getElementById("datepicker");
  var timepicker = document.getElementById("timepicker");

  datepicker.addEventListener("input", function () {
    var currentDate = new Date();
    var selectedDate = new Date(datepicker.value);

    currentDate.setHours(0, 0, 0, 0);
    selectedDate.setHours(0, 0, 0, 0);

    if (selectedDate < currentDate) {
      showCustomAlert("alerPopup");
      datepicker.value = "";
      timepicker.value = "";
      datepicker.style.borderColor = "red";
      datepicker.style.boxShadow = "0 0 5px red";
    } else if (selectedDate.getDay() === 0) {
      showCustomAlert("alerPopup1");
      datepicker.value = "";
      datepicker.style.borderColor = "red";
      datepicker.style.boxShadow = "0 0 5px red";
    } else {
      // It's not in the past, reset the styles to default
      datepicker.style.borderColor = ""; // Set to default border color
      datepicker.style.boxShadow = ""; // Remove the box shadow
      timepicker.style.borderColor = ""; // Set to default border color
      timepicker.style.boxShadow = ""; // Remove the box shadow
    }
  });

  timepicker.addEventListener("input", function () {
    var currentDate = new Date();
    var selectedDate = new Date(datepicker.value + "T" + timepicker.value);

    // Check if the selected time is in the past
    if (selectedDate < currentDate) {
      showCustomAlert("alerPopup");
      timepicker.value = "";
      timepicker.style.borderColor = "red";
      timepicker.style.boxShadow = "0 0 5px red";
    } else {
      // It's not in the past, reset the styles to default
      timepicker.style.borderColor = ""; // Set to default border color
      timepicker.style.boxShadow = ""; // Remove the box shadow
    }
  });
});

function showCustomAlert(alertId) {
  var customAlert = document.getElementById(alertId);
  customAlert.style.display = "block";

  setTimeout(function () {
    customAlert.style.display = "none";
  }, 3000); // Hide the alert after 3 seconds
}

// ─── Dropdown Color Change ───────────────────────────────────────────────────
function changeFontColor(dropDownId) {
  var selectBox = document.getElementById(dropDownId);
  var selectedOption = selectBox.options[selectBox.selectedIndex].value;

  if (selectedOption !== "") {
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

window.onload = function () {
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

  overlay.addEventListener("animationend", function () {
    overlay.style.display = "none";
  });

  modal.addEventListener("animationend", function () {
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

// ─── Id Upload Preview ────────────────────────────────────────
function previewImage() {
  var preview = document.getElementById("preview");
  var fileInput = document.getElementById("avatar");
  var file = fileInput.files[0];

  if (file) {
    var reader = new FileReader();

    reader.onload = function (e) {
      preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
    preview.style.display = "block"; // Show the image preview
  } else {
    preview.src = "";
    preview.style.display = "none"; // Hide the image preview
  }
}
