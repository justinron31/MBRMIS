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
      url: "/MBRMIS/Php/fetchUserInfo.php", // Create a new PHP file to handle this request
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
    url: "/MBRMIS/Php/fetchUserInfo.php", // Create a new PHP file to handle this request
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

// ─── fetch total cert of indegency ────────────────────────────────────────────
$(document).ready(function () {
  function fetchTotalRequests() {
    $.ajax({
      url: "/MBRMIS/Php/fetchTotal.php",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        $("#totalReq").text(data.totalReq);
      },
    });
  }

  fetchTotalRequests();
  setInterval(fetchTotalRequests, 1000);
});

// ─── fetch total cert of Residency ────────────────────────────────────────────
$(document).ready(function () {
  function fetchTotalRequests() {
    $.ajax({
      url: "/MBRMIS/Php/fetchTotal1.php",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        $("#totalReq1").text(data.totalReq);
      },
    });
  }

  fetchTotalRequests();
  setInterval(fetchTotalRequests, 1000);
});

// ─── fetch total First time job seeker ────────────────────────────────────────────
$(document).ready(function () {
  function fetchTotalRequests() {
    $.ajax({
      url: "/MBRMIS/Php/fetchTotal2.php",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        $("#totalReq2").text(data.totalReq);
      },
    });
  }

  fetchTotalRequests();
  setInterval(fetchTotalRequests, 1000);
});

// // ─── Fetch all data in the table ───────────────────────────────────────────────
$(document).ready(function () {
  var currentStatus;

  function fetchFileInfo(fileId, callback, url) {
    $.ajax({
      type: "POST",
      url: url,
      data: { id: fileId },
      dataType: "json",
      success: function (data) {
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

  function fetchFileRequests(url, tableId) {
    $.ajax({
      url: url,
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        var html = "";

        for (var i = 0; i < data.length; i++) {
          var row = data[i];
          var className = "";
          if (row.file_status.toLowerCase().trim() == "ready for pickup") {
            className = "delivered";
          } else if (row.file_status.toLowerCase().trim() == "declined") {
            className = "cancelled";
          } else if (row.file_status.toLowerCase().trim() == "reviewing") {
            className = "pending";
          } else if (row.file_status.toLowerCase().trim() == "processing") {
            className = "processing";
          }
          html += generateTableRow(row, className);
        }
        $(tableId).html(html);
      },
    });
  }

  function generateTableRow(row, className) {
    return (
      "<tr>" +
      "<td><strong>" +
      row.tracking_number +
      "</strong></td>" +
      "<td style='text-align: center;'><p class='status " +
      className +
      " padding'>" +
      row.file_status +
      "</p></td>" +
      "<td>" +
      row.firstname +
      "</td>" +
      "<td>" +
      row.lastname +
      "</td>" +
      "<td>" +
      row.contact_number +
      "</td>" +
      "<td>" +
      row.voters_id_number +
      "</td>" +
      "<td><a href='../Uploaded File/" +
      row.voters_id_image +
      "' target='_blank'>View Voters ID</a></td>" +
      "<td>" +
      row.purpose_description +
      "</td>" +
      "<td title='" +
      new Date(row.pickup_datetime).toLocaleString() +
      "'>" +
      new Date(row.pickup_datetime).toLocaleString() +
      "</td>" +
      "<td title='" +
      new Date(row.datetime_created).toLocaleString() +
      "'>" +
      new Date(row.datetime_created).toLocaleString() +
      "</td>" +
      "<td><i class='bx bxs-edit edit-icon' data-file-id='" +
      row.id +
      "'></i></td>" +
      "</tr>"
    );
  }

  fetchFileRequests("/MBRMIS/Php/fetchCertIndigency.php", "#fileRequestsTable");
  setInterval(function () {
    fetchFileRequests(
      "/MBRMIS/Php/fetchCertIndigency.php",
      "#fileRequestsTable"
    );
  }, 2000);

  fetchFileRequests(
    "/MBRMIS/Php/fetchCertResidency.php",
    "#fileRequestsTable1"
  );
  setInterval(function () {
    fetchFileRequests(
      "/MBRMIS/Php/fetchCertResidency.php",
      "#fileRequestsTable1"
    );
  }, 2000);

  $(document).on("click", ".edit-icon", function () {
    var fileId = $(this).data("file-id");
    fetchFileInfo(
      fileId,
      function (fileStatus) {
        $("#fileStatus").val(fileStatus);
        updateButtonState(fileStatus);
      },
      "/MBRMIS/Php/fetchFileInfo.php"
    );
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
      confirmation = remarks = prompt(
        "Please enter your remarks for declining:"
      );
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
        url: "/MBRMIS/Php/updateFile.php",
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
});

// ─── Fetch first time job seeker ──────────────────────────────────
function generateRowHtml(row) {
  var fileStatus = row.file_status.toLowerCase().trim();
  var className = "";
  if (row.file_status.toLowerCase().trim() == "ready for pickup") {
    className = "delivered";
  } else if (row.file_status.toLowerCase().trim() == "declined") {
    className = "cancelled";
  } else if (row.file_status.toLowerCase().trim() == "reviewing") {
    className = "pending";
  } else if (row.file_status.toLowerCase().trim() == "processing") {
    className = "processing";
  }
  return (
    "<tr>" +
    "<td><strong>" +
    row["tracking_number"] +
    "</strong></td>" +
    "<td style='text-align: center;'>" +
    "<p class='status " +
    className +
    " padding'>" +
    row["file_status"] +
    "</p>" +
    "</td>" +
    "<td>" +
    row["firstname"] +
    "</td>" +
    "<td>" +
    row["lastname"] +
    "</td>" +
    "<td>" +
    new Date(row["birthdate"]).toLocaleDateString("en-US", {
      month: "long",
      day: "numeric",
      year: "numeric",
    }) +
    "</td>" +
    "<td>" +
    row["age"] +
    "</td>" +
    "<td>" +
    row["gender"] +
    "</td>" +
    "<td>" +
    row["contact_number"] +
    "</td>" +
    "<td>" +
    row["civil_status"] +
    "</td>" +
    "<td>" +
    row["address"] +
    "</td>" +
    "<td>" +
    row["residency"] +
    "</td>" +
    "<td>" +
    row["education"] +
    "</td>" +
    "<td>" +
    row["course"] +
    "</td>" +
    "<td>" +
    row["job_start_beneficiary"] +
    "</td>" +
    "<td>" +
    row["id_number"] +
    "</td>" +
    "<td><a href='../Uploaded File/" +
    row["avatar"] +
    "' target='_blank'>View Voters ID</a></td>" +
    "<td title='" +
    new Date(row.pickup_datetime).toLocaleString() +
    "'>" +
    new Date(row.pickup_datetime).toLocaleString() +
    "</td>" +
    "<td title='" +
    new Date(row.datetime_created).toLocaleString() +
    "'>" +
    new Date(row.datetime_created).toLocaleString() +
    "</td>" +
    "<td><i class='bx bxs-edit edit-icon' data-file-id='" +
    row["id"] +
    "'></i></td>" +
    "</tr>"
  );
}

function fetchFileRequests() {
  $.ajax({
    url: "/MBRMIS/Php/fetchFirstTime.php",
    type: "GET",
    success: function (response) {
      var data = JSON.parse(response);
      var html = data.map(generateRowHtml).join("");
      $("#fileRequestsTable2").html(html);
    },
  });
}

$(document).ready(function () {
  // ... your existing code ...

  // Call the function to fetch data and populate the table
  fetchFileRequests();

  // Refresh the data every second
  setInterval(fetchFileRequests, 2000);
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
