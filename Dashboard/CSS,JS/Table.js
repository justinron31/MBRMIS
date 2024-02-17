// ─── Table Sort And Function ──────────────────────────────────
const search = document.querySelector(".input-group input"),
  table_rows = document.querySelectorAll("tbody tr"),
  table_headings = document.querySelectorAll("thead th");

// 1. Searching for specific data of HTML table
search.addEventListener("input", searchTable);

function searchTable() {
  table_rows.forEach((row, i) => {
    let table_data = row.textContent.toLowerCase(),
      search_data = search.value.toLowerCase();

    row.classList.toggle("hide", table_data.indexOf(search_data) < 0);
    row.style.setProperty("--delay", i / 25 + "s");
  });

  document.querySelectorAll("tbody tr:not(.hide)").forEach((visible_row, i) => {
    visible_row.style.backgroundColor =
      i % 2 == 0 ? "transparent" : "#0000000b";
  });
}

// 2. Sorting | Ordering data of HTML table

table_headings.forEach((head, i) => {
  let sort_asc = true;
  head.onclick = () => {
    table_headings.forEach((head) => head.classList.remove("active"));
    head.classList.add("active");

    document
      .querySelectorAll("td")
      .forEach((td) => td.classList.remove("active"));
    table_rows.forEach((row) => {
      row.querySelectorAll("td")[i].classList.add("active");
    });

    head.classList.toggle("asc", sort_asc);
    sort_asc = head.classList.contains("asc") ? false : true;

    sortTable(i, sort_asc);
  };
});

function sortTable(column, sort_asc) {
  [...table_rows]
    .sort((a, b) => {
      let first_row = a
          .querySelectorAll("td")
          [column].textContent.toLowerCase(),
        second_row = b.querySelectorAll("td")[column].textContent.toLowerCase();

      return sort_asc
        ? first_row < second_row
          ? 1
          : -1
        : first_row < second_row
        ? -1
        : 1;
    })
    .map((sorted_row) =>
      document.querySelector("tbody").appendChild(sorted_row)
    );
}

// ─── Export Popup ─────────────────────────────────────────────

function togglePopup() {
  var popup = document.getElementById("popupEX");
  if (popup.style.display === "none" || popup.style.display === "") {
    popup.style.display = "block";
    // Add event listener to close the popup when clicking anywhere on the screen
    document.addEventListener("click", closePopupOutside);
  } else {
    popup.style.display = "none";
  }
}

// Function to close the popup when clicking outside of it
function closePopupOutside(event) {
  var popup = document.getElementById("popupEX");
  var button = document.querySelector(".export__file-btn");

  if (!popup.contains(event.target) && !button.contains(event.target)) {
    popup.style.display = "none";
    // Remove the event listener after closing the popup
    document.removeEventListener("click", closePopupOutside);
  }
}

// ─── Form Account Status Edit ─────────────────────────────────
$(document).mousedown(function (event) {
  var modal = $("#customEditModal");
  if (!modal.is(event.target) && modal.has(event.target).length === 0) {
    closeCustomModal();
  }
});

function openCustomModal(userId, currentStatus, currentRole) {
  // Fetch user information before opening the modal
  fetchUserInfo(userId, function (updatedRole) {
    $("#customUserId").val(userId);
    $("#customStatus").val(currentStatus);
    $("#customRole").val(updatedRole);

    // Function to update button state based on the selected values
    function updateButtonState(selectedStatus, selectedRole) {
      $("#updateButton").prop(
        "disabled",
        selectedStatus === currentStatus && selectedRole === currentRole
      );
    }

    // Update button state based on the initially selected value
    updateButtonState(currentStatus);

    // Bind the change event to dynamically update button state
    $("#customStatus, #customRole").on("change", function () {
      var selectedStatus = $("#customStatus").val();
      var selectedRole = $("#customRole").val();
      updateButtonState(selectedStatus, selectedRole);
    });

    $("#customEditModal").show(); // Use .show() to display the modal
  });
}

function closeCustomModal() {
  $("#customEditModal").hide(); // Use .hide() to hide the modal
}

// Function to fetch user information
function fetchUserInfo(userId, callback) {
  $.ajax({
    type: "POST",
    url: "/MBRMIS/Php/fetchUserInfo.php", // Create a new PHP file to handle this request
    data: { userId: userId },
    dataType: "json",
    success: function (data) {
      // Display the first name and last name in the modal
      $("#customUserName").text(
        "Name: " + data.firstName + " " + data.lastName
      );

      // Call the callback with the updated role
      callback(data.staffRole);
    },
    error: function (error) {
      console.log("Error fetching user information: ", error);
    },
  });
}

$(document).ready(function () {
  // Check for session storage value on page load
  var showMessage = sessionStorage.getItem("showCustomPopup");
  if (showMessage) {
    // Show a custom popup if the value is set
    showCustomPopup(showMessage);
    // Clear the session storage value
    sessionStorage.removeItem("showCustomPopup");
  }

  $("#customEditForm").submit(function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Display a confirmation prompt
    var confirmation = confirm(
      "Are you sure you want to update the account status?"
    );

    if (confirmation) {
      // User clicked OK, proceed with the update

      // Serialize the form data
      var formData = $(this).serialize();

      // Send an AJAX request to updateAstatus.php
      $.ajax({
        type: "POST",
        url: "/MBRMIS/Php/updateAstatus.php",
        data: formData,
        dataType: "json", // Specify that you expect JSON in the response
        success: function (data) {
          // Check the status in the response
          if (data.status === "success") {
            // Set session storage value
            sessionStorage.setItem("showCustomPopup", data.message);
            // Close the modal
            closeCustomModal();
            // Refresh the page
            location.reload();
          } else {
            // Show a custom error popup
            showCustomPopup(data.message);
          }
        },
        error: function (error) {
          console.log("Error updating status: ", error);

          // Show a custom error popup
          showCustomPopup("Error updating account status");
        },
      });
    }
  });

  // Function to show a custom popup
  function showCustomPopup(message) {
    var popupContainer = $('<div class="custom-popup"></div>').text(message);
    $("body").append(popupContainer);

    popupContainer
      .css("display", "none")
      .fadeIn(200, function () {
        $(this).animate({ top: "-20px", opacity: 0 }, 300, function () {
          $(this).remove();
        });
      })
      .delay(2000);
  }
});

// ─── Delete User ──────────────────────────────────────────────
function deleteUser(id) {
  // Display a confirmation prompt
  var confirmation = confirm("Are you sure you want to delete this user?");

  if (confirmation) {
    $.ajax({
      type: "POST",
      url: "/MBRMIS/Php/deleteUser.php",
      data: { id: id },
      dataType: "json", // Specify that you expect JSON in the response
      success: function (data) {
        // Check the status in the response
        if (data.status === "success") {
          // Set session storage value
          sessionStorage.setItem("showCustomPopup", data.message);
          // Refresh the page
          location.reload();
        } else {
          // Show a custom error popup
          showCustomPopup(data.message);
        }
      },
      error: function (error) {
        console.log("Error deleting user: ", error);

        // Show a custom error popup
        showCustomPopup("Error deleting user");
      },
    });
  }
}

// Function to show a custom popup
function showCustomPopup(message) {
  var popupContainer = $('<div class="custom-popup"></div>').text(message);
  $("body").append(popupContainer);

  popupContainer
    .css("display", "none")
    .fadeIn(200, function () {
      $(this).animate({ top: "-20px", opacity: 0 }, 300, function () {
        $(this).remove();
      });
    })
    .delay(2000);
}
