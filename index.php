<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <title>OSMS | Online Service Maintenance System</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">


    <style>
        /* registeration modal */

       
    </style>


</head>

<body>

    <!-- header section starts  -->

    <header class="header">

        <nav class="navbar">

            <a href="#" class="logo"> <i class="fas fa-tools"></i> OSMS </a>

            <div class="links">
                <a href="index.php">home</a>
                <a href="#AboutUs">about</a>
                <a href="#services">services</a>
                <a href="#reviews">Reviews</a>
                <a href="#contact">contact</a>
                <button onclick="open_login_modal()">login</button>
                <button onclick="open_register_modal()">register</button>
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
            <h3>Why fix it yourself? Leave it to the pros!</h3>
            <p>Your city’s best electronic appliances service provider. Bringing your home appliances back to your life.
            </p>
            <button onclick="open_login_modal()" class="btn">login</button>
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
                    <h3>1000+</h3>
                    <p>Request Competed</p>
                </div>
            </div>
            <div class="box">
                <img src="images/fun-fact-icon-2.svg" alt="">
                <div class="info">
                    <h3>400+</h3>
                    <p>Happy Clients</p>
                </div>
            </div>

            <div class="box">
                <img src="images/fun-fact-icon-3.svg" alt="">
                <div class="info">
                    <h3>20+</h3>
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
                <a class="link" href="#"> <i class="fas fa-angle-right"></i> Contact</a>
                <a class="link" href="#"> <i class="fas fa-angle-right"></i> Login</a>
                <a class="link" href="#"> <i class="fas fa-angle-right"></i> Register</a>
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
                            <div class="back-btn"><a href="" onclick="close_register_modal()"><i class="fa-solid fa-xmark"></i></a></div>
                            <div class="title">Create Account</div>

                            <form action="" method="POST">
                                <div class="input-boxes">
                                    <div class="input-box">
                                        <i class="fas fa-user"></i>
                                        <input type="text" placeholder="Name" name="uName" required>
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
                            <div class="back-btn"><a href="" onclick="close_login_modal()"><i class="fa-solid fa-xmark"></i></a></div>
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
                                        <input type="submit" value="Login" name="uSignup">
                                    </div>
                                    <div class="text login-text">Don't have an account? <button onclick="signupnow()">Signup now</button>
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