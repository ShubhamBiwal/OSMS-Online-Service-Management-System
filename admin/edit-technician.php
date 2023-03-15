<?php
include "../connection.php";
include "include/header-sidebar.php";

if (isset($_POST['edit-btn'])) {
    $t_id = $_POST['tid'];

    $sql = "SELECT * FROM technician_tb WHERE tech_id = '$t_id' ";
    $run = mysqli_query($conn, $sql);
    if ($result = mysqli_fetch_array($run)) {
        $t_id = $result['tech_id'];
        $t_name = $result['tech_name'];
        $t_city = $result['tech_city'];
        $t_mobile = $result['tech_mobile'];
        $t_email = $result['tech_email'];
    }
}
//upadate data
if (isset($_POST['updatebtn'])) {
    $t_id = $_POST['tid'];
    $t_name = $_POST['tname'];
    $t_city = $_POST['tcity'];
    $t_mobile = $_POST['tmobile'];
    $t_email = $_POST['temail'];
    if ($t_id == "" || $t_name == "" || $t_city=="" || $t_mobile == "" ||  $t_email == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {
        $sql = "UPDATE technician_tb SET tech_name= '$t_name', tech_city = '$t_city', tech_mobile = '$t_mobile', tech_email = '$t_email' WHERE tech_id ='$t_id' ";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            echo '<script> alert("Data Updated Successfully.");</script>';
            echo '<script>location.href="technician.php";</script>';
        } else {
            echo '<script> alert("Error: Unable to Update!");</script>';
        }
    }
}
?>

<head>
    <title>Edit Technician</title>
    <style>
        .container {
            padding: 1.6rem;
            box-shadow: 0.4rem 0.4rem 1rem rgba(0, 0, 0, 0.4);
            width: 70%;
        }

        .container .heading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
            font-size: 1.5rem;
        }

        label {
            font-size: 1.5rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f4f4f4;
            border: none;
        }

        input[type="text"]:focus {
            outline: none;
        }

        #tid {
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
            border-radius: .2rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);
        }

        .closebtn {
            background-color: #000;
            padding: 1rem;
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
        .closebtn:hover {
            opacity: 1;
        }

        .updatebtn:hover {
            opacity: 1;
        }

        @media(max-width:750px) {
            .container {
                width: 100%;
            }
        }
    </style>
</head>
<div class="content">
    <div class="container">
        <div class="heading">
            <h2>Update Technician Details</h2>
        </div>
        <form action="" method="post">
            <label for="tid"><b>Technician ID</b></label>
            <input type="text" name="tid" id="tid" value="<?php if (isset($t_id)) echo $t_id; ?>" readonly>
            <label for="tname"><b>Name</b></label>
            <input type="text" name="tname" id="tname" value="<?php if (isset($t_name)) echo $t_name; ?>">
            <label for="tcity"><b>City</b></label>
            <input type="text" name="tcity" id="tcity" value="<?php if (isset($t_city)) echo $t_city; ?>">
            <label for="tmobile"><b>Mobile</b></label>
            <input type="text" name="tmobile" id="tmobile" value="<?php if (isset($t_mobile)) echo $t_mobile; ?>">
            <label for="temail"><b>Email</b></label>
            <input type="text" name="temail" id="temail" value="<?php if (isset($t_email)) echo $t_email; ?>">
            <button type="submit" class="updatebtn" name="updatebtn">Update</button>
            <a href="technician.php" class="closebtn" name="closebtn">Close</a>

        </form>
    </div>

</div>