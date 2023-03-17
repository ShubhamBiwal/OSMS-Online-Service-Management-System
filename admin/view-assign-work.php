<?php
include "../connection.php";
include "include/header-sidebar.php";

if (isset($_POST['view-btn'])) {
    $r_id = $_POST['rid'];
    $sql = "SELECT * FROM assign_work WHERE request_id = '$r_id' ";
    $run = mysqli_query($conn, $sql);
    if ($result =  mysqli_fetch_array($run)) {
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
        $radate = $result['assign_date'];
        $ratech = $result['assign_tech'];
    }
}

?>


<head>

    <title>View Assign Work </title>

    <style>
        .details {
            width: 70%;
        }

        .details .heading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
            font-size: 1.3rem;
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        tr,
        td {
            border: .1rem solid rgba(0, 0, 0, 0.2);
            padding: 1.5rem 1rem;
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
                margin-top: -10rem;
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
                <h2>Assigned Work Details</h2>
            </div>
            <table>
                <tr>
                    <td><b>Request ID<b></td>
                    <td>
                        <b> <?php if (isset($rid)) echo $rid; ?><b>
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
                    <td>Mobile</td>
                    <td>
                        <?php if (isset($rmobile)) echo $rmobile; ?>
                    </td>
                </tr>
                <tr>
                    <td>Assigned Date</td>
                    <td>
                        <?php if (isset($radate)) echo $radate; ?>
                    </td>
                </tr>
                <tr>
                    <td>Technician Name</td>
                    <td>
                        <?php if (isset($ratech)) echo $ratech; ?>
                    </td>
                </tr>
                <tr>
                    <td>Customer Sign</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Technician Sign</td>
                    <td></td>
                </tr>
            </table>
            <div class="btns">
                <button type="submit" class="printbtn" name="printbtn" onclick="window.print()">Print</button>
                <button type=" reset" class="closebtn" name="closebtn" onclick="location.href = 'work-order.php';">Close</button>
            </div>
        </div>

        <?php if (isset($msg)) echo '<div id="msg">Your Request is Still Pending...</div>'; ?>
    </div>


</body>

</html>