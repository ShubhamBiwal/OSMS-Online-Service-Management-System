<?php
session_start();
if (!isset($_SESSION['is_login'])) {
    header("Location: http://localhost/osms/");
}

?>












<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <title>Profile</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- internal stylesheet -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap");

        * {
            font-family: "Montserrat", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            transition: all 0.2s linear;
        }

        :root {
            --white: #fff;
            --blue: #2597f4;
            --black: #334;
        }

        html {
            font-size: 62.5%;
            overflow-x: hidden;
            scroll-behavior: smooth;
            scroll-padding-top: 6rem;
        }

        html::-webkit-scrollbar {
            width: 1rem;
        }

        html::-webkit-scrollbar-track {
            background: var(--white);
        }

        html::-webkit-scrollbar-thumb {
            background: var(--blue);
            border-radius: 5rem;
        }

        body {
            background: var(--white);
        }

        .wrapper .section {
            width: 100%;
            transition: all 0.5s ease;
        }

        .wrapper .section .top_navbar {
            height: 7rem;
            background: var(--black);
            display: flex;
            align-items: center;
            padding: 0 3rem;
            /* box-shadow: .2rem .2rem 1rem rgb(0, 0, 0, 0.3); */
        }

        .wrapper .top_navbar .logo {
            font-size: 3rem;
            text-transform: capitalize;
            color: var(--blue);
            font-weight: bolder;
            margin-right: 3rem;
        }

        .header .navbar .logo i {
            color: var(--blue);
        }

        .wrapper .section .top_navbar .hamburger {
            font-size: 2.8rem;
            color: blueviolet;
            cursor: pointer;
            background: #fff;
            border-radius: .5rem;
            padding: 0.5rem 1.5rem;
            display: none;
        }

        .wrapper .section .top_navbar .hamburger i {
            font-size: 4rem;
        }

        .wrapper .sidebar {
            background: #dce6ee;
            position: fixed;
            top: 7rem;
            left: 0;
            width: 22.5rem;
            height: 100%;
            padding: 2rem 0;
            transition: all 0.5s ease;
            /* box-shadow: 0.2rem 0.4rem 1rem .2rem rgb(0, 0, 0, 0.2); */
        }

        .wrapper .sidebar ul li a {
            display: block;
            padding: 1rem 0 1rem 1.8rem;
            color: black;
            font-size: 1.8rem;
            font-weight: 500;
            position: relative;
            text-decoration: none;
        }

        .wrapper .sidebar ul li a .icon {
            color: black;
            padding-right: .8rem;
            font-size: 2.4rem;
            display: inline-block;
        }

        .wrapper .sidebar ul li a:hover,
        .wrapper .sidebar ul li a.active {
            background-color: blueviolet;
            color: #fff;
        }

        .wrapper .sidebar ul li a:hover .icon,
        .wrapper .sidebar ul li a.active .icon {
            color: #fff;
        }

        .wrapper .sidebar ul li a:hover:before,
        .wrapper .sidebar ul li a.active:before {
            display: block;
        }


        @media (max-width: 750px) {
            html {
                font-size: 55%;
            }

            .sidebar {
                margin-left: -22.5rem;
            }

            .wrapper .section .top_navbar .hamburger {
                display: initial;
            }

            body.active .wrapper .sidebar {
                left: 22.5rem;
            }


            body.active .wrapper .section {
                margin-left: 0;
                width: 100%;
            }

        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="section">
            <div class="top_navbar">
                <a href="http://localhost/osms" class="logo"> <i class="fas fa-tools"></i> OSMS </a>
                <div class="hamburger">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <ul>
                <li>
                    <a href="">
                        <span class="icon"><i class="las la-home"></i></span>
                        <span class="item">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="icon"><i class="las la-user-circle"></i></span>
                        <span class="item">Submit Request</span>
                    </a>
                </li>

                <li>
                    <a href="">
                        <span class="icon"><i class="las la-bell"></i></span>
                        <span class="item">Service Status</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span class="icon"><i class="las la-calendar-alt"></i></span>
                        <span class="item">Change Password</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon"><i class="las la-door-open"></i></span>
                        <span class="item">Logout </span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div>

    </div>

    <script>
        var hamburger = document.querySelector(".hamburger");
        hamburger.addEventListener("click", function() {
            document.querySelector("body").classList.toggle("active");
        })
    </script>

</body>

</html>