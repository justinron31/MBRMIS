/*LOADER ANIMATION*/
$(window).on('load', function () {

    $('#status').fadeOut();


    $('#preloader').delay(150).fadeOut('fast');


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
        selectBox.style.color = "#000000"; // Set font color to black
    } else {
        selectBox.style.color = "#757575"; // Set font color to the default color
    }
}

/*ERROR CREDENTIALS */
