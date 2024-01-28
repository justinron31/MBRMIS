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
    var validationPopup = document.getElementById("validationPopup");

    var password = passwordInput.value;
    var confirmPassword = confirmPasswordInput.value;

    if (password !== confirmPassword) {
        validationPopup.style.display = "block";
        passwordInput.classList.add("error-input");
        confirmPasswordInput.classList.add("error-input");


        setTimeout(function () {
            validationPopup.classList.add('slide-up');
        }, 2000);


        setTimeout(function () {
            validationPopup.style.display = "none";
            validationPopup.classList.remove('slide-up');
        }, 2500);
        return false;
    } else {
        validationPopup.style.display = "none";
        passwordInput.classList.remove("error-input");
        confirmPasswordInput.classList.remove("error-input");
    }

    return true;
}



/*EMAIL VERIFY*/
function validateEmail() {
    var emailInput = document.getElementById("email");
    var validationPopup = document.getElementById("validationPopup1");

    var email = emailInput.value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!emailRegex.test(email)) {
        validationPopup.style.display = "block";
        emailInput.classList.add("error-input");


        setTimeout(function () {
            validationPopup.classList.add('slide-up');
        }, 2000);


        setTimeout(function () {
            validationPopup.style.display = "none";
            validationPopup.classList.remove('slide-up');
        }, 2500);

        return false;
    } else {
        validationPopup.style.display = "none";
        emailInput.classList.remove("error-input");
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
    if (urlParams.has('registration') && urlParams.get('registration') === 'success') {
        // Display the popup
        var registerPopup = document.getElementById("registerPopup");
        if (registerPopup) {
            // Add any additional logic or styling here if needed
            registerPopup.style.display = "block";

            // Trigger the slide-up animation after a short delay
            setTimeout(function () {
                registerPopup.classList.add('slide-up');
            }, 1500);  // Adjust the delay as needed

            // Hide the popup after the animation duration (adjust as needed)
            setTimeout(function () {
                registerPopup.style.display = "none";
            }, 2000);  // Adjust the duration of the animation
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
    const logoutParam = getQueryParam('logout');

    if (logoutParam === 'true') {
        // Show the popup with slide-up animation
        showLogoutPopupWithAnimation();
    }
}

// Function to display the logout popup with slide-up animation
function showLogoutPopupWithAnimation() {
    var popup = document.getElementById('LogoutPopup');
    if (popup) {
        popup.style.display = 'block';

        // Trigger the slide-up animation after a short delay
        setTimeout(function () {
            popup.classList.add('slide-up');
        }, 1500);

        // Hide the popup after the animation duration (adjust as needed)
        setTimeout(function () {
            popup.style.display = 'none';
            // Remove the slide-up class to reset the animation for future displays
            popup.classList.remove('slide-up');
        }, 2000);
    }
}

// Call the function to display the logout popup when the page loads
document.addEventListener('DOMContentLoaded', displayLogoutPopup);




