/*LOADER ANIMATION*/
$(window).on("load", function () {
  $("#status").fadeOut();

  $("#preloader").delay(150).fadeOut("slow");

  $("body").delay(150).css({ overflow: "visible" });
});

/*AUTO FOCUS*/
window.onload = function () {
  document.getElementById("name").focus();
};

/* DROPDOWN COLOR CHANGE*/
function changeFontColor() {
  var selectBox = document.getElementById("genderSelect");
  var selectedOption = selectBox.options[selectBox.selectedIndex].value;

  if (selectedOption === "Male" || selectedOption === "Female") {
    selectBox.style.color = "#000000";
  } else {
    selectBox.style.color = "#757575";
  }
}

/*CAPITALIZED FIRST LETTER*/
function capitalizeFirstLetter(inputId) {
  var inputElement = document.getElementById(inputId);
  var inputValue = inputElement.value;

  // Capitalize the first letter
  var capitalizedValue =
    inputValue.charAt(0).toUpperCase() + inputValue.slice(1);

  // Update the input value with the capitalized one
  inputElement.value = capitalizedValue;
}

/*CAPITALIZE ALL*/
function capitalizeInput(input) {
  // Capitalize the entered text
  input.value = input.value.toUpperCase();
}

/*REGISTER MESSAGE*/
document.addEventListener("DOMContentLoaded", function () {
  // Check if the URL contains a query parameter indicating a successful registration
  var urlParams = new URLSearchParams(window.location.search);

  // Check if the registration parameter is set to success
  if (
    urlParams.has("registration") &&
    urlParams.get("registration") === "success"
  ) {
    // Display the popup
    var registerPopup = document.getElementById("registerPopup");
    if (registerPopup) {
      // Add any additional logic or styling here if needed
      registerPopup.style.display = "block";

      // Trigger the slide-up animation after a short delay
      setTimeout(function () {
        registerPopup.classList.add("slide-up");
      }, 1500); // Adjust the delay as needed

      // Hide the popup after the animation duration (adjust as needed)
      setTimeout(function () {
        registerPopup.style.display = "none";
      }, 2000); // Adjust the duration of the animation
    }
  }
});

/*LOGOUT MESSAGE*/
function getQueryParam(name) {
  const urlParams = new URLSearchParams(window.location.search);
  return urlParams.has(name) ? urlParams.get(name) : null;
}

// Function to display the logout popup if the query parameter is present
function displayLogoutPopup() {
  const logoutParam = getQueryParam("logout");

  if (logoutParam === "true") {
    // Show the popup with slide-up animation
    showLogoutPopupWithAnimation();
  }
}

// Function to display the logout popup with slide-up animation
function showLogoutPopupWithAnimation() {
  var popup = document.getElementById("LogoutPopup");
  if (popup) {
    popup.style.display = "block";

    // Trigger the slide-up animation after a short delay
    setTimeout(function () {
      popup.classList.add("slide-up");
    }, 1500);

    // Hide the popup after the animation duration (adjust as needed)
    setTimeout(function () {
      popup.style.display = "none";
      // Remove the slide-up class to reset the animation for future displays
      popup.classList.remove("slide-up");
    }, 2000);
  }
}

// Call the function to display the logout popup when the page loads
document.addEventListener("DOMContentLoaded", displayLogoutPopup);

/* CHECK THE ID NUMBER , EMAIL IF TAKEN , EMAIL FORMAT , PASSWORD CONFIRM*/
function checkAvailability(field, value) {
  var xhr = new XMLHttpRequest();
  var submitBtn = document.querySelector(".login-button");

  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4) {
      console.log("Response Text (" + field + "):", xhr.responseText);

      if (xhr.status == 200) {
        // Handle the response
        if (field === "idnumber") {
          var idnumInput = document.getElementById("idnum");

          if (xhr.responseText.trim().toLowerCase() === "taken") {
            // Display a message when the ID is already taken
            document.getElementById("validationPopup2").style.display = "block";

            // Change the focus color and shadow to red
            idnumInput.style.borderColor = "red";
            idnumInput.style.boxShadow = "0 0 5px red";
            submitBtn.disabled = true;
          } else {
            // The ID is available, hide the message and reset the focus color and shadow
            document.getElementById("validationPopup2").style.display = "none";
            idnumInput.style.borderColor = ""; // Reset to the default border color
            idnumInput.style.boxShadow = ""; // Reset to the default box shadow
            submitBtn.disabled = false;
          }
        } else if (field === "email") {
          var emailInput = document.getElementById("email");

          if (xhr.responseText.trim().toLowerCase() === "taken") {
            // Display a message when the ID is already taken
            document.getElementById("validationPopup3").style.display = "block";

            // Change the focus color and shadow to red
            emailInput.style.borderColor = "red";
            emailInput.style.boxShadow = "0 0 5px red";
            submitBtn.disabled = true;
          } else {
            // The ID is available, hide the message and reset the focus color and shadow
            document.getElementById("validationPopup3").style.display = "none";
            emailInput.style.borderColor = ""; // Reset to the default border color
            emailInput.style.boxShadow = ""; // Reset to the default box shadow
            submitBtn.disabled = false;
          }
        }
      } else {
        console.error("Request failed with status:", xhr.status);
      }
    }
  };

  // Send a GET request to the server to check availability
  xhr.open(
    "GET",
    "../Php/checkAvailability.php?field=" +
      field +
      "&value=" +
      encodeURIComponent(value),
    true
  );
  xhr.send();
}

// EMAIL FORMAT VALIDATION */
function validateEmail() {
  var emailInput = document.getElementById("email");
  var validationPopup = document.getElementById("validationPopup1");
  var submitBtn = document.querySelector(".login-button");

  var email = emailInput.value.trim();
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (email !== "" && !emailRegex.test(email)) {
    // Display a message for invalid email format
    validationPopup.style.display = "block";
    emailInput.classList.add("error-input");

    // Change the focus color and shadow to red
    emailInput.style.borderColor = "red";
    emailInput.style.boxShadow = "0 0 5px red";

    // Disable the submit button
    submitBtn.disabled = true;

    return false;
  } else {
    // Perform the asynchronous check for email availability
    checkAvailability("email", email);

    // Hide the validation popup for email format
    validationPopup.style.display = "none";
    emailInput.classList.remove("error-input");

    // Reset the focus color and shadow
    emailInput.style.borderColor = ""; // Reset to the default border color
    emailInput.style.boxShadow = ""; // Reset to the default box shadow

    // Enable the submit button if there are no validation issues
    submitBtn.disabled = false;
  }

  return true;
}

/* ID NUMBER VALIDATION */
function validateIDNumber() {
  var idnumInput = document.getElementById("idnum");
  var idnumValue = idnumInput.value;
  var submitBtn = document.querySelector(".login-button");

  // Perform the asynchronous check for ID number availability
  checkAvailability("idnumber", idnumValue);
}

/*CONFIRM PASS*/
function validatePassword() {
  var passwordInput = document.getElementById("password");
  var confirmPasswordInput = document.getElementById("confirmPassword");
  var validationPopup = document.getElementById("validationPopup");
  var submitBtn = document.querySelector(".login-button");

  var password = passwordInput.value;
  var confirmPassword = confirmPasswordInput.value;

  if (confirmPassword !== "" && password !== confirmPassword) {
    validationPopup.style.display = "block";
    passwordInput.classList.add("error-input");
    confirmPasswordInput.classList.add("error-input");

    // Change the focus color and shadow to red
    passwordInput.style.borderColor = "red";
    passwordInput.style.boxShadow = "0 0 5px red";
    confirmPasswordInput.style.borderColor = "red";
    confirmPasswordInput.style.boxShadow = "0 0 5px red";

    submitBtn.disabled = true;

    setTimeout(function () {
      validationPopup.classList.add("slide-up");
    }, 2000);

    setTimeout(function () {
      validationPopup.style.display = "none";
      validationPopup.classList.remove("slide-up");
    }, 2500);

    return false;
  } else {
    validationPopup.style.display = "none";
    passwordInput.classList.remove("error-input");
    confirmPasswordInput.classList.remove("error-input");

    passwordInput.style.borderColor = "";
    passwordInput.style.boxShadow = "";
    confirmPasswordInput.style.borderColor = "";
    confirmPasswordInput.style.boxShadow = "";
    submitBtn.disabled = false;
  }

  return true;
}

// ─── Age Validate ─────────────────────────────────────────────
function validateAge(input) {
  // Remove non-numeric characters
  input.value = input.value.replace(/\D/g, "");

  // Limit to two digits
  if (input.value.length > 2) {
    input.value = input.value.slice(0, 2);
  }
}

// ─── Password Conditions ──────────────────────────────────────
function validatePassword1() {
  var passwordInput = document.getElementById("password");
  var validationPopup = document.getElementById("validationPopup4");
  var submitBtn = document.querySelector(".login-button");

  var password = passwordInput.value.trim();
  var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

  if (password === "") {
    // Hide the validation popup and reset styles when input is empty
    validationPopup.style.display = "none";
    passwordInput.classList.remove("error-input");
    passwordInput.style.borderColor = "";
    passwordInput.style.boxShadow = "";
    submitBtn.disabled = false;
  } else if (!passwordRegex.test(password)) {
    // Display a message for invalid password format
    validationPopup.style.display = "block";
    passwordInput.classList.add("error-input");

    // Change the focus color and shadow to red
    passwordInput.style.borderColor = "red";
    passwordInput.style.boxShadow = "0 0 5px red";

    // Disable the submit button
    submitBtn.disabled = true;
  } else {
    // Hide the validation popup and reset styles when password is valid
    validationPopup.style.display = "none";
    passwordInput.classList.remove("error-input");
    passwordInput.style.borderColor = "";
    passwordInput.style.boxShadow = "";
    submitBtn.disabled = false;
  }
}

// ─── Password Conditions ──────────────────────────────────────
function validatePassword2() {
  var passwordInput = document.getElementById("password");
  var validationPopup = document.getElementById("validationPopup7");
  var submitBtn = document.querySelector(".login-button");

  var password = passwordInput.value.trim();
  var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

  if (password === "") {
    // Hide the validation popup and reset styles when input is empty
    validationPopup.style.display = "none";
    passwordInput.classList.remove("error-input");
    passwordInput.style.borderColor = "";
    passwordInput.style.boxShadow = "";
    submitBtn.disabled = false;
  } else if (!passwordRegex.test(password)) {
    // Display a message for invalid password format
    validationPopup.style.display = "block";
    passwordInput.classList.add("error-input");

    // Change the focus color and shadow to red
    passwordInput.style.borderColor = "red";
    passwordInput.style.boxShadow = "0 0 5px red";

    // Disable the submit button
    submitBtn.disabled = true;
  } else {
    // Hide the validation popup and reset styles when password is valid
    validationPopup.style.display = "none";
    passwordInput.classList.remove("error-input");
    passwordInput.style.borderColor = "";
    passwordInput.style.boxShadow = "";
    submitBtn.disabled = false;
  }
}
