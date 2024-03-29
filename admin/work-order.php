<?php
$page = "workorder";
include "../connection.php";
include "include/header-sidebar.php";
//pending order
$sql = "SELECT * FROM requests_tb WHERE (r_status = '2' OR r_status = '3') AND admin_status = '1' ORDER BY assign_date ";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);
if ($rows == 0) {
    $msg = "No Pending Work";
} else {
    echo '<style>#msg{display:none;}</style>';
}
//cancelled order table
$sql2 = "SELECT * FROM requests_tb WHERE r_status = '0' AND admin_status = '0' ORDER BY assign_date ";
$run2 = mysqli_query($conn, $sql2);
$rows2 = mysqli_num_rows($run2);
if ($rows2 == 0) {
    $msg2 = "No Result Found";
} else {
    echo '<style>#msg2{display:none;}</style>';
}



//delete data
if (isset($_POST['delete-btn'])) {
    $r_id = $_POST['rid'];
    $sql = "DELETE FROM requests_tb WHERE request_id = '$r_id'";
    $run = mysqli_query($conn, $sql);
    if ($run) {
        echo '<script>location.href="work-order.php";</script>';
    } else {
        echo '<script>alert("Unable to Delete!")</script>';
    }
}
//payment confirmed
if (isset($_POST['confirm-btn'])) {
    $r_id = $_POST['rid'];
    $rs_id = $_POST['rsid'];
    if ($rs_id == '2') {
        echo '<script>alert("Error: Work is not completed yet!")</script>';
    } else {
        $sql = "UPDATE requests_tb SET admin_status = '2' WHERE request_id = '$r_id' AND r_status = '3' AND admin_status = '1'";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            echo '<script>location.href="work-order.php";</script>';
        } else {
            echo '<script>alert("Unable to Process!")</script>';
        }
    }
}
?>

<head>
    <title>Work Order</title>
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        .content {
            height: calc(100vh - 7rem);
        }

        #msg,
        #msg2 {
            text-align: center;
            font-size: 1.7rem;
            padding: 1rem 0;
            font-weight: bold;
            color: var(--blue);
        }

        .container {
            box-shadow: rgba(60, 64, 67, 0.3) 0 .1rem .2rem 0, rgba(60, 64, 67, 0.15) 0 .2rem .6rem .2rem;
            height: 56%;
            overflow-y: scroll;
        }

        .container2 {
            box-shadow: rgba(60, 64, 67, 0.3) 0 .1rem .2rem 0, rgba(60, 64, 67, 0.15) 0 .2rem .6rem .2rem;
            height: 34%;
            overflow-y: scroll;
        }

        .heading {
            margin-top: 3%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            color: red;
            background: lightgray;
            font-size: 1.7rem;
            font-weight: bold;
        }

        table {
            text-align: center;
            border-collapse: collapse;
            width: 100%;
        }

        tr {
            border-bottom: .1rem solid rgba(0, 0, 0, 0.3);
        }
        th{
            font-size: 1.5rem;
            font-weight: 650;
            padding: 1rem;
        }
        td{
            font-size: 1.45rem;
            padding: 1rem ;
        }
        td span {
            color: red;
            font-size: 1.5rem;
        }

        .table-data,
        .table-data2 {
            overflow-x: scroll;
        }

        .form-btn {
            display: flex;
            flex-direction: row;
            gap: .5rem;

            align-items: center;
        }

        .view-btn {
            background: #2597f4;
            padding: 1rem;
            color: white;
            cursor: pointer;
            border-radius: .5rem;
            font-size: 1.5rem;
        }

        .delete-btn {
            background: gray;
            color: white;
            padding: 1rem;
            cursor: pointer;
            border-radius: .5rem;
            font-size: 1.5rem;

        }

        .confirm-btn {
            background: green;
            color: white;
            padding: 1rem;
            cursor: pointer;
            border-radius: .5rem;
            font-size: 1.5rem;
            opacity: .8;

        }

        .cancel-btn {
            background: #eee;
            color: red;
            padding: 1rem;
            cursor: pointer;
            border-radius: .5rem;
            font-size: 1.5rem;
        }

        .delete-btn:hover {
            background: #333;
        }

        .confirm-btn:hover {
            opacity: 1;
            scale: 1.02;
        }

        .view-btn:hover {
            background: #1275c6;
        }

        thead {
            background: #1275c6;
            color: white;
        }

        @media(max-width:750px) {
            .content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<div class="content">
    <!-- pending payment -->

    <div class="container">
        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Req ID</th>
                        <th>Service info</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Technician</th>
                        <th>Tech Mobile</th>
                        <th>Request Date</th>
                        <th>Assign Date</th>
                        <th>Work Date</th>
                        <th>Payment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    while ($result = mysqli_fetch_array($run)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $count; ?>
                                <?php $count++; ?>
                            </td>
                            <td>
                                <b> <?php echo $result['request_id']; ?></b>
                            </td>
                            <td>
                                <?php echo ucwords($result['s_appliance']) . " (" . ucwords($result['s_service']) . ")"; ?>
                            </td>
                            <td>
                                <?php echo ucwords($result['requester_name']); ?>
                            </td>
                            <td>
                                <?php echo $result['requester_mobile']; ?>
                            </td>
                            <td>
                                <?php echo ucwords($result['assign_tech']); ?>
                            </td>
                            <td>
                                <?php echo $result['tech_mobile']; ?>
                            </td>
                            <td>
                                <?php if ($result['request_date'] == "0000-00-00") {
                                    echo "N/A";
                                } else {
                                    echo date("j/n/Y", strtotime($result['request_date']));
                                } ?>
                            </td>
                            <td>
                                <?php if ($result['assign_date'] == "0000-00-00") {
                                    echo "N/A";
                                } else {
                                    echo date("j/n/Y", strtotime($result['assign_date']));
                                } ?>
                            </td>
                            <td>
                                <?php if ($result['work_date'] == "0000-00-00") {
                                    echo "N/A";
                                } else {
                                    echo date("j/n/Y", strtotime($result['work_date']));
                                } ?>
                            </td>
                            <td> <b> <?php echo "&#8377;" . $result['s_price']; ?></b> </td>
                            <td>
                                <div class="form-btn">
                                    <form action="view-work-order.php" method="post">
                                        <input type="hidden" name="rid" value="<?php echo $result['request_id']; ?>">
                                        <button type="submit" name="view-btn" class="view-btn"><i class="fa-solid fa-eye"></i></button>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="rid" value="<?php echo $result['request_id']; ?>">
                                        <button type="submit" name="delete-btn" class="delete-btn" Onclick="return ConfirmDelete();"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="rid" value="<?php echo $result['request_id']; ?>">
                                        <input type="hidden" name="rsid" value="<?php echo $result['r_status']; ?>">
                                        <button type="submit" name="confirm-btn" class="confirm-btn" Onclick="return ConfirmPayment();"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            <div id="msg"><?php if (isset($msg)) echo $msg; ?></div>
        </div>
    </div>

    <!-- cancelled request -->
    <div class="heading">
        <span>Cancelled Requests</span>
    </div>
    <div class="container2">
        <div class="table-data2">
            <table>
                <thead>
                    <tr>
                        <th>S No</th>
                        <th>Req ID</th>
                        <th>Service info</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Technician</th>
                        <th>Tech Mobile</th>
                        <th>Request Date</th>
                        <th>Assign Date</th>
                        <th>Work Date</th>
                        <th>Payment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    while ($result2 = mysqli_fetch_array($run2)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $count; ?>
                                <?php $count++; ?>
                            </td>
                            <td>
                                <b> <?php echo $result2['request_id']; ?></b>
                            </td>
                            <td>
                                <?php echo ucwords($result2['s_appliance']) . " (" . ucwords($result2['s_service']) . ")"; ?>
                            </td>
                            <td>
                                <?php echo ucwords($result2['requester_name']); ?>
                            </td>
                            <td>
                                <?php echo $result2['requester_mobile']; ?>
                            </td>
                            <td>
                                <?php echo ucwords($result2['assign_tech']); ?>
                            </td>
                            <td>
                                <?php echo $result2['tech_mobile']; ?>
                            </td>
                            <td>
                                <?php if ($result2['request_date'] == "0000-00-00") {
                                    echo "N/A";
                                } else {
                                    echo date("j/n/Y", strtotime($result2['request_date']));
                                } ?>
                            </td>
                            <td>
                                <?php if ($result2['assign_date'] == "0000-00-00") {
                                    echo "N/A";
                                } else {
                                    echo date("j/n/Y", strtotime($result2['assign_date']));
                                } ?>
                            </td>
                            <td>
                                <?php if ($result2['work_date'] == "0000-00-00") {
                                    echo "N/A";
                                } else {
                                    echo date("j/n/Y", strtotime($result2['work_date']));
                                } ?>
                            </td>
                            <td> <b>
                                    <span> <?php echo "&#8377;" . $result2['s_price']; ?></span> </b>
                            </td>
                            <td>
                                <div class="form-btn">
                                    <form action="view-work-order.php" method="post">
                                        <input type="hidden" name="rid" value="<?php echo $result2['request_id']; ?>">
                                        <button type="submit" name="view-btn" class="view-btn"><i class="fa-solid fa-eye"></i></button>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="rid" value="<?php echo $result2['request_id']; ?>">
                                        <button type="submit" name="delete-btn" class="delete-btn" Onclick="return ConfirmDelete();"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="rid" value="<?php echo $result2['request_id']; ?>">
                                        <button type="button" class="cancel-btn" id="c-button" onclick="CancelAlert()"><i class="fa-solid fa-ban"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                    <?php } ?>
                </tbody>
            </table>
            <div id="msg2"><?php if (isset($msg2)) echo $msg2; ?></div>
        </div>
    </div>

</div>


<script>
    function ConfirmDelete() {
        return confirm("Are You Sure to Delete this?");
    }

    function ConfirmPayment() {
        return confirm("Payment Received?");
    }

    function CancelAlert() {
        Swal.fire({
            icon: 'info',
            title: 'This is a cancelled request!',
            confirmButtonColor: '#2597f4',
            confirmButtonText: 'OK'
        })
    }
</script>

<!-- amargupta52.ag@gmail.com -->