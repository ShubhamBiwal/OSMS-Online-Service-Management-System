<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header("Location: /osms");
}
$uEmail = $_SESSION['is_login'];
$sql = "SELECT u_name FROM user_login WHERE u_email = '$uEmail'";
$run = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($run);
$uname = $result['u_name'];

?>


<section class="head-sidebar">
    <div class="top_navbar">
        <a href="/osms" class="logo"> <i class="fas fa-tools"></i> OSMS </a>
        <div class="hamburger">
            <i class="fa-solid fa-bars"></i>
        </div>
        <span class="pheading">Hey! <?php echo $uname; ?></span>
    </div>
    <div class="sidebar">
        <h2>Hey! <?php echo $uname; ?></h2>

        <ul class="links">
            <li>
                <a href="user-profile.php" class="<?php if ($page == "userprofile") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="item">Profile</span>
                </a>
            </li>
            <li>
                <a href="submit-request.php" class="<?php if ($page == "submitrequest") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-brands fa-accessible-icon"></i></span>
                    <span class="item">Submit Request</span>
                </a>
            </li>
            <li>
                <a href="my-requests.php" class="<?php if ($page == "myrequests") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-file-circle-check"></i></span>
                    <span class="item">My Requests</span>
                </a>
            </li>

            <li>
                <a href="check-status.php" class="<?php if ($page == "checkstatus") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-circle-info"></i></span>
                    <span class="item">Service Status</span>
                </a>
            </li>
            <li>
                <a href="change-password.php" class="<?php if ($page == "changepass") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-key"></i></span>
                    <span class="item">Change Password</span>
                </a>
            </li>
            <li>
                <a href="/osms/logout.php" class="<?php if ($page == "logout") echo 'nav-active'; ?>">
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