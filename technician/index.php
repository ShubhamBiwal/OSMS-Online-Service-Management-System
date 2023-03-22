<?php
include"../connection.php";
//signup
if (isset($_POST['tSignup'])) {
    $tName = $_POST['tName'];
    $tCity = $_POST['tCity'];
    $tMobile = $_POST['tMobile'];
    $tEmail = strtolower($_POST['tEmail']);
    $tPassword = $_POST['tPassword'];

    //check empty fields
    if ($tName == "" || $tCity=="" || $tMobile=="" || $tEmail == "" || $tPassword == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {
        //check already exist email id
        $sql = "SELECT tech_email FROM technician_tb WHERE tech_email = '$tEmail' ";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_num_rows($result) == 1) {
            echo '<script> alert("Email ID Already Registered.");</script>';
        } else {
            //insert data
            $sql = "INSERT INTO technician_tb(tech_name, tech_city, tech_mobile, tech_email, tech_password) VALUES ('$tName', '$tCity', '$tMobile', '$tEmail', '$tPassword') ";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<script> alert("Account Created Successfully.");</script>';
                $_SESSION['is_techlogin'] = $tEmail;
                echo "<script> location.href='profile.php';</script>";
            } else {
                echo '<script> alert("Error: Unable to Create Account.");</script>';
            }
        }
    }
}

//login
if (isset($_POST['tLogin'])) {
    $tEmail = strtolower(trim($_POST['tEmail']));
    $tPassword = trim($_POST['tPassword']);

    $sql = "SELECT tech_email, tech_password FROM technician_tb WHERE tech_email = '$tEmail' AND tech_password = '$tPassword' ";
    $result = mysqli_query($conn, $sql);
    if ($row  = mysqli_num_rows($result) == 1) {
        $_SESSION['is_techlogin'] = $tEmail;
        echo "<script> location.href='tech-profile.php';</script>";
        exit;
    } else {
        echo '<script>alert("Login Failed: Invalid Email or Password.");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Login</title>
    <meta name="theme-color" content="#2597f4">
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap");

        * {
            font-family: "Montserrat", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: all 0.2s linear;
        }

        :root {
            --blue: #2597f4;
            --black: #334;
            --white: #ffffff;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(var(--blue), var(--black));
        }
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }


        .container {
            position: relative;
            max-width: 90%;
            width: 45rem;
            background: #fff;
            padding: 2rem;
            box-shadow: 0 .4rem 1rem rgba(0, 0, 0, 0.2);
            border-radius: 2%;
        }

        .container .form-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-content .login-form {
            width: 100%;
        }

        .forms .form-content .title {
            position: relative;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--black);
            border-left: .2rem solid var(--blue);
        }

        .forms .form-content .input-boxes {
            margin-top: 2rem;
        }

        .forms .form-content .input-box {
            display: flex;
            align-items: center;
            height: 3rem;
            width: 100%;
            margin: 1.5rem 0;
            position: relative;
        }

        .form-content .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            border: none;
            padding: 0 2rem;
            font-size: 1rem;
            border-bottom: .1rem solid rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .form-content .input-box input:focus {
            border-color: var(--black);
        }

        .form-content .input-box i {
            position: absolute;
            color: var(--blue);
            font-size: 1.1rem;
        }

        .forms .form-content .button {
            color: #fff;
            margin-top: 2.5rem;
        }

        .forms .form-content .button input {
            color: #fff;
            background: var(--blue);
            border-radius: .4rem;
            cursor: pointer;
            font-size: 1.1rem;
            font-weight: 500;
            letter-spacing: .05rem;
            transition: all 0.4s ease;
        }

        .forms .form-content .button input:hover {
            background: #1276c8;
        }

        .container .links {
            display: flex;
            flex-direction: column;
            text-align: center;
            row-gap: .7rem;
        }

        .container .links span {
            font-size: 1rem;
        }

        .container .links span button {
            border: none;
            color: var(--blue);
            font-weight: 550;
            font-size: 1rem;
            background: transparent;
            cursor: pointer;
        }

        .container .links a {
            text-decoration: none;
            color: var(--blue);
            font-size: 1rem;
            font-weight: 550;
        }

        .container .links span button:hover {
            text-decoration: underline;
        }

        .container .links a:hover {
            text-decoration: underline;
        }

        /* registeration modal */

        .overlay {
            top: 0;
            left: 0;
            right: 0;
            height: 100vh;
            width: 100vw;
            background: rgba(0, 0, 0, 0.5);
            position: fixed;
            z-index: 100;
            display: none;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: auto;
            width: 50%;
            z-index: 11;
            background-color: #fff;
            box-shadow: 4px 4px 14px rgba(0, 0, 0, 0.8);
            border-radius: 5px;

        }

        .modal-content .modal-box {
            position: relative;
            width: 100%;
        }

        .modal-content .form-content .signup-form {
            width: 100%;
            padding: 18px;

        }

        .modal-content .forms .form-content .title {
            position: relative;
            font-size: 22px;
            font-weight: 600;
            color: var(--black);
            border-left: 4px solid var(--blue);
        }

        .modal-content .forms .form-content .back-btn {
            text-align: right;
        }

        .modal-content .forms .form-content .back-btn i {
            font-size: 25px;
            font-weight: 600;
            color: #fff;
            padding: 10px 15px;
            background: var(--blue);
            border-radius: 4px;
            text-align: right;
        }

        .modal-content .forms .form-content .back-btn button {
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .modal-content .forms .form-content .back-btn i:hover {
            color: black;
        }

        .modal-content .forms .form-content .input-boxes {
            margin-top: 20px;
        }

        .modal-content .forms .form-content .input-box {
            display: flex;
            align-items: center;
            height: 40px;
            width: 100%;
            margin: 25px 0;
            position: relative;
        }

        .modal-content .form-content .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            border: none;
            padding: 0 30px;
            font-size: 16px;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .modal-content .form-content .input-box input:focus {
            border-color: var(--black);
        }

        .modal-content .form-content .input-box i {
            position: absolute;
            color: var(--blue);
            font-size: 16px;
        }

        .modal-content .forms .form-content .text {
            font-size: 12px;
            font-weight: 500;
            color: #333;
        }

        .modal-content .forms .form-content .text button {
            text-decoration: none;
            border: none;
            color: var(--blue);
            background: transparent;
            cursor: pointer;
            font-size: 16px;
            font-weight: 550;
        }

        .modal-content .forms .form-content .text button:hover {
            text-decoration: underline;
        }

        .modal-content .forms .form-content .button {
            color: #fff;
            margin-top: 25px;
            height: 50px;
        }

        .modal-content .forms .form-content .button input {
            color: #fff;
            background: var(--blue);
            border-radius: 4px;
            cursor: pointer;
            font-size: 20px;
            font-weight: 500;
            letter-spacing: 2px;
            transition: all 0.4s ease;
        }

        .modal-content .forms .form-content .button input:hover {
            background: #1276c8;
        }

        .modal-content .forms .form-content .sign-up-text {
            text-align: center;
            margin: 15px 0;
            font-size: 15px;
        }


        @media (max-width:750px) {


            .overlay .modal-content {
                width: 90vw;
                height: auto;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Technician Login</div>
                    <form action="" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" placeholder="Email" name="tEmail" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" name="tPassword" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Login" name="tLogin">
                            </div>
                            <div class="links">
                                <span>Don't have an account? <button onclick="open_register_modal()">Register Here</button></span>
                                <a href="password-reset.php">Forgot Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- registeration  modal starts -->

    <div class="overlay" id="overlay">
        <div class="modal-content">
            <div class="modal-box">
                <div class="forms">
                    <div class="form-content">
                        <div class="signup-form">
                            <div class="back-btn"><button onclick="close_register_modal()"><i class="fa-solid fa-xmark"></i></button></div>
                            <div class="title">Create Account</div>
                            <form action="" method="POST">
                                <div class="input-boxes">
                                    <div class="input-box">
                                        <i class="fas fa-user"></i>
                                        <input type="text" placeholder="Name" name="tName" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <input type="text" placeholder="City/Villege" name="tCity" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fa-solid fa-phone"></i>
                                        <input type="number" placeholder="Mobile" name="tMobile" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fas fa-envelope"></i>
                                        <input type="email" placeholder="Email" name="tEmail" required>
                                    </div>
                                    <div class="input-box">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" placeholder="Password" name="tPassword" required>
                                    </div>
                                    <div class="button input-box">
                                        <input type="submit" value="Sign Up" name="tSignup">
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

    <script>
        // register modal js

        var modal = document.getElementById("overlay");
        var container = document.getElementsByClassName("container");


        function open_register_modal() {
            modal.style.display = "block";
            container.style.display = "none";
        }

        function close_register_modal() {
            modal.style.display = "none";
            container.style.display = "block";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function login_here() {
            modal.style.display = "none";
            container.style.display = "block";
        }
    </script>
</body>

</html>