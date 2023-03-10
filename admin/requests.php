<?php
include "../connection.php";
include "include/header-sidebar.php";

$sql = "SELECT request_id, request_info, request_desc, request_date FROM submit_request";
$run = mysqli_query($conn, $sql);

?>

<head>
    <title>Requests</title>
    <style>
        .outer-box {
            display: flex;
            gap: 3rem;
        }

        .left {
            display: flex;
            flex-direction: column;
            width: 40%;
        }

        .request-card {
            display: flex;
            flex-direction: column;
            width: 100%;
            border: .1rem solid rgba(0, 0, 0, 0.2);
            box-shadow: .2rem .4rem 1rem rgba(0, 0, 0, 0.2);
            margin-bottom: 3rem;
        }

        .request-card .card-head {
            background: #eee;
            color: #222;
            font-size: 1.5rem;
            font-weight: 550;
            padding: 1rem;

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
            width: 60%;
        }

        .container {
            padding: 1.6rem;
            box-shadow: -0.2rem 0.2rem 1rem rgba(0, 0, 0, 0.3);
            width: 100%;
            background: rgb(224, 242, 250);
        }

        .container .form-heading {
            text-align: center;
            padding: 1.5rem 0;
        }

        #rid {
            background: lightgray;
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
            background: #fff;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus
         {
              outline: .2rem solid rgba(0, 0, 0, 0.2);

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
                    <input type="submit" name="" class="close-btn" value="Close">
                    <input type="submit" name="" class="view-btn" value="View">

                </div>
            </div>
            <?php } ?>
        </div>

        <div class="assign-work">
            <div class="container">
                <h1 class="form-heading">Assign Work Order Request</h1>
                <form action="" method="post">
                    <label for="rid"><b>Request ID</b></label>
                    <input type="text" name="rid" id="rid" readonly>
                    <label for="rinfo"><b>Request Info</b></label>
                    <input type="text" name="rinfo" id="rinfo">
                    <label for="rdesc"><b>Discription</b></label>
                    <input type="text" name="rdesc" id="rdesc">
                    <label for="rname"><b>Name</b></label>
                    <input type="text" name="rname" id="rname" value="">

                    <div class="address">
                        <div class="inputbox">
                            <label for="raddress1"><b>Address Line 1</b></label>
                            <input type="text" name="raddress1" id="raddress1">
                        </div>
                        <div class="inputbox">
                            <label for="raddress2"><b>Address Line 2</b></label>
                            <input type="text" name="raddress2" id="raddress2">
                        </div>
                    </div>

                    <div class="address2">
                        <div class="inputbox2">
                            <label for="rcity"><b>City</b></label>
                            <input type="text" name="rcity" id="rcity">
                        </div>
                        <div class="inputbox2">
                            <label for="rstate"><b>State</b></label>
                            <input type="text" name="rstate" id="rstate">
                        </div>

                        <div class="inputbox2">
                            <label for="rzip"><b>Zip</b></label>
                            <input type="number" name="rzip" id="rzip">
                        </div>
                    </div>
                    <div class="address3">
                        <div class="inputbox">
                            <label for="remail"><b>Email</b></label>
                            <input type="text" name="remail" id="remail">
                        </div>
                        <div class="inputbox">

                            <label for="rmobile"><b>Mobile</b></label>
                            <input type="number" name="rmobile" id="rmobile">
                        </div>
                    </div>
                    <div class="address3">
                        <div class="inputbox">
                            <label for="assign-technician"><b>Assign Technician</b></label>
                            <input type="text" name="rtechnician" id="rtechnician">
                        </div>
                        <div class="inputbox">
                            <label for="rdate"><b>Date</b></label>
                            <input type="date" name="rdate" id="rdate">
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="submitbtn" name="submitbtn">Assign</button>
                        <button type="reset" class="resetbtn" name="resetbtn">Reset</button>
                    </div>

                </form>
            </div>

        </div>
    </div>


</div>