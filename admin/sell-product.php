<?php
include "../connection.php";
include "include/header-sidebar.php";

if (isset($_POST['assign-btn'])) {
    $p_id = $_POST['pid'];

    $sql = "SELECT * FROM assets_tb WHERE pid = '$p_id' ";
    $run = mysqli_query($conn, $sql);
    if ($result = mysqli_fetch_array($run)) {
        $p_name = $result['pname'];
        $p_avail = $result['pavail'];
        $p_sellcost = $result['psell_cost'];
    }
}
//insert data
if (isset($_POST['donebtn'])) {
    $p_id = $_POST['pid'];
    $c_name = $_POST['cname'];
    $c_add = $_POST['cadd'];
    $p_name = $_POST['pname'];
    $p_quantity = $_POST['pquantity'];
    $p_sellcost = $_POST['psellcost'];
    $p_totalcost = $_POST['ptotalcost'];
    $p_selldate = $_POST['pselldate'];

    if ($p_id == "" || $c_name == "" || $c_add == "" || $p_name == "" ||  $p_quantity == "" || $p_sellcost == "" || $p_totalcost == "" || $p_selldate == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {
        // upadating available quantity
        $p_avail = $_POST['pavail'] - $p_quantity;
        $sql = "INSERT INTO product_sell(pid, cname, caddress, cpname, cpquantity, cpeach, cptotal, cpdate) VALUES ('$p_id','$c_name','$c_add','$p_name','$p_quantity','$p_sellcost','$p_totalcost','$p_selldate')";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            $genid = mysqli_insert_id($conn);
            $_SESSION['myid'] = $genid;
            echo '<script>location.href="product-sell-success.php";</script>';
        } else {
            echo '<script> alert("Error: Unable to Update!");</script>';
        }
    }
    $sqlup = "UPDATE assets_tb SET pavail = '$p_avail' WHERE pid = '$p_id'";
    $runup = mysqli_query($conn, $sqlup);
}
?>

<head>
    <title>Sell Product</title>
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

        #pavail,
        #pname,
        #psell {
            outline: none;
        }

        #pid {
            background: var(--blue);
            color: white;
            box-shadow: .1rem .1rem .2rem rgba(0, 0, 0, 0.5);
            outline: none;
            font-weight: bold;
            border: none;
        }

        .donebtn {
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

        .donebtn:hover,
        .closebtn:hover {
            opacity: 1;
        }

        .donebtn:hover {
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
            <h2>Customer Bill</h2>
        </div>
        <form action="" method="post">
            <label for="pid"><b>Product ID</b></label>
            <input type="text" name="pid" id="pid" value="<?php if (isset($p_id)) echo $p_id; ?>" readonly>
            <label for="cname"><b>Customer Name</b></label>
            <input type="text" name="cname" id="cname" value="" required>
            <label for="cadd"><b>Customer Address</b></label>
            <input type="text" name="cadd" id="cadd" value="" required>
            <label for="pname"><b>Product Name</b></label>
            <input type="text" name="pname" id="pname" value="<?php if (isset($p_name)) echo $p_name; ?>" readonly>

            <label for="pavail"><b>Available</b></label>
            <input type="number" name="pavail" id="pavail" value="<?php if (isset($p_avail)) echo $p_avail; ?>" readonly>
            <label for="pquantity"><b>Quantity</b></label>
            <input type="number" name="pquantity" id="pquantity" value="" required oninput="totalcost()">
            <p id="checkvalid"></p>
            <label for="psell"><b>Price(1)</b></label>
            <input type="number" name="psellcost" id="psell" value="<?php if (isset($p_sellcost)) echo $p_sellcost; ?>" readonly>
            <label for="ptotalcost"><b>Total Cost</b></label>
            <input type="number" name="ptotalcost" id="ptotalcost" value="" required step="0.01">
            <label for="pselldate"><b>Date</b></label>
            <input type="date" name="pselldate" id="pselldate" value="" required>
            <button type="submit" class="donebtn" name="donebtn">Done</button>
            <a href="assets.php" class="closebtn" name="closebtn">Close</a>

        </form>
    </div>

</div>
<script>
    function totalcost() {
        var a = document.getElementById("pavail").value;
        var q = document.getElementById("pquantity").value;
        var p = document.getElementById("psell").value;
        if (q > a) {
            alert("Maximum Quantity is" + " : " + a);
            document.getElementById("pquantity").value = a;
        } else {

            var c = q * p;
            document.getElementById("ptotalcost").value = c;
        }
    }
</script>