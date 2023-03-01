<?php
include "../connection.php";
include "include/header-sidebar.php";
//show data
$uEmail = $_SESSION['is_login'];
$sql  = "SELECT u_name, u_email FROM user_login WHERE u_email = '$uEmail'";

$run = mysqli_query($conn, $sql);

if ($result = mysqli_fetch_array($run)) {
    $uName = $result['u_name'];
    $uEmail = $result['u_email'];
}
//update data
if (isset($_POST['updatebtn'])) {
    $newname = $_POST['uname'];
    $sql = "UPDATE user_login SET u_name = '$newname' WHERE u_email = '$uEmail'";
    $run = mysqli_query($conn, $sql);
    if ($run) {

        echo '<script>alert("Profile Updated.");</script>';
        echo '<script>window.location = "user-profile.php";</script>';
    }
}

?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <title>Profile</title>
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
            margin: 1rem 0;
            background: #f4f4f4;
            border: none;
        }

        input[type="text"]:focus {
            outline: none;
        }

        #uemail {
            background: #dfdfdf;
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
        }

        .updatebtn:hover {
            opacity: 1;
        }

      
    </style>

</head>

<body>
    <div class="content">
        <div class="container">
            <form action="" method="post">
                <label for="pemail"><b>Email</b></label>
                <input type="text" name="uemail" id="uemail" value="<?php echo $uEmail; ?>" readonly>
                <label for="uname"><b>Name</b></label>
                <input type="text" name="uname" id="uname" value="<?php echo $uName; ?>">

                <!-- <label for="pcontact"><b>Contact</b></label>
                    <input type="text" name="pcontact" id="pcontact" value="">
                    <label for="paddress"><b>Address</b></label>
                    <input type="text" name="paddress" id="paddress" value=""> -->

                <button type="submit" class="updatebtn" name="updatebtn">Update</button>

            </form>
        </div>

    </div>



</body>

</html>