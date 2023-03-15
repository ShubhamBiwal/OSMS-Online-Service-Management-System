<?php
include "../connection.php";
include "include/header-sidebar.php";

echo '<style>.details{display:none;}</style>';

if (isset($_POST['search-btn'])) {
    $checkid = $_POST['checkid'];
    if ($checkid == "") {
        echo '<script>alert("Please Enter Request ID.");</script>';
    } else {
        $sql = "SELECT * FROM assign_work WHERE request_id =  '$checkid'";
        $run = mysqli_query($conn, $sql);

        if ($result = mysqli_fetch_array($run)) {
            echo '<style>.details{display:block;}</style>';

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
        } else {
            $msg = "";
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
        .check-id {
            display: flex;
            gap: 1rem;
            flex-direction: row;
            align-items: center;
        }

        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .check-id input[type="number"] {
            background-color: #f2f2f2;
            outline: .1rem solid rgba(0, 0, 0, 0.3);
            padding: .5rem 1rem;
        }

        .check-id input[type="number"]:focus {
            outline: .2rem solid rgba(0, 0, 0, 0.5);
        }

        .check-id label {
            font-size: 1.5rem;
            font-weight: 550;
        }

        .check-id .search-btn {
            background: #2597f4;
            color: white;
            font-size: 1.6rem;
            padding: .7rem 1rem;
            cursor: pointer;
            opacity: .85;
            border-radius: .2rem;
            box-shadow: .2rem .2rem 1rem rgba(0, 0, 0, 0.3);

        }

        .search-btn:hover {
            opacity: 1;
        }

        .details {
            margin-top: 4rem;

        }

        .details .heading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
            font-size: 2rem;
            width: 70%;
        }

        #msg {
            margin-top: 3rem;
            padding: 1rem;
            background: #e2effa;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
            font-size: 1.6rem;
        }

        table {
            width: 70%;
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
            margin-top: 2rem;
            width: 70%;
        }


        @media(max-width:750px) {
            .details .heading {
                width: 100%;
            }

            table,
            .msg {
                width: 100%;
            }

            .check-id {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="content">
        <form action="" method="post">
            <div class="check-id">
                <label for="checkid">Enter Request ID:</label>
                <input type="number" name="checkid">
                <input type="submit" name="search-btn" class="search-btn" value="Search">
            </div>
        </form>



        <div class="details" id="printme">
            <h2 class="heading">Assigned Work Details</h2>
            <table>
                <tr>
                    <td>Request ID</td>
                    <td>
                        <?php if (isset($rid)) echo $rid; ?>
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
                <button type="submit" class="printbtn" name="printbtn" onclick="ContentPrint('printme')">Print</button>
                <button type=" reset" class="closebtn" name="closebtn" onclick="location.href = 'check-status.php';">Close</button>
            </div>
        </div>

        <?php if (isset($msg)) echo '<div id="msg">Your Request is Still Pending...</div>'; ?>
    </div>


    <script>
        function ContentPrint(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>

</body>

</html>