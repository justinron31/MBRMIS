// ─── Toogle Add Staff ─────────────────────────────────────────
function displayElements() {
  var overlay = document.querySelector(".overlayR");
  var form = document.querySelector(".residentsForm1");

  overlay.style.display = "block";
  form.style.display = "block";
}

// ─── Hide Form ────────────────────────────────────────────────
function hideElements() {
  var overlay = document.querySelector(".overlayR");
  var form = document.querySelector(".residentsForm1");

  overlay.style.display = "none";
  form.style.display = "none";
}

// ─── Edit ─────────────────────────────────────────────────────
function populateForm11(id) {
  $(".overlayR1").show();
  $(".residentsForm2").show();

  $.ajax({
    url: "../Php/fetchStaffInfo.php",
    type: "GET",
    dataType: "json",
    data: { idnumber: id }, // Make sure the key is 'idnumber'
    success: function (data) {
      // Store the initial values
      var initialIdnum = data.idnumber;
      var initialFname = data.first_name;
      var initialLname = data.last_name;

      $("#idnum").val(initialIdnum);
      $("#fname").val(initialFname);
      $("#lname").val(initialLname);

      // Get the button
      var button = $(".rSubmit2");

      // Add an event listener to each text box
      ["#idnum", "#fname", "#lname"].forEach(function (selector, index) {
        $(selector).on("input", function () {
          // Get the current values
          var currentIdnum = $("#idnum").val();
          var currentFname = $("#fname").val();
          var currentLname = $("#lname").val();

          // If any of the current values is different from the initial values, enable the button
          if (
            currentIdnum !== initialIdnum ||
            currentFname !== initialFname ||
            currentLname !== initialLname
          ) {
            button.prop("disabled", false);
          } else {
            // If all the current values are the same as the initial values, disable the button
            button.prop("disabled", true);
          }
        });
      });
    },
    error: function (error) {
      console.log(error);
    },
  });
}

function hideElements1() {
  $(".overlayR1").hide();
  $(".residentsForm2").hide();
}
