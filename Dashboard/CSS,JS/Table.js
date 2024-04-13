// ─── Form Account Status Edit ─────────────────────────────────
$(document).ready(function () {
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

      // Update button state based on the initially selected values
      updateButtonState(currentStatus, currentRole);

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
      url: "../Php/fetchUserInfo.php", // Create a new PHP file to handle this request
      data: { userId: userId },
      dataType: "json",
      success: function (data) {
        // Display the first name, last name, last login timestamp and date created in the modal
        $("#customUserName").html(
          "<strong>Name:</strong> " + data.firstName + " " + data.lastName
        );
        $("#lastLoginTimestamp").html(
          "<strong>Last Login:</strong> " + data.lastLoginTimestamp
        );
        $("#dateCreated").html(
          "<strong>Date Created: </strong>" + data.dateCreated
        );

        // Call the callback with the updated role
        callback(data.staffRole);
      },
      error: function (error) {
        console.log("Error fetching user information: ", error);
      },
    });
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
    url: "../Php/fetchUserInfo.php", // Create a new PHP file to handle this request
    data: { userId: userId },
    dataType: "json",
    success: function (data) {
      // Display the first name, last name, last login timestamp and date created in the modal
      $("#customUserName").html(
        "<strong>Name:</strong> " + data.firstName + " " + data.lastName
      );
      $("#lastLoginTimestamp").html(
        "<strong>Last Login:</strong> " + data.lastLoginTimestamp
      );
      $("#dateCreated").html(
        "<strong>Date Created: </strong>" +
          new Date(data.dateCreated).toLocaleDateString("en-US", {
            month: "long",
            day: "numeric",
            year: "numeric",
          })
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
        url: "../Php/updateAstatus.php",
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

// ─── Delete MODAL ──────────────────────────────────────────────

function showDeleteModal(id) {
  document.querySelector(".overlayD").style.display = "block";
  document.querySelector(".modalD").style.display = "block";

  var yesButton = document.querySelector(".yes1");
  yesButton.disabled = true;

  var counter = 5;
  yesButton.innerText = `Yes (${counter})`;

  var intervalId = startTimer(yesButton, counter);

  yesButton.addEventListener("click", function () {
    deleteUser(id);
    clearInterval(intervalId);
  });

  document.querySelector(".no1").addEventListener("click", function () {
    document.querySelector(".overlayD").style.display = "none";
    document.querySelector(".modalD").style.display = "none";
    clearInterval(intervalId);
    yesButton.innerText = "Yes";
    yesButton.disabled = true;
  });
}

function startTimer(yesButton, counter) {
  return setInterval(function () {
    counter--;
    if (counter >= 0) {
      yesButton.innerText = `Yes (${counter})`;
    } else {
      yesButton.disabled = false;
      yesButton.innerText = "Yes";
      clearInterval(intervalId);
    }
  }, 1000);
}

// ─── Delete Function ──────────────────────────────────────────
function deleteUser(id) {
  $.ajax({
    type: "POST",
    url: "../Php/deleteUser.php",
    data: { id: id },
    dataType: "json",
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

// ─── File Status Update ───────────────────────────────────────
$(document).ready(function () {
  var currentStatus;

  function fetchFileInfo(fileId, callback) {
    $.ajax({
      type: "POST",
      url: "../Php/fetchFileInfo.php",
      data: { id: fileId },
      dataType: "json",
      success: function (data) {
        console.log(data);
        if (Array.isArray(data) && data.length > 0) {
          var item = data[0]; // Access the first item in the array
          $("#TrackingN").html(
            "<strong>Tracking Number: </strong>" + item.tracking_number
          );

          $("#fileStatusId").val(fileId);
          currentStatus = item.file_status;
          callback(currentStatus);
        }
      },
      error: function (error) {
        console.log(error);
      },
    });
  }

  function updateButtonState(selectedStatus) {
    $("#updateButton1").prop("disabled", selectedStatus === currentStatus);
  }

  $(".viewMore").on("click", function () {
    var fileId = $(this).data("file-id");
    fetchFileInfo(fileId, function (fileStatus) {
      $("#fileStatus").val(fileStatus);
      updateButtonState(fileStatus);
    });
    $("#customEditModal1").show();
  });

  $("#fileStatus").change(function () {
    updateButtonState($(this).val());
  });

  $(document).mousedown(function (event) {
    var modal = $("#customEditModal1");
    if (!modal.is(event.target) && modal.has(event.target).length === 0) {
      modal.hide();
    }
  });

  $("#customEditForm1").submit(function (e) {
    e.preventDefault();
    var selectedStatus = $("#fileStatus").val();
    var confirmation;
    var remarks = "";
    if (selectedStatus === "Declined") {
      remarks = prompt("Please enter your remarks for declining:");
      var words = remarks.split(" ");
      if (words.length <= 1) {
        alert("Please enter more than one word in remarks.");
        return;
      }
      confirmation = remarks;
    } else {
      confirmation = confirm(
        "Are you sure you want to update the file status?"
      );
    }
    if (confirmation) {
      var formData = $(this).serialize();
      formData += "&remarks=" + encodeURIComponent(remarks);
      $.ajax({
        type: "POST",
        url: "../Php/updateFile.php",
        data: formData,
        dataType: "json",
        success: function (data) {
          if (data.status === "success") {
            sessionStorage.setItem("showCustomPopup", data.message);
            $("#customEditModal1").hide();
            location.reload();
          } else {
            showCustomPopup(data.message);
          }
        },
        error: function (error) {
          console.log(error);
          showCustomPopup("Error updating file status");
        },
      });
    }
  });
  // ─── Popup Message ────────────────────────────────────────────
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

// ─── fetch total cert of indegency ────────────────────────────────────────────
$(document).ready(function () {
  function fetchTotalRequests() {
    $.ajax({
      url: "../Php/fetchTotal.php",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        $("#totalReq").text(data.totalReq);
      },
    });
  }

  fetchTotalRequests();
  setInterval(fetchTotalRequests, 2000);
});

// ─── fetch total cert of Residency ────────────────────────────────────────────
$(document).ready(function () {
  function fetchTotalRequests() {
    $.ajax({
      url: "../Php/fetchTotal1.php",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        $("#totalReq1").text(data.totalReq);
      },
    });
  }

  fetchTotalRequests();
  setInterval(fetchTotalRequests, 2000);
});

// ─── fetch total First time job seeker ────────────────────────────────────────────
$(document).ready(function () {
  function fetchTotalRequests() {
    $.ajax({
      url: "../Php/fetchTotal2.php",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        $("#totalReq2").text(data.totalReq);
      },
    });
  }

  fetchTotalRequests();
  setInterval(fetchTotalRequests, 2000);
});

// ─── fetch total residents ────────────────────────────────────────────
$(document).ready(function () {
  function fetchTotalRequests() {
    $.ajax({
      url: "../Php/fetchTotal3.php",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        $("#totalReq3").text(data.totalReq);
      },
    });
  }

  fetchTotalRequests();
  setInterval(fetchTotalRequests, 2000);
});
