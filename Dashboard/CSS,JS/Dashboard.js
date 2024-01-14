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
  } else {
    sidebar.classList.remove("hoverable");
    sidebarLockBtn.classList.replace("bx-lock-open-alt", "bxs-lock-alt");
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
      item.classList.add("active");
    });
  });
});


/*CALENDAR*/
let date = new Date();

function renderCalendar() {
  date.setDate(1);

  const monthDays = document.getElementById('calendar-body');
  const month = document.getElementById('month');
  const daysElement = document.getElementById('days');

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
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
  ];

  const days = [
    'S',
    'M',
    'T',
    'W',
    'T',
    'F',
    'S'
  ];

  month.innerText = `${months[date.getMonth()]} ${date.getFullYear()}`;
  daysElement.innerHTML = days.map(day => `<div>${day}</div>`).join('');

  let dates = '';

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

document.getElementById('month-prev').addEventListener('click', () => {
  document.getElementById('calendar-body').classList.add('fade-out');
  setTimeout(() => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
    document.getElementById('calendar-body').classList.remove('fade-out');
  }, 10);
});

document.getElementById('month-next').addEventListener('click', () => {
  document.getElementById('calendar-body').classList.add('fade-out');
  setTimeout(() => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
    document.getElementById('calendar-body').classList.remove('fade-out');
  }, 10);
});


document.getElementById('month').addEventListener('click', showCurrentDate);

renderCalendar();

// LOGOUT MODAL POPUP
function openLogoutModal() {
  var modal = document.getElementById('logoutModal');
  var overlay = document.getElementById('overlay');
  modal.style.display = 'block';
  overlay.style.display = 'block';
}

function closeLogoutModal() {
  var modal = document.getElementById('logoutModal');
  var overlay = document.getElementById('overlay');
  modal.style.display = 'none';
  overlay.style.display = 'none';
}

function logout() {
  window.location.href = '../Login/loginAdmin.php';
}
function logout1() {
  window.location.href = '../Login/loginStaff.php';
}





/*LOADER ANIMATION*/
$(window).on('load', function () {

  $('#status').fadeOut();


  $('#preloader').delay(150).fadeOut('slow');


  $('body').delay(150).css({ 'overflow': 'visible' });
});
