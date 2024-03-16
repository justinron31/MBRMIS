<!-- ─── Idle popup ───────────────────── -->
<div id="overlaySession" class="overlay"></div>
<div id="sessionModal" class="modal1">

    <div class="modal-header">
        <h2>Logout Session</h2>
    </div>

    <div class="modal-body">

        <div class="time">
            <i class='bx bxs-timer'></i>
        </div>

        <div class="timeCount">
        </div>

        <p> Your session is about to expire.</p>

        <div class="modal-buttons">
            <button class="yes" onclick="resetTimer()">RESET </button>

        </div>

    </div>

</div>


<!-- ─── logout popup ───────────────────── -->
<div id="overlay" class="overlay"></div>
<div id="logoutModal" class="modal">
    <div class="modal-header">
        <h2>Logout</h2>
    </div>

    <div class="modal-body">
        <div class="modal-message">
            <p>Do you want to logout?</p>
        </div>
        <div class="modal-buttons">
            <button class="yes" onclick="logout()">Yes</button>
            <button class="no" onclick="closeLogoutModal()">No</button>
        </div>
    </div>

</div>




<script>
    // ─── Idle counter ───────────────────────────────────────────
    const idleTimeout = 5 * 60; //5 minutes
    let remain = 3 * 60; // 3 minutes
    let timer;
    let idleTime = 0;

    function startIdleTimer() {
        timer = setInterval(function() {
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

    document.addEventListener("DOMContentLoaded", function() {
        startIdleTimer();
    });



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
</script>