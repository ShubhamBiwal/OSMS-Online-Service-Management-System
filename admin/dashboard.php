<?php
include "../connection.php";
include "include/header-sidebar.php";

$sql = "SELECT u_id, u_name, u_email FROM user_login ORDER BY u_id DESC  ";
$run = mysqli_query($conn, $sql);

?>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/admin-style.css">
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
                        <td><?php echo $result['u_id']; ?></td>
                        <td><?php echo $result['u_name']; ?></td>
                        <td><?php echo $result['u_email']; ?></td>

                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>


</div>