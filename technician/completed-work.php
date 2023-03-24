<?php
$page = "completed-work";
include "../connection.php";
include "include/header-sidebar.php";

$tid = $_SESSION['tech_id'];

$sql  = "SELECT * FROM completed_work WHERE tech_id = '$tid' ORDER BY request_id DESC";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);

if ($rows == 0) {
    $msg = "No Request Found";
}


?>

<head>
    <title>Completed Work</title>

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
            padding: 1rem;
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

        .pspan {
            color: green;
            font-size: 1.7rem;
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
            scale: 1.01;
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
                        <th>Email ID:</th>
                        <td><?php echo $result['requester_email']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Info:</th>
                        <td><?php echo $result['request_info']; ?> </td>
                    </tr>
                    <tr>
                        <th>Work Date:</th>
                        <td><?php echo $result['work_date']; ?> </td>
                    </tr>

                </table>
                <form action="view-completed-work.php" method="post">
                    <input type="hidden" name="cwid" value="<?php echo $result['request_id']; ?>">
                    <button type="submit" name="viewbtn" class="viewbtn">View</button>
                    <span class="pspan"><i class="fa-solid fa-circle-check"></i> Completed</span>
                </form>
            </div>
        <?php } ?>

        <div id="msg"><?php if (isset($msg)) echo $msg; ?></div>
    </div>


</body>

</html>