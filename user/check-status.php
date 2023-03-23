<?php

include "../connection.php";
include "include/header-sidebar.php";

$csid = $_POST['csid'];
if (isset($csid)) {
    $sql = "SELECT * FROM assign_work WHERE request_id =  '$csid'";
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
        $radate = $result['assign_date'];
        $rcode = $result['request_code'];
        $ratech = $result['assign_tech'];
        $techmobile = $result['tech_mobile'];
    } else {
        $sqls = "SELECT request_id FROM submit_request WHERE request_id = '$csid'";
        $runs = mysqli_query($conn, $sqls);
        if (mysqli_num_rows($runs) > 0) {
            echo '<style>.details{display:none;}</style>';
            echo '<script>alert("Your Request is Still Pending...")</script>';
            echo '<script>location.href="my-requests.php";</script>';
            
        }
    }
}


?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <title>Check Status</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href="../css/user-style.css">
    <style>
        .details {
            width: 70%;
        }

        .details .heading {
            padding: 1rem 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.3rem;
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
                <h2>Work Details</h2>
            </div>
            <table>
                <tr>
                    <td><b>Request ID<b></td>
                    <td>
                        <b> <?php if (isset($rid)) echo $rid; ?></b>
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
                    <td>Request Code</td>
                    <td>
                        <?php if (isset($rcode)) echo $rcode; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Assigned Date<b></td>
                    <td>
                        <?php if (isset($radate)) echo $radate; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Technician Name<b></td>
                    <td>
                        <?php if (isset($ratech)) echo $ratech; ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Technician Mobile No.</b></td>
                    <td>
                        <?php if (isset($techmobile)) echo $techmobile; ?>
                    </td>
                </tr>
            </table>
            <div class="btns">
                <button type="submit" class="printbtn" name="printbtn" onclick="window.print()">Print</button>
                <button type="submit" class="closebtn" name="closebtn" onclick="location.href = 'my-requests.php';">Close</button>
            </div>
        </div>

        <?php if (isset($msg)) echo '<div id="msg">Your Request is Still Pending...</div>'; ?>
    </div>


</body>

</html>