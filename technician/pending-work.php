<?php
$page = "pending-work";
include "../connection.php";
include "include/header-sidebar.php";

$tid = $_SESSION['tech_id'];
//cancelled by user
$sql  = "SELECT request_id, requester_name, requester_mobile, request_date, assign_date FROM requests_tb WHERE tech_id = '$tid' AND r_status ='0' ORDER BY request_id DESC";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);

//cpending
$sql1  = "SELECT request_id,s_appliance, s_service, requester_name, requester_mobile, request_date, assign_date FROM requests_tb WHERE tech_id = '$tid' AND r_status = '2' ORDER BY request_id DESC";
$run1 = mysqli_query($conn, $sql1);
$rows1 = mysqli_num_rows($run1);

if ($rows1 == 0) {
    $msg = "No Pending Work";
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

        th {
            text-align: left;
            border-bottom: .15rem solid rgb(0, 0, 0, 0.2);
            padding: 1rem;
            font-size: 1.5rem;
            width: 30%;

        }

        td {
            border-bottom: .15rem solid rgb(0, 0, 0, 0.2);
            padding: 1rem;
            width: 70%;
            font-size: 1.5rem;
        }
        .sinfo{
            color: var(--blue);
            font-weight: 550;
        }

        .btns {
            display: flex;
            align-items: center;
        }

        form {
            padding: 1.5rem 5rem 1rem 1rem;
            display: flex;
            align-items: center;
            column-gap: 4rem;
        }

        .viewbtn {
            border: none;
            color: #fff;
            padding: 1rem 2rem;
            background: #2597f4;
            font-size: 1.6rem;
            cursor: pointer;
            opacity: 0.8;
            font-weight: 550;
            border-radius: .2rem;
            box-shadow: .1rem .2rem .5rem rgb(0, 0, 0, 0.2);

        }

        .btns .cancelbtn {
            border: none;
            color: var(--blue);
            border: .2rem solid var(--blue);
            padding: .8rem 1.8rem;
            background: #fff;
            font-size: 1.6rem;
            cursor: pointer;
            font-weight: 550;
            border-radius: .2rem;
            box-shadow: .1rem .2rem .5rem rgb(0, 0, 0, 0.2);
        }

        .cancelbtn:hover {
            background: var(--blue);
            color: white;
        }

        .viewbtn:hover {
            opacity: 1;
        }

        .pspan {
            color: #f29339;
            font-size: 1.7rem;
            font-style: oblique;
            font-weight: bolder;
        }

        .ccspan {
            color: #c70000;
            font-size: 1.8rem;
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

        <!-- pending work -->
        <?php while ($result1 = mysqli_fetch_array($run1)) { ?>

            <div class="table-data">
                <table>
                    <tr>
                        <th>Request ID:</th>
                        <td><?php echo $result1['request_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Service Info:</th>
                        <td class="sinfo"><?php echo ucwords($result1['s_appliance']). " (" . $result1['s_service'] . ")"; ?></td>
                    </tr>

                    <tr>
                        <th>Name:</th>
                        <td><?php echo ucwords($result1['requester_name']); ?> </td>
                    </tr>
                    <tr>
                        <th>Mobile No:</th>
                        <td><?php echo $result1['requester_mobile']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Date:</th>
                        <td><?php echo $result1['request_date']; ?> </td>
                    </tr>

                    <tr>
                        <th>Assigned Date:</th>
                        <td><b><?php echo $result1['assign_date']; ?><b> </td>
                    </tr>

                </table>
                <form action="view-pending-work.php" method="post">
                    <input type="hidden" name="pwid" value="<?php echo $result1['request_id']; ?>">
                    <div class="btns">
                        <button type="submit" name="viewbtn" class="viewbtn">View</button>
                    </div>
                    <span class="pspan"><i class="fa-regular fa-hourglass-half"></i> Pending...</span>
                </form>
            </div>
        <?php } ?>

        <!-- cancelled request from user -->
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
                        <th>Request Date:</th>
                        <td><?php echo $result['request_date']; ?> </td>
                    </tr>

                    <tr>
                        <th>Assigned Date:</th>
                        <td><b><?php echo $result['assign_date']; ?><b> </td>
                    </tr>

                </table>
                <form action="view-pending-work.php" method="post">
                    <input type="hidden" name="pwid" value="<?php echo $result['request_id']; ?>">
                    <button type="submit" name="cvbtn" class="viewbtn">View</button>
                    <span class="ccspan"><i class="fa-sharp fa-regular fa-circle-xmark"></i> Cancelled</span>
                </form>
            </div>
        <?php } ?>

        <div id="msg"><?php if (isset($msg)) echo $msg; ?></div>
    </div>

    <script>
        function confirmation() {
            return confirm("Are you sure! you want to cancel this Request?");
        }
    </script>
</body>

</html>