<?php
$page = "changepassword";

include "../connection.php";
include "include/header-sidebar.php";
$temail = $_SESSION['is_techlogin'];


if (isset($_POST['updatebtn'])) {
    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];

    if ($newpass == "" || $confirmpass == "") {
        echo '<script>alert("All Fields Are Required!");</script>';
    } else {
        if ($newpass == $confirmpass) {
            $sql = "UPDATE technician_tb SET tech_password = '$newpass' WHERE tech_email = '$temail'";
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
    <title>Change Password</title>
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

        #aemail {
            background: var(--blue);
            color: white;
            box-shadow: .1rem .1rem .2rem rgba(0, 0, 0, 0.5);
            outline: none;
            font-weight: bold;
            border: none;
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
        @media(max-width:750px){
            .content{
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="container">
            <form action="" method="post">
                <label for="aemail"><b>Email</b></label>
                <input type="text" name="aemail" id="aemail" value="<?php echo $temail; ?>" readonly>
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