<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Barangay management system for makiling" />
  <meta name="keywords" content="Web Development, Barangay Management System" />
  <meta name="authors" content="Arcillas, Galang, Ignacio" />


  <!-- IMPORTS-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


  <!--CSS-->
  <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png" />
  <link rel="stylesheet" href="../Website/CSS,JS/BarangayClearance.css" />

  <!--JAVASCRIPT-->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="../Website/CSS,JS/BarangayClearance.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
  // Get the button and timer elements
  var okayButton = document.getElementById("okayButton");
  var timerElement = document.getElementById("timer");

  // Function to disable the button and start the timer
  function disableButtonAndStartTimer() {
    okayButton.disabled = true; // Disable the button
    var seconds = 5; // Timer duration in seconds

    // Update the timer text every second
    var timerInterval = setInterval(function () {
      seconds--;
      timerElement.textContent = " (" + seconds + "s)";

      if (seconds <= 0) {
        clearInterval(timerInterval); // Stop the timer
        timerElement.textContent = ""; // Clear the timer text
        okayButton.disabled = false; // Enable the button
      }
    }, 1000);
  }

  // Call the function to disable the button and start the timer after a delay
  setTimeout(disableButtonAndStartTimer, 1000); // Delay of 1000 milliseconds (1 second)
});

</script>

  <title>Tracking Number</title>
</head>

<body>

  <!-- MODAL POPUP1-->
  <div id="overlay" class="overlay1"></div>
  <div id="logoutModal" class="modal">
    <div class="modal-message">
      <h3>Tracking Number</h3>
      <p>
        <strong style="color: red;">Copy and save</strong> the tracking number below and use it to track the status of
        your file request. <i>( Click on the tracking number to copy it to your clipboard )</i>
      </p>

      <?php
    session_start();
    $trackingNumber = isset($_SESSION['tracking_number']) ? $_SESSION['tracking_number'] : 'Not available';
    ?>
      <h4> Tracking number:</h4>

      <h1 id="tracking-number" onclick="copyToClipboard()">
        <?php echo $trackingNumber; ?>
      </h1>


    </div>
    
   <div class="modal-buttons">
    <button id="okayButton" class="yes" onclick="showSecondModal()">Okay<span id="timer"></span></button>
  </div>
  </div>
  
  

  <!-- MODAL POPUP2-->
  <div id="overlay2" class="overlay2"></div>
  <div id="logoutModal2" class="modal1">
    <h3>Track Request</h3>
    <p class="about-text">
      You can proceed to the <strong>Track Request Document</strong> and paste your tracking number to see the status of
      your
      request.
    </p>
    <br />
    <div class="modal-buttons">
      <a href="../Website/trackRequest.html">
        <button class="yes">Proceed</button>
      </a>
    </div>
  </div>

</body>

<script>
  function copyToClipboard() {
    // Create a new textarea element and give it id='temp_element'
    var textarea = document.createElement('textarea')
    textarea.id = 'temp_element'
    // Optional step to make less noise on the page, if any!
    textarea.style.height = 0
    // Now append it to your page somewhere, I chose <body>
    document.body.appendChild(textarea)
    // Give our textarea a value of whatever inside the div of id=containerid
    textarea.value = document.getElementById('tracking-number').innerText
    // Now copy whatever inside the textarea to clipboard
    var selector = document.querySelector('#temp_element')
    selector.select()
    document.execCommand('copy')
    // Remove the textarea
    document.body.removeChild(textarea)
    alert('Tracking number copied to clipboard');
  }
  
  document.addEventListener("DOMContentLoaded", function () {
  // Get the button, timer, and tracking number elements
  var okayButton = document.getElementById("okayButton");
  var timerElement = document.getElementById("timer");

  // Function to disable the button and start the timer
  function disableButtonAndStartTimer() {
    okayButton.disabled = true; // Disable the button
    var seconds = 5; // Timer duration in seconds

    // Update the timer text every second
    var timerInterval = setInterval(function () {
      seconds--;
      timerElement.textContent = " (" + seconds + "s)";

      if (seconds <= 0) {
        clearInterval(timerInterval); // Stop the timer
        timerElement.textContent = ""; // Clear the timer text
        okayButton.disabled = false; // Enable the button
      }
    }, 1000);
  }

  // Call the function when the modal is displayed
  // Here, I'm assuming you're using some code to show the modal
  // Replace 'showModalFunction' with your actual function to display the modal
  showModalFunction();

  // Disable the button and start the timer when the modal is displayed
  disableButtonAndStartTimer();
});

  
</script>






</html>