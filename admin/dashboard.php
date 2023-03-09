<?php
include "../connection.php";
include "include/header-sidebar.php";

$sql = "SELECT u_id, u_name, u_email FROM user_login ORDER BY u_id DESC  ";
$run = mysqli_query($conn, $sql);

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

        th , td{
            padding: 1.5rem;

        }

        @media (max-width: 750px) {
            .table-data {
                overflow-x: scroll;
            }
        }
    </style>
</head>

<div class="content">
    <div class="info-data">
        <a href="">
            <div class="card">
                <div class="head">
                    <div>
                        <p>Requests Received</p>
                        <h2>50 </h2>
                    </div>
                    <i class="fa-solid fa-hands-holding-circle"></i>
                </div>
            </div>
        </a>
        <a href="">
            <div class="card">
                <div class="head">
                    <div>
                        <p>Assigned Work</p>
                        <h2>0</h2>
                    </div>
                    <i class="fa-sharp fa-solid fa-handshake"></i>
                </div>
            </div>
        </a>
        <a href="">
            <div class="card">
                <div class="head">
                    <div>
                        <p>Technicians</p>
                        <h2>0</h2>
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
        </div>
    </div>


</div>