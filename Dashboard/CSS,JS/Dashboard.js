// Selecting the sidebar and buttons
const sidebar = document.querySelector(".sidebar");
const sidebarOpenBtn = document.querySelector("#sidebar-open");
const sidebarCloseBtn = document.querySelector("#sidebar-close");
const sidebarLockBtn = document.querySelector("#lock-icon");

// Function to toggle the lock state of the sidebar
const toggleLock = () => {
  sidebar.classList.toggle("locked");
  // If the sidebar is not locked
  if (!sidebar.classList.contains("locked")) {
    sidebar.classList.add("hoverable");
    sidebarLockBtn.classList.replace("bxs-lock-alt", "bx-lock-open-alt");
    localStorage.setItem("sidebarLockState", "unlocked");
  } else {
    sidebar.classList.remove("hoverable");
    sidebarLockBtn.classList.replace("bx-lock-open-alt", "bxs-lock-alt");
    localStorage.setItem("sidebarLockState", "locked");
  }
};

// Function to hide the sidebar when the mouse leaves
const hideSidebar = () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.add("close");
  }
};

// Function to show the sidebar when the mouse enter
const showSidebar = () => {
  if (sidebar.classList.contains("hoverable")) {
    sidebar.classList.remove("close");
  }
};

// Function to show and hide the sidebar
const toggleSidebar = () => {
  sidebar.classList.toggle("close");
  localStorage.setItem(
    "sidebarState",
    sidebar.classList.contains("close") ? "closed" : "open"
  );
};

// If the window width is less than 800px, close the sidebar and remove hoverability and lock
if (window.innerWidth < 800) {
  sidebar.classList.add("close");
  sidebar.classList.remove("locked");
  sidebar.classList.remove("hoverable");
}

// Adding event listeners to buttons and sidebar for the corresponding actions
sidebarLockBtn.addEventListener("click", toggleLock);
sidebar.addEventListener("mouseleave", hideSidebar);
sidebar.addEventListener("mouseenter", showSidebar);
sidebarCloseBtn.addEventListener("click", toggleSidebar);

//sidebaractive
document.addEventListener("DOMContentLoaded", function () {
  const sidebarLockState = localStorage.getItem("sidebarLockState");

  if (sidebarLockState === "locked") {
    sidebar.classList.add("locked");
    sidebar.classList.remove("hoverable");
    sidebarLockBtn.classList.replace("bx-lock-open-alt", "bxs-lock-alt");
  } else {
    sidebar.classList.add("close");
    sidebar.classList.remove("locked");
    sidebar.classList.add("hoverable");
    sidebarLockBtn.classList.replace("bxs-lock-alt", "bx-lock-open-alt");
  }

  const menuItems = document.querySelectorAll(".menu_item .item");

  const overviewItem = document.querySelector(".menu_item .item.active");
  if (overviewItem) {
    overviewItem.classList.add("active");
  }

  menuItems.forEach((item) => {
    item.addEventListener("click", function () {
      // Remove the "active" class from all items
      menuItems.forEach((menuItem) => {
        menuItem.classList.remove("active");
      });

      // Add the "active" class to the clicked item
      this.classList.add("active");
    });
  });
});
// ─── Calendar ─────────────────────────────────────────────────
let date = new Date();

function renderCalendar() {
  date.setDate(1);

  const monthDays = document.getElementById("calendar-body");
  const month = document.getElementById("month");
  const daysElement = document.getElementById("days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  const days = ["S", "M", "T", "W", "T", "F", "S"];

  month.innerText = `${months[date.getMonth()]} ${date.getFullYear()}`;
  daysElement.innerHTML = days.map((day) => `<div>${day}</div>`).join("");

  let dates = "";

  for (let x = firstDayIndex; x > 0; x--) {
    dates += `<div class='prev-date'>${prevLastDay - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDay; i++) {
    if (
      i === new Date().getDate() &&
      date.getMonth() === new Date().getMonth() &&
      date.getFullYear() === new Date().getFullYear()
    ) {
      dates += `<div class='today'>${i}</div>`;
    } else {
      dates += `<div>${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    dates += `<div class='next-date'>${j}</div>`;
  }
  monthDays.innerHTML = dates;
}

function showCurrentDate() {
  date = new Date();
  renderCalendar();
}

document.getElementById("month-prev").addEventListener("click", () => {
  document.getElementById("calendar-body").classList.add("fade-out");
  setTimeout(() => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
    document.getElementById("calendar-body").classList.remove("fade-out");
  }, 10);
});

document.getElementById("month-next").addEventListener("click", () => {
  document.getElementById("calendar-body").classList.add("fade-out");
  setTimeout(() => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
    document.getElementById("calendar-body").classList.remove("fade-out");
  }, 10);
});

document.getElementById("month").addEventListener("click", showCurrentDate);

renderCalendar();

// ─── Logout Modal ─────────────────────────────────────────────
function openLogoutModal() {
  var modal = document.getElementById("logoutModal");
  var overlay = document.getElementById("overlay");
  modal.style.display = "block";
  overlay.style.display = "block";
}

function closeLogoutModal() {
  var modal = document.getElementById("logoutModal");
  var overlay = document.getElementById("overlay");
  modal.style.display = "none";
  overlay.style.display = "none";
}

function logout() {
  // Add AJAX request to terminate the session
  fetch("../Php/logout.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Logout failed");
      }
      return response.text();
    })
    .then((data) => {
      // Redirect to the login page immediately with the logout parameter
      window.location.href = "../Login/loginStaff.php?logout=true";
    })
    .catch((error) => {
      console.error("Logout error:", error);
    });
}

// ─── Loader Animation ─────────────────────────────────────────
$(window).on("load", function () {
  $("#status").fadeOut();

  $("#preloader").delay(150).fadeOut("slow");

  $("body").delay(150).css({ overflow: "visible" });
});

// ─── Edit Profile ─────────────────────────────────────────────
function toggleEdit() {
  const saveButton = document.getElementById("saveButton");
  const editButton = document.getElementById("editButton");
  const passCon = document.getElementById("passCon");
  const inputs = document.getElementsByTagName("input");
  const dropdown = document.getElementById("gender");

  const initialValues = [];
  for (const input of inputs) {
    initialValues.push(input.value);
    input.setAttribute("data-initial-value", input.value);
  }
  dropdown.setAttribute("data-initial-value", dropdown.value);

  if (editButton.textContent.trim() === "EDIT") {
    editButton.innerHTML = "<p class='exportTitle'><strong>X</strong></p>";
    editButton.style.backgroundColor = "red";
    saveButton.style.display = "block";
    passCon.style.display = "flex";

    for (const input of inputs) {
      if (input.id !== "idnum" && input.id !== "email") {
        input.disabled = false;
        input.addEventListener("input", enableSaveButton);
      }
    }

    dropdown.disabled = false;
    dropdown.addEventListener("change", enableSaveButton);
  } else {
    editButton.innerHTML = "<p class='exportTitle'><strong>EDIT</strong></p>";
    editButton.style.backgroundColor = "";
    saveButton.style.display = "none";
    passCon.style.display = "none";
    passForm.style.display = "none";

    for (const input of inputs) {
      if (input.id !== "idnum" && input.id !== "email") {
        input.disabled = true;
        input.removeEventListener("input", enableSaveButton);
      }
    }

    dropdown.disabled = true;
    dropdown.removeEventListener("change", enableSaveButton);
  }
}

function enableSaveButton() {
  const saveButton = document.getElementById("saveButton");
  const inputs = document.getElementsByTagName("input");
  const dropdown = document.getElementById("gender");
  let hasChanges = false;

  for (const input of inputs) {
    const currentInputValue = input.value;
    const initialValue = input.getAttribute("data-initial-value");

    if (currentInputValue !== initialValue) {
      hasChanges = true;
      break;
    }
  }

  if (
    hasChanges ||
    dropdown.value !== dropdown.getAttribute("data-initial-value")
  ) {
    saveButton.disabled = false;
  } else {
    saveButton.disabled = true;
  }
}

saveButton.disabled = true; // Set save button disabled by default

dropdown.addEventListener("change", enableSaveButton);

// ─── CHANGE PASSWORD ─────────────────────────────────────────────
function toggleForm() {
  var passForm = document.getElementById("passForm");
  var passCon = document.getElementById("passCon");
  var resetBtn = document.querySelector(".reset__password-btn");

  if (passForm.style.display === "none" || passForm.style.display === "") {
    // Show the form
    passForm.style.display = "block";
    resetBtn.innerText = "X";
    resetBtn.style.backgroundColor = "red";
  } else {
    // Hide the form
    passForm.style.display = "none";
    resetBtn.innerText = "Reset Password";
    resetBtn.style.backgroundColor = "";
  }
}

// ─── Confirmpassword ──────────────────────────────────────────
function validatePassword() {
  var passwordInput = document.getElementById("pass");
  var confirmPasswordInput = document.getElementById("cpass");
  var validationPopup = document.getElementById("validationPopup");
  var submitBtn = document.getElementById("resetButton");

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

// ─── Validateage ──────────────────────────────────────────────
function validateAge(input) {
  // Remove non-numeric characters
  input.value = input.value.replace(/\D/g, "");

  // Limit to two digits
  if (input.value.length > 2) {
    input.value = input.value.slice(0, 2);
  }
}

// ─── Close Logout ─────────────────────────────────────────────
