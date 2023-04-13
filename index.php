<?php
include "connection.php";
session_start();
echo '<style>#profile-icon{ display:none;}</style>';

if (isset($_SESSION['is_login'])) {
    echo '<style>#loginbtnid{ display:none;}</style>';
    echo '<style>#registerbtnid{ display:none;}</style>';
    echo '<style>#profile-icon{ display:initial;}</style>';
}
//signup
if (isset($_POST['uSignup'])) {
    $uName = $_POST['uName'];
    $uEmail = strtolower($_POST['uEmail']);
    $uMobile = $_POST['uMobile'];
    $uPassword = $_POST['uPassword'];

    //check empty fields
    if ($uName == "" || $uEmail == "" || $uMobile == "" || $uPassword == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {
        //check already exist email id
        $sql = "SELECT u_email FROM user_login WHERE u_email = '$uEmail' ";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_num_rows($result) == 1) {
            echo '<script> alert("Email ID Already Registered.");</script>';
        } else {
            //insert data
            $sql = "INSERT INTO user_login(u_name, u_email, u_mobile, u_password) VALUES ('$uName', '$uEmail','$uMobile', '$uPassword') ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<script> alert("Account Created Successfully.");</script>';
                $sqlq = "SELECT u_id FROM user_login WHERE u_email = '$uEmail'";
                $runq = mysqli_query($conn, $sqlq);
                $resultq = mysqli_fetch_array($runq);
                $uid = $resultq['u_id'];
                $_SESSION['is_login'] = $uEmail;
                $_SESSION['u_id'] = $uid;
                echo "<script> location.href='user/';</script>";
            } else {
                echo '<script> alert("Error: Unable to Create Account.");</script>';
            }
        }
    }
}
//login
if (isset($_POST['uLogin'])) {
    $uEmail = strtolower(trim($_POST['uEmail']));
    $uPassword = trim($_POST['uPassword']);

    $sql = "SELECT u_id, u_email, u_password FROM user_login WHERE u_email = '$uEmail' AND u_password = '$uPassword' ";
    $run = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($run);
    if ($row  = mysqli_num_rows($run) == 1) {
        $uid = $result['u_id'];
        $_SESSION['is_login'] = $uEmail;
        $_SESSION['u_id'] = $uid;
        echo "<script> location.href='user/';</script>";
        exit;
    } else {
        echo '<script>alert("Login Failed: Invalid Email or Password.");</script>';
    }
}

//total requests completed
$sql1 = "SELECT r_status FROM requests_tb WHERE r_status = '3'";
$run1 = mysqli_query($conn, $sql1);
$row1 = mysqli_num_rows($run1);
$total_completed_work = $row1;

//total users
$sql2 = "SELECT * FROM user_login";
$run2 = mysqli_query($conn, $sql2);
$row2 = mysqli_num_rows($run2);
$total_users = $row2;
//total technician
$sql3 = "SELECT * FROM technician_tb";
$run3 = mysqli_query($conn, $sql3);
$row3 = mysqli_num_rows($run3);
$total_technicians = $row3;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <title>OSMS | Online Service Management System</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <!-- header section starts  -->

    <header class="header">

        <nav class="navbar">
            <a href="/osms" class="logo"> <i class="fas fa-tools"></i> OSMS </a>
            <span class="location"><i class="fa-solid fa-location-dot"></i> Pilani</span>
            <div class="links">
                <a href="index.php">home</a>
                <a href="#AboutUs">about</a>
                <a href="#services">services</a>
                <a href="#reviews">Reviews</a>
                <a href="#contact">contact</a>
                <button onclick="open_login_modal()" id="loginbtnid">login</button>
                <a href="../osms/user/" id="profile-icon"><i class="fa-solid fa-user"></i></a>
                <button onclick="open_register_modal()" id="registerbtnid">register</button>
            </div>

            <div id="menu-btn" class="fa fa-bars"></div>

        </nav>

    </header>

    <!-- header section ends -->

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="image">
            <img src="images/banner-img.png" alt="">
        </div>

        <div class="content">
            <div class="location2"><i class="fa-solid fa-location-dot"></i><span> Pilani</span></div>
            <h3>Why fix it yourself? Leave it to the pros!</h3>
            <p>Your city’s best electronic appliances service provider. Bringing your home appliances back to your life.
            </p>
            <button onclick="open_login_modal()" class="btn" id="loginbtnid">login</button>
            <a href="../osms/user/submit-request.php" class="btn" id="profile-icon">Service Request</a>
            <button onclick="open_register_modal()" class="btn-2">register</button>
        </div>

    </section>

    <!-- home section ends -->

    <!-- about section starts  -->
    <section class="about-us" id="AboutUs">
        <h1 class="heading"> About <span>Us</span> </h1>
        <div class="fun-fact">

            <div class="box">
                <img src="images/fun-fact-icon-1.svg" alt="">
                <div class="info">
                    <h3><?php echo $total_completed_work; ?>+</h3>
                    <p>Request Competed</p>
                </div>
            </div>
            <div class="box">
                <img src="images/fun-fact-icon-2.svg" alt="">
                <div class="info">
                    <h3><?php echo $total_users; ?>+</h3>
                    <p>Happy Clients</p>
                </div>
            </div>

            <div class="box">
                <img src="images/fun-fact-icon-3.svg" alt="">
                <div class="info">
                    <h3><?php echo $total_technicians; ?>+</h3>
                    <p>Active Workers</p>
                </div>
            </div>

        </div>
        <div class="about" id="about">

            <div class="content">
                <h3>best quality service Provider</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Enim laboriosam quidem eaque, ex qui fugit
                    velit veniam veritatis a nostrum amet perspiciatis pariatur ducimus ipsam officiis quae cumque
                    maiores
                    voluptates! Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum minima doloribus
                    repudiandae, a voluptate rem.</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repellendus iste ab eos ea rerum obcaecati
                    illo
                    ex recusandae expedita aspernatur?</p>
                <a href="#services" class="btn">read more</a>
            </div>

            <div class="image">
                <img src="images/about-img.jpg" alt="">
            </div>

        </div>
        <!-- facilities section starts  -->

        <div class="facilities">
            <div class="box-container">

                <div class="box">
                    <img src="images/about-icon1.png" alt="">
                    <h3>Doorstep Service</h3>
                </div>

                <div class="box">
                    <img src="images/about-icon2.svg" alt="">
                    <h3>quality service</h3>
                </div>

                <div class="box">
                    <img src="images/about-icon3.svg" alt="">
                    <h3>quick Service</h3>
                </div>
                <div class="box">
                    <img src="images/about-icon4.svg" alt="">
                    <h3>24/7 Support</h3>
                </div>

            </div>

        </div>

        <!-- facilities section ends -->

    </section>
    <!-- about section ends -->
    <!-- services section starts  -->

    <section class="services" id="services">

        <h1 class="heading"> our <span>services</span> </h1>

        <div class="box-container">

            <div class="box">
                <i class="fa-solid fa-plug-circle-bolt"></i>
                <h3>electronic appliances</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, asperiores.</p>
            </div>

            <div class="box">
                <i class="fa-sharp fa-solid fa-sliders"></i>
                <h3>Preventive Maintenance</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, asperiores.</p>
            </div>

            <div class="box">
                <i class="fa-solid fa-toolbox"></i>
                <h3>fault repair</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus, asperiores.</p>
            </div>
        </div>

    </section>

    <!-- services section ends -->
    <!-- reviews section starts  -->

    <section class="reviews" id="reviews">
        <h1 class="heading"> clients <span>reviews</span> </h1>
        <div class="box-container">

            <div class="box">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="text">
                    <i class="fas fa-quote-right"></i>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi animi alias consequatur sint
                        doloribus illo vitae mollitia, iusto excepturi nobis.</p>
                </div>
                <div class="user">
                    <img src="images/review1.jpg" alt="">
                    <h3>Shubham Biwal</h3>
                </div>
            </div>
            <div class="box">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="text">
                    <i class="fas fa-quote-right"></i>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi animi alias consequatur sint
                        doloribus illo vitae mollitia, iusto excepturi nobis.</p>
                </div>
                <div class="user">
                    <img src="images/review2.jpg" alt="">
                    <h3>Sagar Chauhan</h3>
                </div>
            </div>

            <div class="box">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="text">
                    <i class="fas fa-quote-right"></i>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eligendi animi alias consequatur sint
                        doloribus illo vitae mollitia, iusto excepturi nobis.</p>
                </div>
                <div class="user">
                    <img src="images/review3.jpg" alt="">
                    <h3>Rahul Kumar</h3>
                </div>
            </div>

        </div>

    </section>

    <!-- reviews section ends -->

    <!-- contact section starts  -->

    <section class="contact" id="contact">

        <h1 class="heading"> <span>contact</span> us </h1>

        <div class="row">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3263.475737633009!2d75.60698091488736!3d28.380210082518023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39131b100a4bf9b7%3A0xe33d85c5da1190bd!2sOm%20electronics!5e1!3m2!1sen!2sin!4v1667634411190!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>
            <!-- contact form starts -->
            <?php include('contactform.php'); ?>

            <!-- contact form ends -->
        </div>

    </section>
    <!-- contact section ends -->

    <!-- footer section starts  -->

    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>quick links</h3>
                <a class="link" href="#home"> <i class="fas fa-angle-right"></i> Home</a>
                <a class="link" href="#about"> <i class="fas fa-angle-right"></i> About</a>
                <a class="link" href="#services"> <i class="fas fa-angle-right"></i> Services</a>
                <a class="link" href="#contact"> <i class="fas fa-angle-right"></i> Contact</a>
                <button onclick="open_login_modal()" class="link"> <i class="fas fa-angle-right"></i> Login</button>
                <button class="link" onclick="open_register_modal()"> <i class="fas fa-angle-right"></i> Register</button>
            </div>
            <div class="box">
                <h3>opening hours</h3>
                <p> <span>Monday :</span> 10am to 9pm </p>
                <p> <span>Tuesday :</span> 10am to 9pm </p>
                <p> <span>Wednesday :</span> 10am to 9pm </p>
                <p> <span>Thursday :</span> 10am to 9pm </p>
                <p> <span>Friday :</span> 10am to 9pm </p>
                <p> <span>Saturday :</span> 10am to 9pm </p>
                <p> <span>Sunday :</span> Closed </p>
            </div>
            <div class="box">
                <h3>contact info</h3>
                <a href="tel:+91 9876543210" class="link"> <i class="fas fa-phone"></i> +91 9876543210 </a>
                <a href="tel:+91 1234567891" class="link"> <i class="fas fa-phone"></i> +91 1234567891 </a>
                <a href="mailto:shubhamkbiwal21042003@gmail.com" class="link"> <i class="fas fa-envelope"></i>
                    shubhamkumar@gmail.com </a>
                <a href="" class="link"> <i class="fas fa-map"></i> Pilani, India - 333502 </a>
            </div>
            <div class="box">
                <h3>Follow Us</h3>
                <div class="share">
                    <a href="" class="fab fa-facebook-f"></a>
                    <a href="" class="fab fa-twitter"></a>
                    <a href="" class="fab fa-instagram"></a>
                    <a href="" class="fab fa-linkedin"></a>
                </div>
            </div>
        </div>
    </section>
    <div class="credit"> created by <span> <a href="https://ishubhamkumar.netlify.app/" target="_blank">Shubham Kumar</a></span> | all rights reserved!</div>
    <!-- footer section ends -->



    <!-- registeration  modal starts -->

    <div class="overlay" id="overlay">
        <div class="modal-content">

            <div class="container">
                <div class="forms">
                    <div class="form-content">
                        <div class="signup-form">
                            <div class="back-btn"><button onclick="close_register_modal()"><i class="fa-solid fa-xmark"></i></button></div>
                            <div class="title">Create Account</div>
                            <form action="" method="POST">
                                <div class="input-boxes">
                                    <div class="input-box">
                                        <i class="fas fa-user"></i>
                                        <input type="text" placeholder="Name" name="uName" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fa-solid fa-phone"></i>
                                        <input type="number" placeholder="Mobile" name="uMobile" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" placeholder="Email" name="uEmail" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" placeholder="Password" name="uPassword" required>
                                    </div>
                                    <div class="button input-box">
                                        <input type="submit" value="Sign Up" name="uSignup">
                                    </div>
                                    <div class="text sign-up-text">Already have an account? <button onclick="login_here()">Login here</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- registration  modal ends -->

    <!-- login  modal starts -->


    <div class="overlay-login" id="overlay-login">
        <div class="login-modal-content">

            <div class="container">
                <div class="forms">
                    <div class="form-content">
                        <div class="login-form">
                            <div class="back-btn"><button onclick="close_login_modal()"><i class="fa-solid fa-xmark"></i></button></div>
                            <div class="title">Login</div>

                            <form action="" method="POST">
                                <div class="input-boxes">

                                    <div class="input-box">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" placeholder="Email" name="uEmail" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" placeholder="Password" name="uPassword" required>
                                    </div>
                                    <div class="button input-box">
                                        <input type="submit" value="Login" name="uLogin">
                                    </div>
                                    <div class="text login-text">Don't have an account? <button onclick="signupnow()">Signup now</button>
                                        <div class="text login-text"> <a href="password-reset.php">Forgot Password? </a>
                                        </div>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!-- login  modal ends -->









    <!-- custom js file  -->
    <script>
        //hamburger menu

        let menu = document.querySelector("#menu-btn");
        let navbarLinks = document.querySelector(".header .navbar .links");

        menu.onclick = () => {
            menu.classList.toggle("fa-times");
            navbarLinks.classList.toggle("active");
        };

        //onscroll navbar

        window.onscroll = () => {
            menu.classList.remove("fa-times");
            navbarLinks.classList.remove("active");

            if (window.scrollY > 60) {
                document.querySelector(".header .navbar").classList.add("active");
            } else {
                document.querySelector(".header .navbar").classList.remove("active");
            }
        };


        // register modal js

        var modal = document.getElementById("overlay");

        function open_register_modal() {
            modal.style.display = "block";
        }

        function close_register_modal() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // login modal js

        var LoginModal = document.getElementById("overlay-login");

        function open_login_modal() {
            LoginModal.style.display = "block";
        }

        function close_login_modal() {
            LoginModal.style.display = "none";
        }

        //already have?

        function login_here() {
            modal.style.display = "none";
            LoginModal.style.display = "block";
        }

        function signupnow() {
            LoginModal.style.display = "none";
            modal.style.display = "block";
        }
    </script>
</body>

</html>