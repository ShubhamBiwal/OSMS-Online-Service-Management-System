<?php

session_start();
if (!isset($_SESSION['is_login'])) {
header("Location: /osms");
}
?>


<section class="head-sidebar">
    <div class="top_navbar">
        <a href="/osms" class="logo"> <i class="fas fa-tools"></i> OSMS </a>
        <div class="hamburger">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <div class="sidebar">
        <ul class="links">
            <li>
                <a href="user-profile.php" class="activ">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="item">Profile</span>
                </a>
            </li>
            <li>
                <a href="submit-request.php">
                    <span class="icon"><i class="fa-brands fa-accessible-icon"></i></span>
                    <span class="item">Submit Request</span>
                </a>
            </li>

            <li>
                <a href="check-status.php">
                    <span class="icon"><i class="fa-solid fa-circle-info"></i></span>
                    <span class="item">Service Status</span>
                </a>
            </li>
            <li>
                <a href="change-password.php">
                    <span class="icon"><i class="fa-solid fa-key"></i></span>
                    <span class="item">Change Password</span>
                </a>
            </li>
            <li>
                <a href="/osms/logout.php">
                    <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="item">Logout </span>
                </a>
            </li>

        </ul>
    </div>
</section>

<script>
    var hamburger = document.querySelector(".hamburger");
    hamburger.addEventListener("click", function() {
        document.querySelector("body").classList.toggle("active");
    })
    //active class


 
</script>