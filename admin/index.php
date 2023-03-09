<?php
include "../connection.php";
session_start();

if(isset($_SESSION['is_adminlogin'])){
    header("Location: dashboard.php");

}

if (isset($_POST['aLogin'])) {
    $aEmail = trim($_POST['aEmail']);
    $aPassword = trim($_POST['aPassword']);

    //check empty fields
    if ($aEmail == "" || $aPassword == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {

        $sql = "SELECT a_email, a_password FROM admin_login WHERE a_email = '$aEmail' AND a_password = '$aPassword' ";
        $result = mysqli_query($conn, $sql);
        if ($row  = mysqli_num_rows($result) == 1) {
            $_SESSION['is_adminlogin'] = $aEmail;
            echo "<script> location.href='dashboard.php';</script>";
            exit;
        } else {
            echo '<script>alert("Login Failed: Invalid Email or Password.");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
            background-image: linear-gradient(var(--black), var(--blue));
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
    </style>
</head>

<body>
    <div class="container">
        <div class="forms">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">Admin Login</div>
                    <form action="" method="POST">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="email" placeholder="Email" name="aEmail" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input type="password" placeholder="Password" name="aPassword" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Login" name="aLogin">
                            </div>
                        </div>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>