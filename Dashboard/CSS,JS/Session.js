// ─── Idle counter ───────────────────────────────────────────
const idleTimeout = 5 * 60; //15 seconds
let remain = 60; // 5 seconds
let timer;
let idleTime = 0;

function startIdleTimer() {
  timer = setInterval(function () {
    idleTime++;
    console.log(idleTime);
    if (idleTime >= idleTimeout - remain) {
      const remainingTime = Math.max(0, idleTimeout - idleTime);
      document.querySelector(".timeCount").innerText = remainingTime;

      if (remainingTime === 0) {
        clearInterval(timer);
        fetch("../Php/logout.php")
          .then((response) => response.text())
          .then((data) => {
            console.log(data);
            window.location.href = "../Login/loginStaff.php?logout=true";
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      }

      document.getElementById("sessionModal").style.display = "block";
      document.querySelector(".overlay").style.display = "block";
    } else {
      document.querySelector(".timeCount").innerText = "";
    }
  }, 1000);

  document.addEventListener("mousemove", resetTimer);
  document.addEventListener("mousewheel", resetTimer);
}

function resetTimer() {
  clearInterval(timer);
  idleTime = 0;
  document.getElementById("sessionModal").style.display = "none";
  document.querySelector(".overlay").style.display = "none";
  document.querySelector(".timeCount").innerText = "";
  startIdleTimer();
}

document.addEventListener("DOMContentLoaded", function () {
  startIdleTimer();
});
