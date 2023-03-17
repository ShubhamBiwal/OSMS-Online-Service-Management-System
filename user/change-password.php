<?php
$page = "changepass";

include "../connection.php";
include "include/header-sidebar.php";
$remail = $_SESSION['is_login'];


if (isset($_POST['updatebtn'])) {
    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];

    if ($newpass == "" || $confirmpass == "") {
        echo '<script>alert("All Fields Are Required!");</script>';
    } else {
        if ($newpass == $confirmpass) {
            $sql = "UPDATE user_login SET u_password = '$newpass' WHERE u_email = '$remail'";
            $run = mysqli_query($conn, $sql);
            if ($run) {
                echo '<script>alert("Password Updated Succesfully.");</script>';
            } else {
                echo '<script>alert("Error: Unable to Update.");</script>';
            }
        } else {
            echo '<script>alert("Password Fields Must be Equal!");</script>';
        }
    }
}




?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <title>Change Password</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href="../css/user-style.css">

    <style>
        .container {
            padding: 1.6rem;
            box-shadow: 0.4rem 0.4rem 1rem rgba(0, 0, 0, 0.4);
            width: 100%;
        }

        label {
            font-size: 1.5rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.05);
        }

        input[type="text"]:focus {
            outline: .1rem solid rgba(0, 0, 0, 0.4);

        }

        #uemail {
            background: var(--blue);
            color: white;
            box-shadow: .1rem .1rem .2rem rgba(0, 0, 0, 0.5);
            outline: none;
            border: none;
            font-weight: bold;
        }

        .updatebtn {
            background-color: var(--blue);
            padding: 1rem 0;
            margin: 0.8rem 0;
            cursor: pointer;
            border: none;
            width: 12rem;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .2rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);
        }

        .resetbtn {
            background-color: #000;
            padding: 1rem 0;
            margin: 0.8rem 0 0.8rem 2rem;
            cursor: pointer;
            border: none;
            width: 12rem;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .2rem;
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .updatebtn:hover,
        .resetbtn:hover {
            opacity: 1;
        }

        .updatebtn:hover {
            opacity: 1;
        }

        @media(max-width:750px) {

            .content {
                padding: 2rem;
            }

        }
    </style>
</head>

<body>
    <div class="content">
        <div class="container">
            <form action="" method="post">
                <label for="uemail"><b>Email</b></label>
                <input type="text" name="uemail" id="uemail" value="<?php echo $remail; ?>" readonly>
                <label for="newpass"><b>New Password</b></label>
                <input type="text" name="newpass" id="newpass" value="" placeholder="Enter New Password" required>
                <label for="confirmpass"><b>Confirm Password</b></label>
                <input type="text" name="confirmpass" id="confirpass" value="" placeholder="Confirm Password" required>
                <button type="submit" class="updatebtn" name="updatebtn">Update</button>
                <button type="reset" class="resetbtn" name="resetbtn">Reset</button>

            </form>
        </div>

    </div>

</body>

</html>