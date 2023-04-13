<?php
session_start();
if (!isset($_SESSION['is_techlogin'])) {
    header("Location: /osms/technician");
}
date_default_timezone_set("Asia/Kolkata");
$tEmail = $_SESSION['is_techlogin'];
$sql = "SELECT tech_name FROM technician_tb WHERE tech_email = '$tEmail'";
$run = mysqli_query($conn, $sql);
$result = mysqli_fetch_array($run);
$tname = $result['tech_name'];
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
    <link rel="stylesheet" href="../css/technician-style.css">
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
        <span class="pheading">Hey! <?php echo $tname;  ?></span>
    </div>
    <div class="sidebar">
        <h2>Hey! <?php echo $tname; ?></h2>

        <ul class="links">
            <li>
                <a href="profile.php" class="<?php if ($page == "tech-profile") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-user"></i></span>
                    <span class="item">Profile</span>
                </a>
            </li>
            <li>
                <a href="pending-work.php" class="<?php if ($page == "pending-work") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-hourglass-half"></i></span>
                    <span class="item">Pending Work</span>
                </a>
            </li>
            <li>
                <a href="completed-work.php" class="<?php if ($page == "completed-work") echo 'nav-active'; ?>">
                    <span class="icon"><i class="fa-solid fa-file-circle-check"></i></span>
                    <span class="item">Completed Work</span>
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