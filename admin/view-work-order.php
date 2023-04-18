<?php
include "../connection.php";
include "include/header-sidebar.php";

if (isset($_POST['view-btn'])) {
    $r_id = $_POST['rid'];
    $sql = "SELECT * FROM requests_tb WHERE request_id = '$r_id' AND r_status = '3' OR r_status = '2'";
    $run = mysqli_query($conn, $sql);
    if ($result =  mysqli_fetch_array($run)) {
        $rid = $result['request_id'];
        $sappliance = $result['s_appliance'];
        $sservice = $result['s_service'];
        $rdesc = $result['request_desc'];
        $rname = $result['requester_name'];
        $radd1 = $result['requester_add1'];
        $radd2 = $result['requester_add2'];
        $rcity = $result['requester_city'];
        $rstate = $result['requester_state'];
        $remail = $result['requester_email'];
        $rmobile = $result['requester_mobile'];
        $ramobile = $result['requester_alt_mobile'];
        $rdate = date("j-n-Y", strtotime($result['request_date']));
        $radate = date("j-n-Y", strtotime($result['assign_date']));
        $wdate = ($result['work_date']);
        $ratech = $result['assign_tech'];
        $techmobile = $result['tech_mobile'];
        $sprice = $result['s_price'];
    }
}

?>

<head>

    <title>View Work Order</title>

    <style>
        .details {
            width: 70%;
        }

        .details .heading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem 0;
            font-size: 1.5rem;
            width: 100%;
            color: white;
            background: var(--blue);
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

        .printbtn {
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
        .closebtn:hover {
            opacity: 1;
        }

        .btns {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            margin: 2rem;
            width: 100%;

        }

        @media(max-width:950px) {
            .details {
                width: 100%;
            }

        }

        @media(max-width:750px) {
            .details .heading {
                width: 100%;
            }

            .content {
                padding: 1.5rem;
            }

            .details {
                width: 100%;
            }

            table {
                width: 100%;
                font-size: 1.3rem;
            }


        }

        @media print {
            .details {
                margin-top: -7rem;
            }

            .head-sidebar,
            .btns,
            .check-id {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="content">

        <div class="details">
            <div class="heading">
                <h3>Work Order Details</h3>
            </div>
            <table>
                <tr>
                    <td><b>Request ID<b></td>
                    <td>
                        <b> <?php if (isset($r_id)) echo $r_id; ?><b>
                    </td>
                </tr>
                <tr>
                    <td>Service Info</td>
                    <td>
                        <?php if (isset($sappliance) AND $sservice) echo ucwords($sappliance) . " (" . ucwords($sservice) . ")"; ?>

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
                    <td>Email</td>
                    <td>
                        <?php if (isset($remail)) echo $remail; ?>
                    </td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td>
                        <?php if (isset($rmobile)) echo $rmobile; ?>
                    </td>
                </tr>
                <tr>
                    <td>Alternate Mobile</td>
                    <td>
                        <?php if (isset($ramobile)) echo $ramobile; ?>
                    </td>
                </tr>
                <tr>
                    <td>Request Date</td>
                    <td>
                        <?php if (isset($rdate)) echo $rdate; ?>
                    </td>
                </tr>
                <tr>
                    <td>Assigned Date</td>
                    <td>
                        <?php if (isset($radate)) echo $radate; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Work Date</b></td>
                    <td>
                        <b><?php if($wdate == "0000-00-00"){ echo "N/A";}else{echo date("j-n-Y", strtotime($wdate));}?><b>
                    </td>
                </tr>
                <tr>
                    <td><b>Technician Name<b></td>
                    <td>
                        <b><?php if (isset($ratech)) echo $ratech; ?></b>
                    </td>
                </tr>
                <tr>
                    <td><b>Technician Mobile No.</b></td>
                    <td>
                        <b><?php if (isset($techmobile)) echo $techmobile; ?></b>
                    </td>
                </tr>
                <tr>
                    <td><b>Payment</b></td>
                    <td>
                        <b><?php if (isset($sprice)) echo "&#8377;".$sprice; ?></b>
                    </td>
                </tr>
            </table>
            <div class="btns">
                <button type="submit" class="printbtn" name="printbtn" onclick="window.print()">Print</button>
                <button type=" reset" class="closebtn" name="closebtn" onclick="location.href = 'work-order.php';">Close</button>
            </div>
        </div>

    </div>


</body>

</html>