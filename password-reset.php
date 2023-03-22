<?php
include "connection.php";
session_start();
echo '<style>#passbox{display:none;}</style>';
echo '<style>#otpbox{display:none;}</style>';
//send mail function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $code)
{
    require 'phpmailer/Exception.php';
    require 'phpmailer/PHPMailer.php';
    require 'phpmailer/SMTP.php';

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'shubhambiwal21042003@gmail.com';                     //SMTP username
        $mail->Password   = 'layllemfzdliahlg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('shubhambiwal21042003@gmail.com', 'OSMS');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset Your Account Password';
        $mail->Body    = "Your OTP for Reset Password is: <h1>$code<h1>";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
//verify email
if (isset($_POST['resetbtn'])) {
    $foremail = strtolower(trim($_POST['femail']));

    $sql = "SELECT u_email FROM user_login WHERE u_email = '$foremail'";
    $run = mysqli_query($conn, $sql);

    if ($result = mysqli_fetch_array($run)) {
        if ($foremail == $result['u_email']) {
            $_SESSION['forgot-email'] = $result['u_email'];
            $code = rand(100000, 999999);

            $sql3 = "UPDATE user_login SET code = '$code' WHERE u_email = '$foremail' ";
            if (mysqli_query($conn, $sql3) && sendMail($foremail, $code)) {
                echo '<script>alert("OTP has been sent to ' . $foremail . '")</script>';
                echo '<style>#otpbox{display:block;}</style>';
                echo '<style>#emailbox{display:none;}</style>';
            }
        }
    } else {
        echo '<script>alert("Email Address Does Not Exist!");</script>';
    }
}
//otp
if (isset($_POST['otpbtn'])) {
    $otp = $_POST['otp'];
    $uemail = $_SESSION['forgot-email'];
    $sql = "SELECT code FROM user_login WHERE u_email = '$uemail'";
    $run = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($run);
    $uotp = $row['code'];
    if($otp == $uotp){
        echo '<style>#emailbox{display:none;}</style>';
        echo '<style>#passbox{display:block;}</style>';

    }
    else{
        echo '<script>alert("Incorrect OTP");</script>';

    }
}





//password change
if (isset($_POST['submit-btn'])) {
    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];
    $forgotemail = $_SESSION['forgot-email'];

    if ($newpass == $confirmpass) {

        $sql2 = "UPDATE user_login SET u_password = '$newpass' WHERE u_email = '$forgotemail' ";
        $run2 = mysqli_query($conn, $sql2);

        if ($run2) {
            echo '<script>alert("Password Updated Successfully.")</script>';
            echo '<script>window.location="/osms";</script>';
        }
    } else {

        echo '<script>alert("Password Fields Mismatched!")</script>';
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap");

        * {
            font-family: "Montserrat", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 22px auto;
        }

        .container {
            padding: 16px;
            background-color: #f5f5f5;
            margin: 0 25%;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        input[type=email],
        input[type=text] {
            width: 100%;
            padding: 15px;
            margin: 15px 0 22px 0;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
        }

        input[type=email]:focus,
        input[type=text]:focus {
            outline: 2px solid rgba(0, 0, 0, 0.3);
        }

        hr {
            border: 1px solid rgba(0, 0, 0, 0.2);
            margin: 20px 0;
        }

        .submitbtn {
            background-color: #2597f4;
            padding: 16px 20px;
            margin: 8px 0;
            cursor: pointer;
            border: none;
            width: 100%;
            opacity: 0.85;
            color: white;
            font-size: 17px;
            letter-spacing: 1px;
        }

        .submitbtn:hover {
            opacity: 1;
        }

        .register {
            background-color: #f1f1f1;
            text-align: center;
            margin-top: -16px;
        }

        .register a {
            text-decoration: none;
            color: #2597f4;
        }

        .register a:hover {
            border-bottom: 2px solid #2597f4;
        }

        .resetbtn {
            background: #2597f4;
            border: none;
            padding: 12px 24px;
            margin-bottom: 22px;
            display: flex;
            opacity: .8;
            cursor: pointer;
            color: white;
            font-size: 17px;
            text-align: center;
            border-radius: .2rem;
        }

        .resetbtn:hover {
            opacity: 1;
        }


        @media (max-width:750px) {
            .container {
                margin: 0 5%;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Forgot Password</h1>
        <hr>
        <div id="emailbox">
            <form action="" method="post">
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="femail" id="email" required>
                <button type="submit" class="resetbtn" name="resetbtn">Reset</button>
            </form>
        </div>
        <div id="otpbox">
            <form action="" method="post">
                <label for="otp"><b>OTP</b></label>
                <input type="text" placeholder="Enter OTP" name="otp" id="otp" required>
                <button type="submit" class="submitbtn" name="otpbtn">Submit</button>
            </form>
        </div>
        <div id="passbox">
            <form action="" method="post">
                <label for="newpass"><b>New Password</b></label>
                <input type="text" placeholder="Enter New Password" name="newpass" id="newpassword" required>

                <label for="confirmpass"><b>Confirm Password</b></label>
                <input type="text" placeholder="Re-Enter Password" name="confirmpass" id="confirmpassword" required>

                <button type="submit" class="submitbtn" name="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <div class="container register">
        <p><a href="/osms">Go to Homepage</a></p>
    </div>





</body>

</html>