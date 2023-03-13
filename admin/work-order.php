<?php
include "../connection.php";
include "include/header-sidebar.php";

$sql = "SELECT * FROM assign_work";
$run = mysqli_query($conn, $sql);

//delete data
if (isset($_POST['delete-btn'])) {
    $r_id = $_POST['rid'];

    $sql = "DELETE FROM assign_work WHERE request_id = '$r_id'";
    $run = mysqli_query($conn, $sql);
    if ($run) {
        echo '<script>location.href="work-order.php";</script>';
    } else {
        echo '<script>alert("Unable to Delete!")</script>';
    }
}

?>

<head>
    <title>Work Order</title>
    <style>
        .container {
            box-shadow: rgba(60, 64, 67, 0.3) 0 .1rem .2rem 0, rgba(60, 64, 67, 0.15) 0 .2rem .6rem .2rem;
        }

        table {
            text-align: left;
            border-collapse: collapse;
            width: 100%;

        }

        tr {
            border-bottom: .1rem solid rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 1rem 0.5rem 2rem 1rem;

        }

        .table-data {
            overflow-x: scroll;
        }

        .form-btn {
            display: flex;
            flex-direction: row;
            gap: .5rem;
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

        .delete-btn:hover {
            background: #333;
        }

        .view-btn:hover {
            background: #1275c6;
        }

        thead {
            background: #1275c6;
            color: white;
        }
    </style>
</head>
<div class="content">
    <div class="container">
        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>Req ID</th>
                        <th>Request info</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Mobile</th>
                        <th>Technician</th>
                        <th>Assigned Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_array($run)) {
                    ?>
                        <tr>
                            <td>
                                <b> <?php echo $result['request_id']; ?></b>
                            </td>
                            <td>
                                <?php echo $result['request_info']; ?>
                            </td>
                            <td>
                                <?php echo $result['requester_name']; ?>
                            </td>
                            <td>
                                <?php echo $result['requester_add2']; ?>
                            </td>
                            <td>
                                <?php echo $result['requester_city']; ?>
                            </td>
                            <td>
                                <?php echo $result['requester_mobile']; ?>
                            </td>
                            <td>
                                <?php echo $result['assign_tech']; ?>
                            </td>
                            <td>
                                <?php echo $result['assign_date']; ?>
                            </td>
                            <td>
                                <div class="form-btn">
                                    <form action="view-assign-work.php" method="post">
                                        <input type="hidden" name="rid" value="<?php echo $result['request_id']; ?>">
                                        <button type="submit" name="view-btn" class="view-btn"><i class="fa-solid fa-eye"></i></button>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="rid" value="<?php echo $result['request_id']; ?>">
                                        <button type="submit" name="delete-btn" class="delete-btn" Onclick="return ConfirmDelete();"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function ConfirmDelete() {
        return confirm("Are You Sure to Delete this?");
    }
</script>