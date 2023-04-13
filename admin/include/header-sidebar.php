<?php
session_start();
if (!isset($_SESSION['is_adminlogin'])) {
    header("Location: /osms/admin");
}
date_default_timezone_set("Asia/Kolkata");
$aEmail = $_SESSION['is_adminlogin'];
$sql = "SELECT a_name FROM admin_login WHERE a_email = '$aEmail'";
$run = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($run);
$aname = $result['a_name'];
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
    <link rel="stylesheet" href="../css/admin-style.css">
    <style>
        .pheading {
            color: white;
            font-size: 1.7rem;
            font-weight: 600;
            text-transform: capitalize;
        }

        .sidebar h2 {
            display: none;
            margin: 1rem 0;

        }

        @media(max-width:750px) {
            .sidebar h2 {
                display: block;
            }

            .pheading {
                display: none;
            }
        }
    </style>
</head>

<section class="head-sidebar">
    <div class="top_navbar">
        <a href="/osms" class="logo"> <i class="fas fa-tools"></i> OSMS </a>
        <div class="hamburger">
            <i class="fa-solid fa-bars"></i>
        </div>
        <span class="pheading">Hey! <?php echo $aname; ?></span>
    </div>
    <div class="sidebar">
        <h2>Hey! <?php echo $aname; ?></h2>

        <ul class="links">
            <li>
                <a href="dashboard.php" class="<?php if ($page == "dashboard") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-gauge"></i></span>
                    <span class="item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="requests.php" class="<?php if ($page == "requests") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-align-center"></i></span>
                    <span class="item">Requests</span>
                </a>
            </li>
            <li>
                <a href="work-order.php" class="<?php if ($page == "workorder") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-brands fa-accessible-icon"></i></span>
                    <span class="item">Work Order</span>
                </a>
            </li>
            <li>
                <a href="assets.php" class="<?php if ($page == "assets") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                    <span class="item">Assets</span>
                </a>
            </li>
            <li>
                <a href="services.php" class="<?php if ($page == "services") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-screwdriver-wrench"></i></span>
                    <span class="item">Services</span>
                </a>
            </li>
            <li>
                <a href="technician.php" class="<?php if ($page == "technician") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-headset"></i></span>
                    <span class="item">Technician</span>
                </a>
            </li>
            <li>
                <a href="requester.php" class="<?php if ($page == "requester") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-users"></i></span>
                    <span class="item">Requester</span>
                </a>
            </li>
            <li>
                <a href="sold-product-report.php" class="<?php if ($page == "sellreport") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-sharp fa-solid fa-file-invoice"></i></span>
                    <span class="item">Sell Report</span>
                </a>
            </li>
            <li>
                <a href="work-report.php" class="<?php if ($page == "workreport") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-file-word"></i></span>
                    <span class="item">Work Report</span>
                </a>
            </li>
            <li>
                <a href="messages.php" class="<?php if ($page == "messages") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-message"></i></span>
                    <span class="item">Messages</span>
                </a>
            </li>
            <li>
                <a href="profile.php" class="<?php if ($page == "admin-profile") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="item">Profile</span>
                </a>
            </li>
            <li>
                <a href="change-password.php" class="<?php if ($page == "changepassword") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-key"></i></span>
                    <span class="item">Change Password</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="<?php if ($page == "logout") echo 'nav-active'; ?>">
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