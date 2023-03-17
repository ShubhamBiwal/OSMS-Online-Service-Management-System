<?php
$page = "myrequests";
include "../connection.php";
include "include/header-sidebar.php";

$uemail = $_SESSION['is_login'];

$sql  = "SELECT * FROM submit_request WHERE requester_email = '$uemail' ORDER BY request_id DESC";
$run = mysqli_query($conn, $sql);

$sql2  = "SELECT * FROM assign_work WHERE requester_email = '$uemail' ORDER BY request_id DESC";
$run2 = mysqli_query($conn, $sql2);


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

        td {
            padding: 1.5rem;
        }

        button {
            border: none;
            color: #fff;
            padding: 1rem 2rem;
            background: #2597f4;
            font-size: 1.6rem;
            cursor: pointer;
            opacity: 0.9;
            font-weight: 500;
            border-radius: .2rem;
            box-shadow: .1rem .2rem .5rem rgb(0, 0, 0, 0.2);
            margin: 1rem;

        }
        .pspan{
            color: #2597f4;
            font-size: 1.6rem;
            font-style: italic;
            font-weight: 600;
        }
        .aspan{
            color: green;
            font-size: 1.7rem;
            font-weight: bolder;
        }

        button:hover {
            opacity: 1;
            border: .1rem solid #2597f4;
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


        <?php while ($result = mysqli_fetch_array($run)) { ?>

            <div class="table-data">
                <table>
                    <tr>
                        <th>Request ID:</th>
                        <td><?php echo $result['request_id']; ?></td>
                    </tr>

                    <tr>
                        <th>Name:</th>
                        <td><?php echo $result['requester_name']; ?> </td>
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
                        <th>Request Description:</th>
                        <td><?php echo $result['request_desc']; ?> </td>
                    </tr>
                </table>
                <button type="submit" name="printbtn" class="printbtn" onclick="window.print()">Print</button>
                <span  class="pspan">Pending...</span>


            </div>
        <?php } ?>

        <?php while ($result2 = mysqli_fetch_array($run2)) { ?>

            <div class="table-data">
                <table>
                    <tr>
                        <th>Request ID:</th>
                        <td><?php echo $result2['request_id']; ?></td>
                    </tr>

                    <tr>
                        <th>Name:</th>
                        <td><?php echo $result2['requester_name']; ?> </td>
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
                        <th>Request Description:</th>
                        <td><?php echo $result2['request_desc']; ?> </td>
                    </tr>
                </table>
                <button type="submit" name="printbtn" class="printbtn" onclick="window.print()">Print</button>
                <span class="aspan">Assigned</span>

            </div>
        <?php } ?>

    </div>


</body>

</html>