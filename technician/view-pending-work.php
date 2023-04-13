<?php

include "../connection.php";
include "include/header-sidebar.php";
echo '<style>.details{display:none;}</style>';
echo '<style>.cdetails{display:none;}</style>';

$pwid = $_POST['pwid'];
//pending work details
if (isset($_POST['viewbtn']) and $pwid) {
    $sql = "SELECT * FROM requests_tb WHERE request_id =  '$pwid'";
    $run = mysqli_query($conn, $sql);

    if ($result = mysqli_fetch_array($run)) {
        echo '<style>.details{display:block;}</style>';
        $rid = $result['request_id'];
        $rappliance = $result['s_appliance'];
        $rservice = $result['s_service'];
        $rdesc = $result['request_desc'];
        $rname = $result['requester_name'];
        $radd1 = $result['requester_add1'];
        $radd2 = $result['requester_add2'];
        $rcity = $result['requester_city'];
        $rstate = $result['requester_state'];
        $remail = $result['requester_email'];
        $rmobile = $result['requester_mobile'];
        $raltmobile = $result['requester_alt_mobile'];
        $rdate = $result['request_date'];
        $radate = $result['assign_date'];
    } else {
        $msg = "";
        echo '<style>.details{display:none;}</style>';
        echo '<style>.printbtn{display:none;}</style>';
    }
}
//cancel request details
if (isset($_POST['cvbtn']) and $pwid) {
    echo '<style>.cdetails{display:block;}</style>';
    $sql = "SELECT * FROM requests_tb WHERE request_id =  '$pwid'";
    $run = mysqli_query($conn, $sql);

    if ($result = mysqli_fetch_array($run)) {

        $rid = $result['request_id'];
        $rinfo = $result['request_info'];
        $rdesc = $result['request_desc'];
        $rname = $result['requester_name'];
        $radd1 = $result['requester_add1'];
        $radd2 = $result['requester_add2'];
        $rcity = $result['requester_city'];
        $rstate = $result['requester_state'];
        $rzip = $result['requester_zip'];
        $remail = $result['requester_email'];
        $rmobile = $result['requester_mobile'];
        $raltmobile = $result['requester_alt_mobile'];
        $rdate = $result['request_date'];
        $radate = $result['assign_date'];
        $ratech = $result['assign_tech'];
        $techmobile = $result['tech_mobile'];
    } else {
        $msg = "";
        echo '<style>.details{display:none;}</style>';
        echo '<style>.printbtn{display:none;}</style>';
    }
}

//work submit
if (isset($_POST['submitbtn'])) {
    $rid = $_POST['r_id'];
    $rcode = trim($_POST['r_code']);
    $wdate = $_POST['wdate'];
    $sql = "SELECT * FROM requests_tb WHERE request_id = '$rid'";
    $run = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($run);
    $rdate = $result['request_date'];
    $r_code = $result['request_code'];
    if ($wdate < $rdate) {
        echo '<script>alert("Enter Valid Work Date!");</script>';
        echo '<script>location.href = "pending-work.php";</script>';
    } else {
        if ($rcode == $r_code) {
            $sql = "UPDATE requests_tb SET work_date = '$wdate', r_status = '3' WHERE request_id = $rid";
            $run = mysqli_query($conn, $sql);
            if ($run) {
                echo '<script> alert("Success: Work Completed.");</script>';
                echo "<script> location.href = 'completed-work.php';</script>";
            }
        } else {
            echo '<script>alert("Incorrect Request Code.");</script>';
            echo '<script>location.href = "pending-work.php";</script>';
        }
    }
}
?>


<head>
    <title>View Pending Work</title>
    <style>
        .details {
            width: 70%;
        }

        .details .heading {
            padding: 1rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            width: 100%;
            background: var(--blue);
            color: #fff;
        }

        .cdetails {
            width: 70%;
        }

        .cdetails .heading {
            padding: 1rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.5rem;
            width: 100%;
            background: var(--blue);
            color: #fff;
        }

        #msg {
            padding: 1rem;
            background: #e2effa;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
            font-size: 1.6rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        tr,
        td {
            border: .1rem solid rgba(0, 0, 0, 0.2);
            padding: 1rem;
        }

        .r_codebox,
        .w_datebox {
            outline: .1rem solid rgba(0, 0, 0, 0.3);
            width: 100%;
            padding: .8rem;
            font-size: 1.6rem;
            font-weight: 500;
        }

        .r_codebox:focus,
        .w_datebox:hover {
            outline: .2rem solid rgb(37, 151, 244, 0.5);
        }

        .submitbtn {
            background-color: var(--blue);
            padding: 1rem 1.5rem;
            cursor: pointer;
            border: none;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .2rem;
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .printbtn {
            position: fixed;
            bottom: 3rem;
            right: 4rem;
            z-index: 99;
            font-size: 3rem;
            background-color: var(--blue);
            color: white;
            cursor: pointer;
            padding: 1rem;
            border-radius: .5rem;
            opacity: 0.8;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);
        }

        .closebtn {
            background-color: #000;
            padding: 1rem;
            cursor: pointer;
            border: none;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .2rem;
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .printbtn:hover,
        .closebtn:hover,
        .submitbtn:hover {
            opacity: 1;
        }

        .btns {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            column-gap: 2rem;
            margin: 2rem 0;

        }

        @media(max-width:950px) {
            .details {
                width: 100%;
            }

            #msg {
                width: 100%;
            }
        }

        @media(max-width:750px) {
            .details .heading {
                width: 100%;
            }

            #msg {
                width: 100%;
            }

            .check-id {
                flex-direction: column;
            }

            .content {
                padding: 2rem;
            }

            .details {
                width: 100%;
            }

            table {
                width: 100%;
                font-size: 1.3rem;
            }

            .check-id input[type="number"] {
                width: 80%;
                padding: 1rem;
            }

        }

        @media print {
            .details {
                margin-top: -7rem;
            }

            .head-sidebar,
            .btns,
            .r_codebox,
            .w_datebox,
            .printbtn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <form action="" method="post">
            <div class="details">
                <div class="heading">
                    <h3>Work Details</h3>
                </div>
                <table>
                    <tr>
                        <td><b>Request ID<b></td>
                        <td>
                            <b>
                                <?php if (isset($rid)) echo $rid; ?>
                                <input type="hidden" name="r_id" value="<?php if (isset($rid)) echo $rid; ?>">
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>Service Info</td>
                        <td class="sinfo"><?php if(isset($rappliance)&& $rservice)  echo ucwords($rappliance) . " (" . $rservice . ")"; ?></td>
                    </tr>
                    <tr>
                        <td>Request Description</td>
                        <td>
                            <?php if (isset($rdesc)) echo $rdesc; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>
                            <?php if (isset($rname)) echo ucwords($rname); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Line 1</td>
                        <td>
                            <?php if (isset($radd1)) echo $radd1; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Address Line 2</td>
                        <td>
                            <?php if (isset($radd2)) echo $radd2; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>
                            <?php if (isset($rcity)) echo $rcity; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td>
                            <?php if (isset($rstate)) echo $rstate; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>
                            <?php if (isset($remail)) echo $remail; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Mobile No.</td>
                        <td>
                            <?php if (isset($rmobile)) echo $rmobile; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Alternate Mobile No.</td>
                        <td>
                            <?php if (isset($raltmobile)) echo $raltmobile; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Request Date</b></td>
                        <td>
                            <b> <?php if (isset($rdate)) echo $rdate; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Assigned Date<b></td>
                        <td>
                            <b>
                                <?php if (isset($radate)) echo $radate; ?>
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Work Date<b></td>
                        <td>
                            <input type="date" name="wdate" class="w_datebox" required>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Request Code<b></td>
                        <td>
                            <input type="text" name="r_code" class="r_codebox" placeholder="Enter Request Code" required>
                        </td>
                    </tr>

                </table>
                <div class="btns">
                    <button type="submit" class="submitbtn" name="submitbtn">Submit</button>
                    <button type="submit" class="closebtn" name="closebtn" onclick="location.href ='pending-work.php';">Close</button>
                </div>
            </div>
        </form>


        <!-- cancel request details -->
        <div class="cdetails">
            <div class="heading">
                <h3>Cancelled Request Details</h3>
            </div>
            <table>
                <tr>
                    <td><b>Request ID<b></td>
                    <td>
                        <b>
                            <?php if (isset($rid)) echo $rid; ?>
                            <input type="hidden" name="r_id" value="<?php if (isset($rid)) echo $rid; ?>">
                        </b>
                    </td>
                </tr>
                <tr>
                    <td>Request Info</td>
                    <td>
                        <?php if (isset($rinfo)) echo $rinfo; ?>
                    </td>
                </tr>
                <tr>
                    <td>Request Description</td>
                    <td>
                        <?php if (isset($rdesc)) echo $rdesc; ?>
                    </td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>
                        <?php if (isset($rname)) echo $rname; ?>
                    </td>
                </tr>
                <tr>
                    <td>Address Line 1</td>
                    <td>
                        <?php if (isset($radd1)) echo $radd1; ?>
                    </td>
                </tr>
                <tr>
                    <td>Address Line 2</td>
                    <td>
                        <?php if (isset($radd2)) echo $radd2; ?>
                    </td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>
                        <?php if (isset($rcity)) echo $rcity; ?>
                    </td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>
                        <?php if (isset($rstate)) echo $rstate; ?>
                    </td>
                </tr>
                <tr>
                    <td>Pin Code</td>
                    <td>
                        <?php if (isset($rzip)) echo $rzip; ?>
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <?php if (isset($remail)) echo $remail; ?>
                    </td>
                </tr>
                <tr>
                    <td>Mobile No.</td>
                    <td>
                        <?php if (isset($rmobile)) echo $rmobile; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Request Date</b></td>
                    <td>
                        <b> <?php if (isset($rdate)) echo $rdate; ?></b>
                    </td>
                </tr>
                <tr>
                    <td><b>Assigned Date<b></td>
                    <td>
                        <b>
                            <?php if (isset($radate)) echo $radate; ?>
                        </b>
                    </td>
                </tr>

            </table>
            <div class="btns">
                <button type="submit" class="closebtn" name="closebtn" onclick="location.href ='pending-work.php';">Close</button>
            </div>
        </div>

        <button type="submit" class="printbtn" name="printbtn" onclick="window.print()"><i class="fa-solid fa-print"></i></button>
        <?php if (isset($msg)) echo '<div id="msg">Error: Unable to Show Data.</div>'; ?>
    </div>


</body>

</html>