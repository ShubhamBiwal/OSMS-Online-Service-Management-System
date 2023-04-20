<?php
$page = "requests";
include "../connection.php";
include "include/header-sidebar.php";
// //for request card
$sql = "SELECT request_id, s_appliance, s_service, request_desc, requester_mobile, request_date FROM requests_tb WHERE r_status = '1'";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);
if ($rows == 0) {
    $msg = "No Request Found";
}


//show data in assign form
if (isset($_POST['view-btn'])) {
    $r_id = $_POST['r_id'];
    $sql1 = "SELECT * FROM requests_tb WHERE request_id = '$r_id'";
    $run1 = mysqli_query($conn, $sql1);
    $result1 = mysqli_fetch_array($run1);
}
// close btn
if (isset($_POST['close-btn'])) {
    $sql2 = "DELETE FROM requests_tb WHERE request_id = '{$_POST['r_id']}' ";
    $run2 = mysqli_query($conn, $sql2);
    if ($run2) {
        echo "<script> location.href='requests.php';</script>";
    } else {
        echo '<script>alert("Unable to Delete.");</script>';
    }
}
// //select technician names
$sqlt =  "SELECT * FROM technician_tb";
$runt = mysqli_query($conn, $sqlt);

//assign technician
if (isset($_POST['assign-btn'])) {
    if ($_POST['rid'] == "" || $_POST['rname'] == "" || $_POST['remail'] == "" || $_POST['r_appliance'] == "" || $_POST['r_service'] == "" || $_POST['rdesc'] == "" || $_POST['rstate'] == "" || $_POST['rcity'] == "" || $_POST['raddress1'] == "" || $_POST['raddress2'] == "" || $_POST['rmobile'] == "" || $_POST['rtechnician'] == "" || $_POST['radate'] == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {
        $rid = $_POST['rid'];
        $rtechnician = $_POST['rtechnician'];
        $rdate = $_POST['rdate'];
        $radate = $_POST['radate'];
        if ($radate < $rdate) {
            echo '<script> alert("Enter a Valid Date");</script>';
        } else {

            $sql1 = "SELECT * FROM technician_tb WHERE tech_name = '$rtechnician'";
            $run1 = mysqli_query($conn, $sql1);
            $result1 = mysqli_fetch_array($run1);
            $techid = $result1['tech_id'];
            $techmobile = $result1['tech_mobile'];
            $techemail = $result1['tech_email'];
            $sql2 = "UPDATE requests_tb SET tech_id = '$techid', assign_tech = '$rtechnician', tech_mobile = '$techmobile', tech_email = '$techemail',assign_date = '$radate', r_status = '2', admin_status = '1' WHERE request_id = '$rid'";
            $run2 = mysqli_query($conn, $sql2);

            if ($run2) {
                $_SESSION['status_title'] = "Success";
                $_SESSION['status_text'] = "Work Assigned.";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status_title'] = "Error";
                $_SESSION['status_text'] = "Something Went Wrong!";
                $_SESSION['status_icon'] = "error";
            }
        }
    }
}

?>

<head>
    <title>Requests</title>
    <style>
        #msg {
            text-align: center;
            font-size: 1.7rem;
            padding: 1rem 0;
            font-weight: bold;
            color: var(--black);
        }

        .left::-webkit-scrollbar {
            width: .5rem;
        }

        .left::-webkit-scrollbar-track {
            background: lightgray;
        }

        .left::-webkit-scrollbar-thumb {
            background: var(--black);
            border-radius: .5rem;
        }

        .assign-work::-webkit-scrollbar {
            width: .7rem;
        }

        .assign-work::-webkit-scrollbar-track {
            background: lightgray;
        }

        .assign-work::-webkit-scrollbar-thumb {
            background: var(--black);
            border-radius: .5rem;
        }

        .outer-box {
            display: flex;
            column-gap: 3rem;
        }

        .left {
            display: flex;
            flex-direction: column;
            width: 40%;
            height: calc(100vh - 15rem);
            overflow-y: scroll;
            padding: 1rem;
            border-top: 1rem solid var(--blue);
            box-shadow: -0.2rem 0.2rem 1rem rgba(0, 0, 0, 0.3);

        }

        .request-card {
            display: flex;
            flex-direction: column;
            width: 100%;
            border: .1rem solid rgb(51, 51, 68, 0.2);
            margin-bottom: 3rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.2);

        }

        .request-card .card-head {
            background: var(--black);
            color: #fff;
            font-size: 1.5rem;
            font-weight: 550;
            padding: 1rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.3);

        }

        .request-card .card-body {
            padding: 1rem;
            line-height: 2;
        }

        .card-body p {
            font-size: 1.6rem;
        }

        .card-body span {
            color: var(--blue);
            font-weight: 500;
        }

        .view-btn,
        .close-btn {
            margin: 1rem;
            padding: 1rem;
            float: right;
            cursor: pointer;
            border-radius: .2rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.2);
            font-weight: 550;
            opacity: .85;
        }

        .view-btn {
            background: var(--blue);
            color: white;
        }

        .close-btn {
            background: #333;
            color: white;
        }

        .view-btn:hover,
        .close-btn:hover {
            opacity: 1;
        }

        .assign-work {
            border-top: 1rem solid var(--blue);
            width: 60%;
            height: calc(100vh - 15rem);
            overflow-y: scroll;
            box-shadow: -0.2rem 0.2rem 1rem rgba(0, 0, 0, 0.3);


        }

        .container {
            padding: 1.6rem;
            width: 100%;
            background: rgb(224, 242, 250);
        }

        .container .form-heading {
            text-align: center;
            padding: 1.5rem 0;
        }

        #rid {
            box-shadow: .1rem .1rem .2rem rgba(0, 0, 0, 0.5);
            outline: none;
            font-weight: bold;
            border: none;
        }

        label {
            font-size: 1.5rem;
            color: var(--black);
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.07);
        }

        #atech {
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.07);
            cursor: pointer;
            text-transform: capitalize;
        }


        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus {
            outline: .1rem solid rgba(0, 0, 0, 0.3);

        }

        .form-container {
            display: flex;
            flex-direction: row;
            gap: 2rem;
            align-items: center;
            justify-content: center;
        }

        .inputbox {
            width: 50%;
        }

        input::-webkit-inner-spin-button {
            display: none;
        }

        .price-show {
            color: red;
            padding: 1rem;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .price-show span {
            color: var(--black);
        }

        .buttons {
            display: flex;
            justify-content: flex-end;
        }

        .submitbtn {
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

        .submitbtn:hover,
        .resetbtn:hover {
            opacity: 1;
        }

        @media (max-width: 950px) {
            .outer-box {
                flex-direction: column;
                row-gap: 3rem;
                height: calc(100vh - 15rem);
            }

            .left {
                width: 100%;
                height: 40%;

            }

            .assign-work {
                width: 100%;
                height: 60%;
            }

        }



        @media (max-width: 750px) {

            .form-container {
                flex-direction: column;
            }

            .inputbox {
                width: 100%;
            }

            .content {
                padding: 1.5rem;
            }

        }
    </style>
</head>
<div class="content">

    <div class="outer-box">
        <div class="left">

            <?php while ($result = mysqli_fetch_array($run)) {
            ?>
                <div class="request-card">
                    <div class="card-head">
                        <p>Request ID :
                            <?php echo $result['request_id']; ?>
                        </p>
                    </div>
                    <div class="card-body">
                        <p><b>Service Info :</b>
                            <span> <?php echo ucwords($result['s_appliance']) . " (" . ucwords($result['s_service']) . ")"; ?></span>
                        </p>
                        <p><b>Request Desc :</b>
                            <?php echo ucwords($result['request_desc']); ?>
                        </p>
                        <p><b>Mobile No. :</b>
                            <?php echo $result['requester_mobile']; ?>
                        </p>
                        <p><b>Request Date :</b>
                            <?php echo date("j-n-Y", strtotime($result['request_date'])); ?>
                        </p>
                        <form action="" method="post">
                            <input type="hidden" name="r_id" value="<?php echo $result['request_id']; ?>">
                            <input type="submit" name="close-btn" class="close-btn" value="Close" onclick="return DelConfirm()">
                            <input type="submit" name="view-btn" class="view-btn" value="View">
                        </form>

                    </div>
                </div>
            <?php } ?>
            <div id="msg"><?php if (isset($msg)) echo $msg; ?></div>

        </div>

        <div class="assign-work">
            <div class="container">

                <h1 class="form-heading">Assign Work Order Request</h1>
                <form action="" method="post">
                    <label for="rid"><b>Request ID</b></label>
                    <input type="text" name="rid" id="rid" value="<?php if (isset($result1['request_id'])) echo $result1['request_id']; ?>" readonly required>
                    <div class="form-container">
                        <div class="inputbox">
                            <label for="rname"><b>Name</b></label>
                            <input type="text" name="rname" id="rname" value="<?php if (isset($result1['requester_name'])) echo ucwords($result1['requester_name']); ?>" readonly required>
                        </div>
                        <div class="inputbox">
                            <label for="remail"><b>Email</b></label>
                            <input type="text" name="remail" id="remail" value="<?php if (isset($result1['requester_email'])) echo $result1['requester_email']; ?>" readonly required>
                        </div>
                    </div>
                    <div class="form-container">
                        <div class="inputbox">
                            <label for=""><b>Appliance</b></label>
                            <input type="text" name="r_appliance" id="" value="<?php if (isset($result1['s_appliance'])) echo ucwords($result1['s_appliance']); ?>" readonly required>
                        </div>
                        <div class="inputbox">
                            <label for=""><b>Service</b></label>
                            <input type="text" name="r_service" id="" value="<?php if (isset($result1['s_service'])) echo ucwords($result1['s_service']); ?>" readonly required>
                        </div>
                    </div>
                    <label for="rdesc"><b>Discription</b></label>
                    <input type="text" name="rdesc" id="rdesc" value="<?php if (isset($result1['request_desc'])) echo $result1['request_desc']; ?>" readonly required>
                    <div class="form-container">
                        <div class="inputbox">
                            <label for="rstate"><b>State</b></label>
                            <input type="text" name="rstate" id="rstate" value="<?php if (isset($result1['requester_state'])) echo $result1['requester_state']; ?>" readonly required>
                        </div>
                        <div class="inputbox">
                            <label for="rcity"><b>City</b></label>
                            <input type="text" name="rcity" id="rcity" value="<?php if (isset($result1['requester_city'])) echo $result1['requester_city']; ?>" readonly required>
                        </div>
                    </div>
                    <div class="form-container">
                        <div class="inputbox">
                            <label for="raddress1"><b>Address Line 1</b></label>
                            <input type="text" name="raddress1" id="raddress1" value="<?php if (isset($result1['requester_add1'])) echo $result1['requester_add1']; ?>" readonly required>
                        </div>
                        <div class="inputbox">
                            <label for="raddress2"><b>Address Line 2</b></label>
                            <input type="text" name="raddress2" id="raddress2" value="<?php if (isset($result1['requester_add2'])) echo $result1['requester_add2']; ?>" readonly required>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="inputbox">
                            <label for="rmobile"><b>Mobile No.</b></label>
                            <input type="number" name="rmobile" id="rmobile" value="<?php if (isset($result1['requester_mobile'])) echo $result1['requester_mobile']; ?>" readonly required>
                        </div>
                        <div class="inputbox">
                            <label for=""><b>Alternate Contact</b></label>
                            <input type="number" name="r_alt_mobile" id="" value="<?php if (isset($result1['requester_alt_mobile'])) echo $result1['requester_alt_mobile']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-container">
                        <div class="inputbox">
                            <label for="rtechnician"><b>Assign Technician</b></label>
                            <select id="atech" name="rtechnician" required>
                                <option value="">None</option>
                                <?php while ($resultt = mysqli_fetch_array($runt)) { ?>
                                    <option value="<?php echo $resultt['tech_name']; ?>"><?php echo $resultt['tech_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="inputbox">
                            <label for=""><b>Assign Date</b></label>
                            <input type="date" name="radate" id="" required>
                            <input type="hidden" name="rdate" id="" value="<?php if (isset($result1['request_date'])) echo $result1['request_date']; ?>">
                        </div>
                    </div>
                    <span class="price-show"> <span>Cost (in Rs) :</span><?php if (isset($result1['s_price'])) echo " " . '&#8377;' . $result1['s_price'] . ""; ?></span>
                    <div class="buttons">
                        <button type="submit" class="submitbtn" name="assign-btn">Assign</button>
                        <button type="reset" class="resetbtn" name="resetbtn">Reset</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
    function DelConfirm() {
        return confirm("Are you sure you want to delete this Request?");
    }
</script>
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