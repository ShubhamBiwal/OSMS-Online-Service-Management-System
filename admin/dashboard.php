<?php
$page = "dashboard";
include "../connection.php";
include "include/header-sidebar.php";

$sql = "SELECT u_id, u_name, u_email FROM user_login ORDER BY u_id DESC";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);
if ($rows == 0) {
    $msg = "No Result Found";
}
//dynamic card data
//total received requests
$sql1 = "SELECT max(request_id) FROM submit_request";
$run1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_row($run1);
$total_req_received = $row1[0];
//total assigned work
$sql2 = "SELECT max(r_no) FROM assign_work";
$run2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_row($run2);
$total_assigned_work = $row2[0];
//total technician
$sql3 = "SELECT * FROM technician_tb";
$run3 = mysqli_query($conn, $sql3);
$row3 = mysqli_num_rows($run3);
$total_technicians = $row3;
?>

<head>
    <title>Dashboard</title>
    <style>
        .info-data {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(25rem, 1fr));
            grid-gap: 3rem;

        }

        .info-data .card {
            padding: 2rem;
            border-radius: 1rem;
            border-left: 0.5rem solid var(--blue);
            background: #fff;
            box-shadow: 0.4rem 0.4rem 1.6rem rgba(0, 0, 0, 0.3);

        }

        .card .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card .head h2 {
            font-size: 3rem;
            line-height: 1.7;
            color: var(--blue);
        }

        .card .head p {
            font-size: 1.5rem;
            font-weight: 550;
            color: gray;
        }

        .card .head i {
            font-size: 4.5rem;
            color: var(--blue);
        }

        .info-data .card:hover {
            background: var(--blue);
            transition: .3s ease-in-out;
        }

        .info-data .card:hover p {
            color: black;
        }

        .info-data .card:hover h2,
        .info-data .card:hover i {
            color: var(--white);
        }

        .container {
            margin-top: 7rem;
            box-shadow: 0.4rem 0.4rem 1.6rem rgba(0, 0, 0, 0.3);

        }

        .container .heading {
            background: #222;
            color: white;
            text-align: center;
            padding: 1rem 0;
            font-size: 1.6rem;
            font-weight: 550;
        }

        table {
            text-align: center;
            border-collapse: collapse;
            width: 100%;

        }

        tr {
            border-bottom: .2rem solid rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 1.5rem;

        }

        #msg {
            text-align: center;
            font-size: 1.7rem;
            padding: 1rem 0;
            font-weight: bold;
            color: var(--blue);
        }

        @media (max-width: 750px) {
            .table-data {
                overflow-x: scroll;
            }

            .content {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<div class="content">
    <div class="info-data">
        <a href="requests.php">
            <div class="card">
                <div class="head">
                    <div>
                        <p>Requests Received</p>
                        <h2><?php echo $total_req_received; ?> </h2>
                    </div>
                    <i class="fa-solid fa-hands-holding-circle"></i>
                </div>
            </div>
        </a>
        <a href="work-order.php">
            <div class="card">
                <div class="head">
                    <div>
                        <p>Assigned Work</p>
                        <h2><?php echo $total_assigned_work; ?></h2>
                    </div>
                    <i class="fa-sharp fa-solid fa-handshake"></i>
                </div>
            </div>
        </a>
        <a href="technician.php">
            <div class="card">
                <div class="head">
                    <div>
                        <p>Technicians</p>
                        <h2><?php echo $total_technicians; ?></h2>
                    </div>
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="container">
        <div class="heading">
            <p>List of Requesters</p>
        </div>
        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>Requester ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_array($run)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $result['u_id']; ?>
                            </td>
                            <td>
                                <?php echo $result['u_name']; ?>
                            </td>
                            <td>
                                <?php echo $result['u_email']; ?>
                            </td>

                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            <div id="msg"><?php if (isset($msg)) echo $msg; ?></div>
        </div>
    </div>
</div>