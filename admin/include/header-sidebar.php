<?php
session_start();
if (!isset($_SESSION['is_adminlogin'])) {
    header("Location: /osms/admin");
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href= "../css/admin-style.css">
</head>

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
                <a href="dashboard.php" class="activ">
                    <span class="icon"><i class="fa-solid fa-gauge"></i></span>
                    <span class="item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="work-order.php">
                    <span class="icon"><i class="fa-brands fa-accessible-icon"></i></span>
                    <span class="item">Work Order</span>
                </a>
            </li>

            <li>
                <a href="requests.php">
                    <span class="icon"><i class="fa-solid fa-align-center"></i></span>
                    <span class="item">Requests</span>
                </a>
            </li>
            <li>
                <a href="assets.php">
                    <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                    <span class="item">Assets</span>
                </a>
            </li>
            <li>
                <a href="technician.php">
                    <span class="icon"><i class="fa-solid fa-headset"></i></span>
                    <span class="item">Technician</span>
                </a>
            </li>
            <li>
                <a href="requester.php">
                    <span class="icon"><i class="fa-solid fa-users"></i></span>
                    <span class="item">Requester</span>
                </a>
            </li>
            <li>
                <a href="sold-product-report.php">
                    <span class="icon"><i class="fa-sharp fa-solid fa-file-invoice"></i></span>
                    <span class="item">Sell Report</span>
                </a>
            </li>
            <li>
                <a href="work-report.php">
                    <span class="icon"><i class="fa-solid fa-file-word"></i></i></span>
                    <span class="item">Work Report</span>
                </a>
            </li>
            <li>
                <a href="change-password.php">
                    <span class="icon"><i class="fa-solid fa-key"></i></span>
                    <span class="item">Change Password</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <span class="icon"><i class="fa-solid fa-right-from-bracket"></i></span>
                    <span class="item">Logout</span>
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