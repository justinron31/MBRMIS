<!-- ─── Idle popup ───────────────────── -->
<div id="overlaySession" class="overlay"></div>
<div id="sessionModal" class="modal1">

    <div class="modal-header">
        <h2>Session</h2>
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

<!--incompatibility CONTENT-->
<div class="incomp">
    <div id="logcon">
                <img class="logo" src="../images/logo.png" alt="Makiling logo" />
                <h1 class="logoname">MAKILING BRMI SYSTEM</h1>
            </div>
<h3>"Please access the solution on your larger devices to maximize functionality and view."</h3>
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
    const idleTimeout = 10 * 60; // 10 minutes
    let remain = 5 * 60; // 5 minutes
    let timer;
    let idleTime = 0;

    function startIdleTimer() {
        timer = setInterval(function() {
            idleTime++;

            if (idleTime >= idleTimeout - remain) {
                const remainingTime = Math.max(0, idleTimeout - idleTime);

                document.querySelector('.timeCount').innerText = formatTime(remainingTime);

                if (remainingTime === 0) {
                    // Add AJAX request to terminate the session
                    fetch("../Php/logout.php")
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error("Logout failed");
                            }
                            return response.text();
                        })
                        .then((data) => {

                            window.location.href = "../Dashboard/sessionLogout.html";
                        })
                        .catch((error) => {
                            console.error("Logout error:", error);
                        });
                }

                document.getElementById('sessionModal').style.display = 'block';
                document.querySelector('.overlay').style.display = 'block';
            } else {
                document.querySelector('.timeCount').innerText = '';
            }
        }, 1000);

        document.addEventListener('mousemove', resetTimer1);
        document.addEventListener('mousewheel', resetTimer1);
    }

    function resetTimer() {
        clearInterval(timer);
        idleTime = 0;
        document.getElementById('sessionModal').style.display = 'none';
        document.querySelector('.overlay').style.display = 'none';
        document.querySelector('.timeCount').innerText = '';
        startIdleTimer();
    }

    function resetTimer1() {
        clearInterval(timer);
        idleTime = 0;
        startIdleTimer();
    }

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes}:${String(remainingSeconds).padStart(2, '0')}`;
    }

    document.addEventListener('DOMContentLoaded', function() {
        // startIdleTimer();
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
                localStorage.removeItem('activeItem');
                window.location.href = "../Login/loginStaff.php?logout=true";
            })
            .catch((error) => {
                console.error("Logout error:", error);
            });
    }
</script>