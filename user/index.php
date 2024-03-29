<?php
$page = "userprofile";
include "../connection.php";
include "include/header-sidebar.php";
//show data
$uEmail = $_SESSION['is_login'];
$uid = $_SESSION['u_id'];
$sql  = "SELECT * FROM user_login WHERE u_email = '$uEmail'";
$run = mysqli_query($conn, $sql);

if ($result = mysqli_fetch_array($run)) {
    $uName = $result['u_name'];
    $uAdd1 = $result['u_add1'];
    $uAdd2 = $result['u_add2'];
    $uCity = $result['u_city'];
    $uState = $result['u_state'];
    $uZip = $result['u_zip'];
    $uMobile = $result['u_mobile'];
    $uimage = $result['u_image'];
}
//update data
if (isset($_POST['updatebtn'])) {
    $newname = $_POST['uname'];
    $newadd1 = $_POST['uaddress1'];
    $newadd2 = $_POST['uaddress2'];
    $newcity = $_POST['ucity'];
    $newstate = $_POST['ustate'];
    $newzip = $_POST['uzip'];
    $newmobile = $_POST['umobile'];
    //upload image
    $imgname = $_FILES['pfimg']['name'];
    $imgpath = "pf_images/" . $imgname;

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
            $runquery = mysqli_query($conn, "SELECT * FROM user_login WHERE u_email = '$uEmail'");
            if ($result = mysqli_fetch_array($runquery)) {
                $delimage = $result['u_image'];
                if ($imgpath != $delimage) {
                    unlink($delimage);
                }
            }
            $sql = "UPDATE user_login SET u_name = '$newname', u_add1 = '$newadd1', u_add2='$newadd2', u_city = '$newcity',u_state = '$newstate', u_zip = '$newzip', u_mobile = '$newmobile', u_image = '$imgpath' WHERE u_email = '$uEmail'";
            $run = mysqli_query($conn, $sql);
            if ($run) {
                $_SESSION['status_title'] = "Success";
                $_SESSION['status_text'] = "Your profile has been updated successfully!";
                $_SESSION['status_icon'] = "success";
            }
        } else {
            $_SESSION['status_title'] = "Error";
            $_SESSION['status_text'] = "Image format not supported only (jpg, png, jpeg, gif).";
            $_SESSION['status_icon'] = "error";
        }
    } else {
        $sql = "UPDATE user_login SET u_name = '$newname', u_add1 = '$newadd1', u_add2='$newadd2', u_city = '$newcity',u_state = '$newstate', u_zip = '$newzip', u_mobile = '$newmobile' WHERE u_email = '$uEmail'";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            $_SESSION['status_title'] = "Success";
            $_SESSION['status_text'] = "Your profile has been updated successfully!";
            $_SESSION['status_icon'] = "success";
        }
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
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.05);
        }

        .ustate {
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.05);
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        .ustate:focus {
            outline: .1rem solid rgba(0, 0, 0, 0.4);
        }

        .address,
        .address2,
        .address3 {
            display: flex;
            flex-direction: row;
            gap: 2rem;
        }

        .inputbox {
            width: 50%;
        }

        .inputbox2 {
            width: 25%;
        }

        input::-webkit-inner-spin-button {
            display: none;
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

        #uemail {
            background: var(--blue);
            color: white;
            box-shadow: .1rem .1rem .2rem rgba(0, 0, 0, 0.5);
            outline: none;
            font-weight: bold;
            border: none;
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
                    <img src="<?php echo $uimage; ?>">
                    <label class="button" for="upload">Upload File</label>
                    <input id="upload" type="file" class="primg" name="pfimg">
                </div>
                <label for="uemail"><b>Email</b></label>
                <input type="text" name="uemail" id="uemail" readonly value="<?php echo $uEmail; ?>">
                <label for="uname"><b>Name</b></label>
                <input type="text" name="uname" id="uname" value="<?php echo $uName; ?>">

                <div class="address">
                    <div class="inputbox">
                        <label for="uaddress1"><b>Address Line 1</b></label>
                        <input type="text" name="uaddress1" id="uaddress1" placeholder="House No. / Street" value="<?php echo $uAdd1; ?>">
                    </div>
                    <div class="inputbox">
                        <label for="uaddress2"><b>Address Line 2</b></label>
                        <input type="text" name="uaddress2" id="uaddress2" placeholder="Area / Villege" value="<?php echo $uAdd2; ?>">
                    </div>
                </div>

                <div class="address2">
                    <div class="inputbox2">
                        <label for="ucity"><b>City</b></label>
                        <input type="text" name="ucity" id="ucity" value="<?php echo $uCity; ?>">
                    </div>
                    <div class="inputbox2">
                        <label for="ustate"><b>State</b></label>
                        <select name="ustate" id="state" class="ustate">
                            <option value="Andhra Pradesh" <?php if ($uState == "Andhra Pradesh") echo "Selected"; ?>>Andhra Pradesh</option>
                            <option value="Andaman and Nicobar Islands" <?php if ($uState == "Andaman and Nicobar Islands") echo "Selected"; ?>>Andaman and Nicobar Islands</option>
                            <option value="Arunachal Pradesh" <?php if ($uState == "Arunachal Pradesh") echo "Selected"; ?>>Arunachal Pradesh</option>
                            <option value="Assam" <?php if ($uState == "Assam") echo "Selected"; ?>>Assam</option>
                            <option value="Bihar" <?php if ($uState == "Bihar") echo "Selected"; ?>>Bihar</option>
                            <option value="Chandigarh" <?php if ($uState == "Chandigarh") echo "Selected"; ?>>Chandigarh</option>
                            <option value="Chhattisgarh" <?php if ($uState == "Chhattisgarh") echo "Selected"; ?>>Chhattisgarh</option>
                            <option value="Dadar and Nagar Haveli" <?php if ($uState == "Dadar and Nagar Haveli") echo "Selected"; ?>>Dadar and Nagar Haveli</option>
                            <option value="Daman and Diu" <?php if ($uState == "Daman and Diu") echo "Selected"; ?>>Daman and Diu</option>
                            <option value="Delhi" <?php if ($uState == "Delhi") echo "Selected"; ?>>Delhi</option>
                            <option value="Lakshadweep" <?php if ($uState == "Lakshadweep") echo "Selected"; ?>>Lakshadweep</option>
                            <option value="Puducherry" <?php if ($uState == "Puducherry") echo "Selected"; ?>>Puducherry</option>
                            <option value="Goa" <?php if ($uState == "Goa") echo "Selected"; ?>>Goa</option>
                            <option value="Gujarat" <?php if ($uState == "Gujarat") echo "Selected"; ?>>Gujarat</option>
                            <option value="Haryana" <?php if ($uState == "Haryana") echo "Selected"; ?>>Haryana</option>
                            <option value="Himachal Pradesh" <?php if ($uState == "Himachal Pradesh") echo "Selected"; ?>>Himachal Pradesh</option>
                            <option value="Jammu and Kashmir" <?php if ($uState == "Jammu and Kashmir") echo "Selected"; ?>>Jammu and Kashmir</option>
                            <option value="Jharkhand" <?php if ($uState == "Jharkhand") echo "Selected"; ?>>Jharkhand</option>
                            <option value="Karnataka" <?php if ($uState == "Karnataka") echo "Selected"; ?>>Karnataka</option>
                            <option value="Kerala" <?php if ($uState == "Kerala") echo "Selected"; ?>>Kerala</option>
                            <option value="Madhya Pradesh" <?php if ($uState == "Madhya Pradesh") echo "Selected"; ?>>Madhya Pradesh</option>
                            <option value="Maharashtra" <?php if ($uState == "Maharashtra") echo "Selected"; ?>>Maharashtra</option>
                            <option value="Manipur" <?php if ($uState == "Manipur") echo "Selected"; ?>>Manipur</option>
                            <option value="Meghalaya" <?php if ($uState == "Meghalaya") echo "Selected"; ?>>Meghalaya</option>
                            <option value="Mizoram" <?php if ($uState == "Mizoram") echo "Selected"; ?>>Mizoram</option>
                            <option value="Nagaland" <?php if ($uState == "Nagaland") echo "Selected"; ?>>Nagaland</option>
                            <option value="Odisha" <?php if ($uState == "Odisha") echo "Selected"; ?>>Odisha</option>
                            <option value="Punjab" <?php if ($uState == "Punjab") echo "Selected"; ?>>Punjab</option>
                            <option value="Rajasthan" <?php if ($uState == "Rajasthan") echo "Selected"; ?>>Rajasthan</option>
                            <option value="Sikkim" <?php if ($uState == "Sikkim") echo "Selected"; ?>>Sikkim</option>
                            <option value="Tamil Nadu" <?php if ($uState == "Tamil Nadu") echo "Selected"; ?>>Tamil Nadu</option>
                            <option value="Telangana" <?php if ($uState == "Telangana") echo "Selected"; ?>>Telangana</option>
                            <option value="Tripura" <?php if ($uState == "Tripura") echo "Selected"; ?>>Tripura</option>
                            <option value="Uttar Pradesh" <?php if ($uState == "Uttar Pradesh") echo "Selected"; ?>>Uttar Pradesh</option>
                            <option value="Uttarakhand" <?php if ($uState == "Uttarakhand") echo "Selected"; ?>>Uttarakhand</option>
                            <option value="West Bengal" <?php if ($uState == "West Bengal") echo "Selected"; ?>>West Bengal</option>
                        </select>
                    </div>

                    <div class="inputbox2">
                        <label for="uzip"><b>Zip</b></label>
                        <input type="number" name="uzip" id="uzip" value="<?php echo $uZip; ?>">
                    </div>
                    <div class="inputbox2">

                        <label for="umobile"><b>Mobile</b></label>
                        <input type="number" name="umobile" id="umobile" value="<?php echo $uMobile; ?>">
                    </div>
                </div>
                <button type="submit" class="updatebtn" name="updatebtn">Update</button>

            </form>
        </div>

    </div>

    <!-- sweet alert js -->
    <?php
    if (isset($_SESSION['status_title']) && $_SESSION['status_title'] != '') {
    ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['status_icon'] ?>',
                title: '<?php echo $_SESSION['status_title'] ?>',
                text: '<?php echo $_SESSION['status_text'] ?>',
                confirmButtonColor: '#2597f4',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    location.href = location.href
                }
            });
        </script>
    <?php
        unset($_SESSION['status_title']);
    }
    ?>




</body>