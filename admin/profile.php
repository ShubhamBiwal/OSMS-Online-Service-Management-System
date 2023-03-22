<?php
$page = "admin-profile";
include "../connection.php";
include "include/header-sidebar.php";
//show data
$aEmail = $_SESSION['is_adminlogin'];
$sql  = "SELECT * FROM admin_login WHERE a_email = '$aEmail'";

$run = mysqli_query($conn, $sql);

if ($result = mysqli_fetch_array($run)) {
    $aName = $result['a_name'];
    $aContact = $result['a_contact'];
    $aAddress = $result['a_address'];
    $aImg = $result['a_img'];
}
//update data
if (isset($_POST['updatebtn'])) {
    $newname = $_POST['aname'];
    $newemail = strtolower(trim($_POST['aemail']));
    $newcontact = $_POST['acontact'];
    $newaddress = $_POST['aaddress'];
    //upload image
    $imgname = $_FILES['pfimg']['name'];
    $imgpath = "a_images/" . $imgname;

    if ($imgname != "") {
        // Get file info 
        $fileName = basename($_FILES["pfimg"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            $tempname = $_FILES['pfimg']['tmp_name'];

            move_uploaded_file($tempname, $imgpath);
            //   delete old image
            $runquery = mysqli_query($conn, "SELECT * FROM admin_login WHERE a_email = '$aEmail'");
            if ($result = mysqli_fetch_array($runquery)) {
                $delimage = $result['a_img'];
                if ($imgpath != $delimage) {
                    unlink($delimage);
                }
            }

            $sql = "UPDATE admin_login SET a_name = '$newname', a_email = '$newemail', a_contact='$newcontact', a_address = '$newaddress', a_img = '$imgpath' WHERE a_email = '$aEmail'";
            $run = mysqli_query($conn, $sql);
            if ($run) {
                $_SESSION['is_adminlogin'] = $newemail;
                echo '<script>alert("Profile Updated Successfully.")</script>';
                echo '<script>window.location = "profile.php";</script>';
            }
        } else {
            echo '<script>alert("not supported");</script>';
        }
    } else {
        $sql = "UPDATE admin_login SET a_name = '$newname', a_email = '$newemail', a_contact='$newcontact', a_address = '$newaddress' WHERE a_email = '$aEmail'";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            $_SESSION['is_adminlogin'] = $newemail;
            echo '<script>alert("Profile Updated.");</script>';
            echo '<script>window.location = "profile.php";</script>';
        }
    }
}

?>

<head>
    <title>Profile</title>

    <style>
        input::-webkit-inner-spin-button {
            display: none;
        }

        .container {
            padding: 1.6rem;
            box-shadow: 0.4rem 0.4rem 1rem rgba(0, 0, 0, 0.4);
            width: 70%;
        }

        label {
            font-size: 1.5rem;
            color: var(--black);
        }

        .pimg {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            flex-direction: column;
            margin-bottom: 2rem;
            padding: 1rem 0;
            background: #f2f2f2;
        }


        .primg::-webkit-file-upload-button {
            visibility: hidden;
        }

        .pimg img {
            width: 20rem;
            height: 20rem;
            border-radius: 50%;
            border: .5rem solid var(--blue);
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.05);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            outline: .1rem solid rgba(0, 0, 0, 0.4);
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
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .updatebtn:hover {
            opacity: 1;
        }

        .button {
            padding: 1.2rem 1.8rem;
            cursor: pointer;
            border-radius: .5rem;
            background-color: var(--black);
            font-size: 1.6rem;
            font-weight: bold;
            color: #fff;
        }

        @media (max-width: 950px) {
            .container {
                width: 100%;
            }
        }

        @media (max-width: 750px) {

            .address,
            .address2,
            .address3 {
                flex-direction: column;
            }

            .inputbox,
            .inputbox2 {
                width: 100%;
            }

            .content {
                padding: 2rem;
            }

        }
    </style>

</head>

<body>

    <div class="content">
        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="pimg">
                    <img src="<?php echo $aImg; ?>">
                    <label class="button" for="upload">Upload File</label>
                    <input id="upload" type="file" class="primg" name="pfimg">
                </div>
                <label for="aname"><b>Name</b></label>
                <input type="text" name="aname" id="aname" value="<?php echo $aName; ?>">
                <label for="aemail"><b>Email</b></label>
                <input type="email" name="aemail" id="aemail" value="<?php echo $aEmail; ?>">
                <label for="acontact"><b>Contact</b></label>
                <input type="number" name="acontact" id="acontact" value="<?php echo $aContact; ?>">
                <label for="aaddress"><b>Address</b></label>
                <input type="text" name="aaddress" id="aaddress" value="<?php echo $aAddress; ?>">

                <button type="submit" class="updatebtn" name="updatebtn">Update</button>

            </form>
        </div>

    </div>

</body>