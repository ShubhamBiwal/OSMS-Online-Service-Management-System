<?php
$page = "myrequests";
include "../connection.php";
include "include/header-sidebar.php";

$uid = $_SESSION['u_id'];
//in submit request
$sql  = "SELECT * FROM submit_request WHERE u_id = '$uid' ORDER BY request_id DESC";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);
//in assigned work
$sql2  = "SELECT * FROM assign_work WHERE u_id = '$uid' ORDER BY request_id DESC";
$run2 = mysqli_query($conn, $sql2);
$rows2 = mysqli_num_rows($run2);
//in completed work
$sql3  = "SELECT * FROM completed_work WHERE u_id = '$uid' ORDER BY request_id DESC";
$run3 = mysqli_query($conn, $sql3);
$rows3 = mysqli_num_rows($run3);

if ($rows == 0 and $rows2 == 0 and $rows3 == 0) {
    $msg = "No Request Found";
}





?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <title>My Requests</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href="../css/user-style.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .table-data {
            box-shadow: .2rem .2rem 1rem rgb(0, 0, 0, 0.2);
            width: 50%;
            margin-bottom: 3rem;
        }

        th,
        td {
            text-align: left;
            border-top: .15rem solid rgb(0, 0, 0, 0.2);
            padding: 1rem;
        }

        .rcode {
            color: var(--blue);
            font-weight: 500;
        }

        button {
            border: none;
            color: #fff;
            padding: 1rem 2rem;
            background: #2597f4;
            font-size: 1.6rem;
            cursor: pointer;
            opacity: 0.8;
            font-weight: 500;
            border-radius: .2rem;
            box-shadow: .1rem .2rem .5rem rgb(0, 0, 0, 0.2);
            margin: 1rem;

        }

        .pspan {
            color: #f29339;
            font-size: 1.6rem;
            font-style: oblique;
            font-weight: bolder;
        }

        .aspan {
            color: var(--blue);
            font-style: italic;
            font-size: 1.7rem;
            font-weight: bolder;
        }

        .cspan {
            color: green;
            font-size: 1.7rem;
            font-weight: bolder;
        }

        #msg {
            text-align: center;
            font-size: 1.7rem;
            font-weight: bold;
            color: var(--blue);
        }

        button:hover {
            opacity: 1;
        }

        @media(max-width:950px) {

            .table-data,
            table {
                width: 100%;
            }

            .content {
                padding: 2rem;
            }
        }

        @media print {

            .head-sidebar,
            .printbtn {
                display: none;
            }
        }
    </style>
</head>

<body>


    <div class="content">

        <!-- for submit request -->
        <?php while ($result = mysqli_fetch_array($run)) { ?>

            <div class="table-data">
                <table>
                    <tr>
                        <th>Request ID:</th>
                        <td><?php echo $result['request_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Email ID:</th>
                        <td><?php echo $result['requester_email']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Info:</th>
                        <td><?php echo $result['request_info']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Date:</th>
                        <td><?php echo $result['request_date']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Code:</th>
                        <td class="rcode"><?php echo $result['request_code']; ?> </td>
                    </tr>
                </table>
                <form action="check-status.php" method="post">
                    <input type="hidden" value="<?php echo $result['request_id']; ?>" name="csid">
                    <button type="submit" name="viewbtn" class="viewtbtn">View</button>
                    <span class="pspan">Pending...</span>
                </form>
            </div>
        <?php } ?>
        <!-- for assigned request -->

        <?php while ($result2 = mysqli_fetch_array($run2)) { ?>

            <div class="table-data">
                <table>
                    <tr>
                        <th>Request ID:</th>
                        <td><?php echo $result2['request_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Email ID:</th>
                        <td><?php echo $result2['requester_email']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Info:</th>
                        <td><?php echo $result2['request_info']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Date:</th>
                        <td><?php echo $result2['request_date']; ?> </td>
                    </tr>
                    <tr>
                        <th>Assigned Date:</th>
                        <td><?php echo $result2['assign_date']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Code:</th>
                        <td class="rcode"><?php echo $result2['request_code']; ?> </td>
                    </tr>
                </table>
                <form action="check-status.php" method="post">
                    <input type="hidden" value="<?php echo $result2['request_id']; ?>" name="csid">
                    <button type="submit" name="viewbtn" class="viewtbtn">View</button>
                    <span class="aspan">Assigned</span>
                </form>

            </div>
        <?php } ?>
        <!-- for completed request -->

        <?php while ($result3 = mysqli_fetch_array($run3)) { ?>

            <div class="table-data">
                <table>
                    <tr>
                        <th>Request ID:</th>
                        <td><?php echo $result3['request_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Email ID:</th>
                        <td><?php echo $result3['requester_email']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Info:</th>
                        <td><?php echo $result3['request_info']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Date:</th>
                        <td><?php echo $result3['request_date']; ?> </td>
                    </tr>
                    <tr>
                        <th>Work Date:</th>
                        <td><?php echo $result3['work_date']; ?> </td>
                    </tr>

                </table>
                <form action="view-completed-work.php" method="post">
                    <input type="hidden" value="<?php echo $result3['request_id']; ?>" name="cwid">
                    <button type="submit" name="view-btn" class="viewtbtn">View</button>
                    <span class="cspan"><i class="fa-solid fa-circle-check"></i> Completed</span>

                </form>

            </div>
        <?php } ?>
        <div id="msg"><?php if (isset($msg)) echo $msg; ?></div>
    </div>


</body>

</html>