/*LOADER ANIMATION*/
$(window).on('load', function () {

    $('#status').fadeOut();


    $('#preloader').delay(150).fadeOut('slow');


    $('body').delay(150).css({ 'overflow': 'visible' });
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


/*CONFIRM PASS*/
function validatePassword() {
    var passwordInput = document.getElementById("password");
    var confirmPasswordInput = document.getElementById("confirmPassword");

    var password = passwordInput.value;
    var confirmPassword = confirmPasswordInput.value;

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
        passwordInput.classList.add("error-input"); // Add the error class to password field
        confirmPasswordInput.classList.add("error-input"); // Add the error class to confirm password field
        return false;
    } else {
        passwordInput.classList.remove("error-input"); // Remove the error class from password field if it was previously added
        confirmPasswordInput.classList.remove("error-input"); // Remove the error class from confirm password field if it was previously added
    }

    return true;
}

/*CAPITALIZED FIRST LETTER*/
function capitalizeFirstLetter(inputId) {
    var inputElement = document.getElementById(inputId);
    var inputValue = inputElement.value;

    // Capitalize the first letter
    var capitalizedValue = inputValue.charAt(0).toUpperCase() + inputValue.slice(1);

    // Update the input value with the capitalized one
    inputElement.value = capitalizedValue;
}

/*EMAIL VERIFY*/
function validateEmail() {
    var emailInput = document.getElementById("email");
    var email = emailInput.value;

    // Regular expression for basic email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address");
        emailInput.classList.add("error-input"); // Add the error class
        return false;
    } else {
        emailInput.classList.remove("error-input"); // Remove the error class if it was previously added
    }

    return true;
}


/*RECORD LOGIN*/


