<?php
$page = "requests";
include "../connection.php";
include "include/header-sidebar.php";
//for request card
$sql = "SELECT request_id, request_info, request_desc, request_date FROM submit_request";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);
if ($rows == 0) {
    $msg = "No Request Found";
}


//show data in assign form
if (isset($_POST['view-btn'])) {
    $r_id = $_POST['r_id'];
    $sql1 = "SELECT * FROM submit_request WHERE request_id = '$r_id'";
    $run1 = mysqli_query($conn, $sql1);
    $result1 = mysqli_fetch_array($run1);
}
// close btn
if (isset($_POST['close-btn'])) {
    $sql2 = "DELETE FROM submit_request WHERE request_id = '{$_POST['r_id']}' ";
    $run2 = mysqli_query($conn, $sql2);
    if ($run2) {
        echo "<script> location.href='requests.php';</script>";
    } else {
        echo '<script>alert("Unable to Delete.");</script>';
    }
}
//select technician names
$sqlt =  "SELECT tech_name FROM technician_tb";
$runt = mysqli_query($conn, $sqlt);

//assign technician
if (isset($_POST['assign-btn'])) {
    if ($_POST['rid'] == "" || $_POST['rinfo'] == "" || $_POST['rdesc'] == "" || $_POST['rname'] == "" || $_POST['raddress1'] == "" || $_POST['raddress2'] == "" || $_POST['rcity'] == "" || $_POST['rstate'] == "" || $_POST['rzip'] == "" || $_POST['remail'] == "" || $_POST['rmobile'] == "" || $_POST['rtechnician'] == "" || $_POST['rdate'] == "") {
        echo '<script> alert("Error: All Fields are Required.");</script>';
    } else {
        $rid = $_POST['rid'];
        $rinfo = $_POST['rinfo'];
        $rdesc = $_POST['rdesc'];
        $rname = $_POST['rname'];
        $raddress1 = $_POST['raddress1'];
        $raddress2 = $_POST['raddress2'];
        $rcity = $_POST['rcity'];
        $rstate = $_POST['rstate'];
        $rzip = $_POST['rzip'];
        $remail = $_POST['remail'];
        $rmobile = $_POST['rmobile'];
        $rtechnician = $_POST['rtechnician'];
        $rdate = $_POST['rdate'];

        $sql3 = "INSERT INTO assign_work(request_id, request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_zip, requester_email, requester_mobile, assign_tech, assign_date) VALUES ('$rid','$rinfo','$rdesc','$rname','$raddress1','$raddress2','$rcity','$rstate','$rzip','$remail','$rmobile','$rtechnician','$rdate')";
        $run3 = mysqli_query($conn, $sql3);

        if ($run3) {
            $sqldel = "DELETE FROM submit_request WHERE request_id = '$rid' ";
            $rundel  = mysqli_query($conn, $sqldel);
            echo '<script> alert("Work Assigned Successfully.");</script>';
            echo "<script> location.href = 'requests.php';</script>";
        } else {
            echo '<script> alert("Error: Unable to Assign!!");</script>';
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

        .card-body h2,
        p {
            font-size: 1.5rem;
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
            background: var(--blue);
            color: white;
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

        .address,
        .address2,
        .address3 {
            display: flex;
            flex-direction: row;
            gap: 2rem;
            align-items: center;
            justify-content: center;
        }

        .inputbox {
            width: 50%;
        }

        .inputbox2 {
            width: 33%;
        }

        input::-webkit-inner-spin-button {
            display: none;
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
                        <p>Request ID:
                            <?php echo $result['request_id']; ?>
                        </p>
                    </div>
                    <div class="card-body">
                        <h2>Request Info :
                            <?php echo $result['request_info']; ?>
                        </h2>
                        <p class="request-desc">
                            <?php echo $result['request_desc']; ?>
                        </p>
                        <p>Request Date:
                            <?php echo $result['request_date']; ?>
                        </p>
                        <form action="" method="post">
                            <input type="hidden" name="r_id" value="<?php echo $result['request_id']; ?>">
                            <input type="submit" name="close-btn" class="close-btn" value="Close">
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
                    <input type="text" name="rid" id="rid" value="<?php if (isset($result1['request_id'])) echo $result1['request_id']; ?>" readonly>
                    <label for="rinfo"><b>Request Info</b></label>
                    <input type="text" name="rinfo" id="rinfo" value="<?php if (isset($result1['request_info'])) echo $result1['request_info']; ?>">
                    <label for="rdesc"><b>Discription</b></label>
                    <input type="text" name="rdesc" id="rdesc" value="<?php if (isset($result1['request_desc'])) echo $result1['request_desc']; ?>">
                    <label for="rname"><b>Name</b></label>
                    <input type="text" name="rname" id="rname" value="<?php if (isset($result1['requester_name'])) echo $result1['requester_name']; ?>">

                    <div class="address">
                        <div class="inputbox">
                            <label for="raddress1"><b>Address Line 1</b></label>
                            <input type="text" name="raddress1" id="raddress1" value="<?php if (isset($result1['requester_add1'])) echo $result1['requester_add1']; ?>">
                        </div>
                        <div class="inputbox">
                            <label for="raddress2"><b>Address Line 2</b></label>
                            <input type="text" name="raddress2" id="raddress2" value="<?php if (isset($result1['requester_add2'])) echo $result1['requester_add2']; ?>">
                        </div>
                    </div>

                    <div class="address2">
                        <div class="inputbox2">
                            <label for="rcity"><b>City</b></label>
                            <input type="text" name="rcity" id="rcity" value="<?php if (isset($result1['requester_city'])) echo $result1['requester_city']; ?>">
                        </div>
                        <div class="inputbox2">
                            <label for="rstate"><b>State</b></label>
                            <input type="text" name="rstate" id="rstate" value="<?php if (isset($result1['requester_state'])) echo $result1['requester_state']; ?>">
                        </div>

                        <div class="inputbox2">
                            <label for="rzip"><b>Zip</b></label>
                            <input type="number" name="rzip" id="rzip" value="<?php if (isset($result1['requester_zip'])) echo $result1['requester_zip']; ?>">
                        </div>
                    </div>
                    <div class="address3">
                        <div class="inputbox">
                            <label for="remail"><b>Email</b></label>
                            <input type="text" name="remail" id="remail" value="<?php if (isset($result1['requester_email'])) echo $result1['requester_email']; ?>">
                        </div>
                        <div class="inputbox">

                            <label for="rmobile"><b>Mobile</b></label>
                            <input type="number" name="rmobile" id="rmobile" value="<?php if (isset($result1['requester_mobile'])) echo $result1['requester_mobile']; ?>">
                        </div>
                    </div>
                    <div class="address3">
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
                            <label for="rdate"><b>Date</b></label>
                            <input type="date" name="rdate" id="rdate" required>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="submitbtn" name="assign-btn">Assign</button>
                        <button type="reset" class="resetbtn" name="resetbtn">Reset</button>
                    </div>

                </form>

            </div>

        </div>
    </div>


</div>