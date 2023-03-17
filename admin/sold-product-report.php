<?php
$page = "sellreport";
include "../connection.php";
include "include/header-sidebar.php";
echo '<style>.table{display:none;}</style>';
if (isset($_POST['search-btn'])) {
    $start_date = $_POST['startdate'];
    $end_date = $_POST['enddate'];
    if ($start_date == "" || $end_date == "") {
        echo '<script>alert("Please Select Start and End Date.");</script>';
    } else {
        $sql = "SELECT * FROM product_sell WHERE cpdate BETWEEN '$start_date' AND '$end_date' ORDER BY cpdate";
        $run = mysqli_query($conn, $sql);
        $row = mysqli_num_rows($run);
        if ($run) {
            echo '<style>.table{display:block;}</style>';
        }
        if ($row == 0) {
            $msg = "No Result Found";
        }
    }
}
?>

<head>
    <title>Sell Report</title>
    <style>
        .form-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 1.5rem;
        }

        .form-container input[type="date"] {
            border: .1rem solid rgba(0, 0, 0, 0.3);
            width: 20rem;
        }

        .form-container input {
            height: 3.5rem;
            padding: 0 1rem;
        }

        .form-container span {
            font-size: 1.6rem;
            font-weight: bold;
        }

        .form-container .search-btn {
            border: none;
            background: #2597f4;
            color: white;
            font-size: 1.5rem;
            border-radius: .5rem;
            cursor: pointer;
            font-weight: 550;
        }

        .form-container .search-btn:hover {
            background: #0869b9;
        }

        .table {
            box-shadow: 0.4rem 0.4rem 1.6rem rgba(0, 0, 0, 0.3);
            margin-top: 4rem;

        }

        .table .heading {
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
            padding: 1rem;

        }

     

        .print-btn {
            position: fixed;
            bottom: 4rem;
            right: 3rem;
            font-size: 3rem;
            background: #2597f4;
            color: white;
            padding: 1rem;
            cursor: pointer;
            border-radius: .5rem;
            z-index: 99;

        }

        .print-btn:hover {
            background: #1275c6;
        }

        @media(max-width:950px) {
            .table-data {
                overflow-x: scroll;
            }
        }

        @media(max-width:750px) {
            .form-container {
                flex-direction: column;
            }

            .form-container input[type="date"],
            .search-btn {
                width: 100%;
            }
            .content{
                padding: 1.5rem;
            }
        }

        @media print {
        .table{
            margin-top: -5rem;
        }
        .table-data{
            overflow: hidden;
        }
            .head-sidebar, .form-container,
            .printbtn,
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<div class="content">
    <span class="print-btn" onclick="window.print()"><i class="fa-solid fa-print"></i></span>

    <form action="" method="post">
        <div class="form-container">
            <input type="date" name="startdate" class="startdate">
            <span>To</span>
            <input type="date" name="enddate" class="enddate">
            <input type="submit" value="Search" name="search-btn" class="search-btn">
        </div>
    </form>
    <div class="table">

        <div class="heading">
            <p>Sell Details</p>
        </div>
        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price(1)</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_array($run)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $result['cid']; ?>
                            </td>
                            <td>
                                <?php echo $result['cname']; ?>
                            </td>
                            <td>
                                <?php echo $result['caddress']; ?>
                            </td>
                            <td>
                                <?php echo $result['cpname']; ?>
                            </td>
                            <td>
                                <?php echo $result['cpquantity']; ?>
                            </td>
                            <td>
                                <?php echo $result['cpeach']; ?>
                            </td>
                            <td>
                                <?php echo $result['cptotal']; ?>
                            </td>
                            <td>
                                <?php echo $result['cpdate']; ?>
                            </td>

                        </tr>

                    <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
