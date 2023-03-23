<?php
$page = "pending-work";
include "../connection.php";
include "include/header-sidebar.php";

$temail = $_SESSION['is_techlogin'];

$sql  = "SELECT * FROM assign_work WHERE tech_email = '$temail' ORDER BY request_id DESC";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);

if ($rows == 0) {
    $msg = "No Request Found";
}




?>

<head>
    <title>Pending Work</title>

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

        #msg {
            text-align: center;
            font-size: 1.7rem;
            padding: 1rem 0;
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
                        <th>Mobile No:</th>
                        <td><?php echo $result['requester_mobile']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Info:</th>
                        <td><?php echo $result['request_info']; ?> </td>
                    </tr>

                    <tr>
                        <th>Work Date:</th>
                        <td><i><?php echo $result['assign_date']; ?><i> </td>
                    </tr>

                </table>
                <form action="view-pending-work.php" method="post">
                    <input type="hidden" name="pwid" value="<?php echo $result['request_id']; ?>">
                    <button type="submit" name="viewbtn" class="viewbtn">View</button>
                    <span class="pspan">Pending...</span>
                </form>
            </div>
        <?php } ?>

        <div id="msg"><?php if (isset($msg)) echo $msg; ?></div>
    </div>


</body>

</html>