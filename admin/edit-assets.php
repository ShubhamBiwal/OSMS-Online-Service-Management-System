<?php
include "../connection.php";
include "include/header-sidebar.php";

if (isset($_POST['edit-btn'])) {
    $p_id = $_POST['pid'];

    $sql = "SELECT * FROM assets_tb WHERE pid = '$p_id' ";
    $run = mysqli_query($conn, $sql);
    if ($result = mysqli_fetch_array($run)) {
        $p_id = $result['pid'];
        $p_name = $result['pname'];
        $p_dop = $result['pdop'];
        $p_avail = $result['pavail'];
        $p_total = $result['ptotal'];
        $porg_cost = $result['porg_cost'];
        $psell_cost = $result['psell_cost'];
    }
}
//upadate data
if (isset($_POST['updatebtn'])) {
    $p_id = $_POST['pid'];
    $p_name = $_POST['pname'];
    $p_dop = $_POST['pdop'];
    $p_avail = $_POST['pavail'];
    $p_total = $_POST['ptotal'];
    $p_org = $_POST['porg'];
    $p_sell = $_POST['psell'];
    if ($p_id == "" || $p_name == "" || $p_dop == "" || $p_avail == "" ||  $p_total == "" || $p_org == "" || $p_sell == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {
        $sql = "UPDATE assets_tb SET pname= '$p_name', pdop = '$p_dop', pavail = '$p_avail', ptotal = '$p_total', porg_cost = '$p_org', psell_cost = '$p_sell' WHERE pid ='$p_id' ";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            echo '<script> alert("Data Updated Successfully.");</script>';
            echo '<script>location.href="assets.php";</script>';
        } else {
            echo '<script> alert("Error: Unable to Update!");</script>';
        }
    }
}
?>

<head>
    <title>Edit Product Details</title>
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
            <h2>Update Product Details</h2>
        </div>
        <form action="" method="post">
            <label for="pid"><b>Product ID</b></label>
            <input type="text" name="pid" id="pid" value="<?php if (isset($p_id)) echo $p_id; ?>" readonly>
            <label for="pname"><b>Product Name</b></label>
            <input type="text" name="pname" id="pname" value="<?php if (isset($p_name)) echo $p_name; ?>">
            <label for="pdop"><b>Date of Purchase</b></label>
            <input type="date" name="pdop" id="pdop" value="<?php if (isset($p_dop)) echo $p_dop; ?>">
            <label for="pavail"><b>Available</b></label>
            <input type="number" name="pavail" id="pavail" value="<?php if (isset($p_avail)) echo $p_avail; ?>">
            <label for="ptotal"><b>Total</b></label>
            <input type="number" name="ptotal" id="ptotal" value="<?php if (isset($p_total)) echo $p_total; ?>">
            <label for="porg"><b>Original Cost Each</b></label>
            <input type="number" name="porg" id="porg" value="<?php if (isset($porg_cost)) echo $porg_cost; ?>" step="0.01">
            <label for="psell"><b>Selling Cost Each</b></label>
            <input type="number" name="psell" id="psell" value="<?php if (isset($psell_cost)) echo $psell_cost; ?>" step="0.01">
            <button type="submit" class="updatebtn" name="updatebtn">Update</button>
            <a href="assets.php" class="closebtn" name="closebtn">Close</a>

        </form>
    </div>

</div>