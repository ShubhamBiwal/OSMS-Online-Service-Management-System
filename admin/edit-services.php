<?php
include "../connection.php";
include "include/header-sidebar.php";

if (isset($_POST['edit-btn'])) {
    $s_id = $_POST['sid'];
    $sql = "SELECT * FROM services_tb WHERE s_id = '$s_id' ";
    $run = mysqli_query($conn, $sql);
    if ($result = mysqli_fetch_array($run)) {
        $s_id = $result['s_id'];
        $a_name = $result['appliance_name'];
        $s_name = $result['service_name'];
        $s_price = $result['service_price'];
    }
}
//upadate data
if (isset($_POST['updatebtn'])) {
    $s_id = $_POST['sid'];
    $a_name = strtolower($_POST['aname']);
    $s_name = strtolower($_POST['sname']);
    $s_price = $_POST['sprice'];

    if ($s_id == "" || $a_name == "" || $s_name == "" || $s_price == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {
        $sqlc = "SELECT * FROM services_tb where appliance_name='$a_name' and `service_name` ='$s_name' ";
        $runc = mysqli_query($conn, $sqlc);

        if (mysqli_num_rows($runc) > 0) {
            echo '<script>alert("Error: Service is Already exist!");</script>';
        } else{
        $sql = "UPDATE services_tb SET appliance_name= '$a_name', `service_name` = '$s_name', service_price = '$s_price' WHERE s_id ='$s_id' ";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            echo '<script> alert("Data Updated Successfully.");</script>';
            echo '<script>location.href="services.php";</script>';
        } else {
            echo '<script> alert("Error: Unable to Update!");</script>';
        }
    }
}
}
?>

<head>
    <title>Edit Service Details</title>
    <style>
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

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

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            text-transform: capitalize;
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.05);
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus {
            outline: .1rem solid rgba(0, 0, 0, 0.4);

        }

        #pid {
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

        .selectbox {
            text-transform: capitalize;
            font-size: 1.5rem;
            width: 100%;
            margin: 1.5rem 0;
            padding: 1rem;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        @media(max-width:750px) {
            .container {
                width: 100%;
            }

            .content {
                padding: 1.5rem;
            }

        }
    </style>
</head>
<div class="content">
    <div class="container">
        <div class="heading">
            <h2>Update Service Details</h2>
        </div>
        <form action="" method="post">
            <label for="pid"><b>Service ID</b></label>
            <input type="text" name="sid" id="pid" value="<?php if (isset($s_id)) echo $s_id; ?>" readonly>
            <label for="aname"><b>Appliance Name</b></label>
            <input type="text" name="aname" id="pname" value="<?php if (isset($a_name)) echo $a_name; ?>">
            <label for="sname"><b>Service</b></label>
            <select name="sname" id="ss" class="selectbox" required>
                <option value="installation" <?php if ($s_name == 'installation') echo "selected"; ?>>Installation</option>
                <option value="maintenance" <?php if ($s_name == 'maintenance') echo "selected"; ?>>Maintenance</option>
                <option value="fault Repair" <?php if ($s_name == 'fault repair') echo "selected"; ?>>Fault Repair</option>
            </select>
            <label for="ptotal"><b>Price (in Rs)</b></label>
            <input type="number" name="sprice" id="ptotal" value="<?php if (isset($s_price)) echo $s_price; ?>">
            <button type="submit" class="updatebtn" name="updatebtn">Update</button>
            <a href="services.php" class="closebtn" name="closebtn">Close</a>

        </form>
    </div>

</div>