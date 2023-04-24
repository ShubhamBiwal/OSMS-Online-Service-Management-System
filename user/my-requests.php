<?php
$page = "myrequests";
include "../connection.php";
include "include/header-sidebar.php";

$uid = $_SESSION['u_id'];

//show cancelled request
$sql  = "SELECT * FROM requests_tb WHERE u_id = '$uid' AND r_status = '0' ORDER BY request_date ";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);
// submit request
$sql1  = "SELECT * FROM requests_tb WHERE u_id = '$uid' AND r_status = '1' ORDER BY request_id DESC ";
$run1 = mysqli_query($conn, $sql1);
$rows1 = mysqli_num_rows($run1);
// assigned work
$sql2  = "SELECT * FROM requests_tb WHERE u_id = '$uid' AND r_status = '2' ORDER BY assign_date ";
$run2 = mysqli_query($conn, $sql2);
$rows2 = mysqli_num_rows($run2);
//completed work
$sql3  = "SELECT * FROM requests_tb WHERE u_id = '$uid' AND r_status = '3' ORDER BY work_date DESC";
$run3 = mysqli_query($conn, $sql3);
$rows3 = mysqli_num_rows($run3);


if ($rows == 0 and $rows1 == 0 and $rows2 == 0 and $rows3 == 0) {
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
            font-size: 1.5rem;
            padding: 1rem;
        }

        th {
            font-weight: 700;
            width: 40%;
        }

        td {
            width: 60%;
        }

        .sinfo {
            color: black;
            font-weight: 500;
        }

        .rcode {
            color: var(--blue);
            font-weight: 500;
        }

        .btns {
            display: flex;
            align-items: center;
            column-gap: 3rem;
        }

        .price {
            color: red;
            font-weight: bold;
        }

        form {
            padding: 1.5rem 5rem 1rem 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
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

        .ccspan {
            color: #c70000;
            font-size: 1.8rem;
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
        <?php while ($result1 = mysqli_fetch_array($run1)) { ?>

            <div class="table-data">
                <table>
                    <tr>
                        <th>Request ID:</th>
                        <td><?php echo $result1['request_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Service Info:</th>
                        <td class="sinfo"><?php echo ucwords($result1['s_appliance']) . " (" . ucwords($result1['s_service'])  . ")"; ?></td>
                    </tr>

                    <tr>
                        <th>Request Desc:</th>
                        <td><?php echo $result1['request_desc']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Date:</th>
                        <td><?php echo date("j-n-Y", strtotime($result1['request_date'])); ?> </td>
                    </tr>
                    <tr>
                        <th>Cost (in Rs):</th>
                        <td class="price"><?php echo "&#8377;" . $result1['s_price']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Code:</th>
                        <td class="rcode"><?php echo $result1['request_code']; ?> </td>
                    </tr>
                </table>
                <form action="check-status.php" method="post">
                    <input type="hidden" value="<?php echo $result1['request_id']; ?>" name="csid">
                    <div class="btns">
                        <button type="submit" name="cancelbtn" class="cancelbtn" onclick=" return confirmation()">Cancel</button>
                        <button type="submit" name="viewbtn" class="viewbtn">View</button>
                    </div>
                    <span class="pspan"><i class="fa-regular fa-hourglass-half"></i> Pending...</span>
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
                        <th>Service Info:</th>
                        <td class="sinfo"><?php echo ucwords($result2['s_appliance']) . " (" . $result2['s_service'] . ")"; ?></td>
                    </tr>
                    <tr>
                        <th>Assigned Date:</th>
                        <td><?php echo date("j-n-Y", strtotime($result2['assign_date'])); ?> </td>
                    </tr>
                    <tr>
                        <th>Assigned Technician:</th>
                        <td><?php echo ucwords($result2['assign_tech']); ?> </td>
                    </tr>
                    <tr>
                        <th>Technician Mobile:</th>
                        <td><?php echo $result2['tech_mobile']; ?> </td>
                    </tr>
                    <tr>
                        <th>Cost (in Rs):</th>
                        <td class="price"><?php echo "&#8377;" . $result2['s_price']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Code:</th>
                        <td class="rcode"><?php echo $result2['request_code']; ?> </td>
                    </tr>
                </table>
                <form action="check-status.php" method="post">
                    <input type="hidden" value="<?php echo $result2['request_id']; ?>" name="csid">
                    <div class="btns">
                        <button type="submit" name="cancelbtn" class="cancelbtn" onclick=" return confirmation()">Cancel</button>
                        <button type="submit" name="viewbtn" class="viewbtn">View</button>
                    </div>
                    <span class="aspan"><i class="fa-solid fa-business-time"></i> Assigned</span>
                </form>

            </div>
        <?php } ?>


        <!-- for cancelled request -->

        <?php while ($result = mysqli_fetch_array($run)) { ?>

            <div class="table-data">
                <table>
                    <tr>
                        <th>Request ID:</th>
                        <td><?php echo $result['request_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Service Info:</th>
                        <td class="sinfo"><?php echo ucwords($result['s_appliance']) . " (" . ucwords($result['s_service'])  . ")"; ?></td>
                    </tr>

                    <tr>
                        <th>Request Desc:</th>
                        <td><?php echo $result['request_desc']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Date:</th>
                        <td><?php echo date("j-n-Y", strtotime($result['request_date'])); ?> </td>
                    </tr>
                    <tr>
                        <th>Cost (in Rs):</th>
                        <td class="price"><?php echo "&#8377;" . $result['s_price']; ?> </td>
                    </tr>
                </table>

                <form action="">
                    <span class="ccspan"><i class="fa-sharp fa-regular fa-circle-xmark"></i> Cancelled</span>
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
                        <th>Work Date:</th>
                        <td><b><?php echo date("j-n-Y", strtotime($result3['work_date'])); ?></b> </td>
                    </tr>
                    <tr>
                        <th>Service Info:</th>
                        <td class="sinfo"><?php echo ucwords($result3['s_appliance']) . " (" . ucwords($result3['s_service']) . ")"; ?></td>
                    </tr>

                    <tr>
                        <th>Assigned Technician:</th>
                        <td><?php echo ucwords($result3['assign_tech']); ?> </td>
                    </tr>
                    <tr>
                        <th>Technician Mobile:</th>
                        <td><?php echo $result3['tech_mobile']; ?> </td>
                    </tr>
                    <tr>
                        <th>Request Date:</th>
                        <td><?php echo date("j-n-Y", strtotime($result3['request_date'])); ?> </td>
                    </tr>
                    <tr>
                        <th>Payment (in Rs):</th>
                        <td class="price"><?php echo "&#8377;" . $result3['s_price']; ?> </td>
                    </tr>
                </table>
                <form action="view-completed-work.php" method="post">
                    <input type="hidden" value="<?php echo $result3['request_id']; ?>" name="cwid">
                    <button type="submit" name="view-btn" class="viewbtn">View</button>
                    <span class="cspan"><i class="fa-solid fa-circle-check"></i> Completed</span>
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
    <!-- sweet alert js -->
    <?php
    if (isset($_SESSION['status_title']) && $_SESSION['status_title'] != '') {
    ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['status_icon'] ?>',
                title: '<?php echo $_SESSION['status_title'] ?>',
                confirmButtonColor: '#2597f4',
                confirmButtonText: 'OK'
            })
        </script>
    <?php
        unset($_SESSION['status_title']);
    }
    ?>



    <!-- sweet alert js -->
    <?php
    if (isset($_SESSION['status_title2']) && $_SESSION['status_title2'] != '') {
    ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['status_icon2'] ?>',
                title: '<?php echo $_SESSION['status_title2'] ?>',
                text: '<?php echo $_SESSION['status_text2'] ?>',
                confirmButtonColor: '#2597f4',
                confirmButtonText: 'OK'
            })
        </script>
    <?php
        unset($_SESSION['status_title2']);
    }
    ?>


</body>

</html>