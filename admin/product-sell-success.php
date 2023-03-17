<?php
include "../connection.php";
include "include/header-sidebar.php";

$c_id = $_SESSION['myid'];

$sql = "SELECT * FROM product_sell WHERE cid = '$c_id' ";
$run = mysqli_query($conn, $sql);
if ($result =  mysqli_fetch_array($run)) {
    $cid = $result['cid'];
    $cname = $result['cname'];
    $cadd = $result['caddress'];
    $cpname = $result['cpname'];
    $cpquantity = $result['cpquantity'];
    $cpeach = $result['cpeach'];
    $cptotal = $result['cptotal'];
    $cpdate = $result['cpdate'];
} else {
    echo '<script>alert("Error: Failed!!");</script>';
}


?>


<head>

    <title>Product Sell Success</title>

    <style>
        .details {
            width: 40%;

        }

        .details .heading {
            background: var(--blue);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem 0;
            font-size: 2rem;
            box-shadow: .1rem .2rem .5rem rgba(0, 0, 0, 0.4);

        }

        table {
            border-collapse: collapse;
            text-align: left;
            width: 100%;
            box-shadow: .1rem .2rem .5rem rgba(0, 0, 0, 0.4);

        }

        tr,
        th,
        td {
            border-top: .1rem solid rgba(0, 0, 0, 0.2);
            padding: 1.5rem 1rem;
        }

        .printbtn {
            background-color: var(--blue);
            padding: 1rem 1.5rem;
            cursor: pointer;
            border: none;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .2rem;
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .closebtn {
            background-color: #000;
            padding: 1rem;
            cursor: pointer;
            border: none;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .2rem;
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .btns {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
            width: 100%;
        }

        .printbtn:hover,
        .closebtn:hover {
            opacity: 1;
        }


        @media(max-width:950px) {
            .details {
                width: 100%;
            }
        }

        @media print {
            .heading {
                background: #2597f4;
                color: #fff;
            }
            .head-sidebar,
            .printbtn,
            .closebtn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="content">

        <div class="details">
            <h2 class="heading">Customer Bill</h2>
            <table>
                <tr>
                    <th><b>Customer ID<b></th>
                    <td>
                        <b> <?php if (isset($cid)) echo $cid; ?><b>
                    </td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>
                        <?php if (isset($cname)) echo $cname; ?>
                    </td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>
                        <?php if (isset($cadd)) echo $cadd; ?>
                    </td>
                </tr>
                <tr>
                    <th>Product</th>
                    <td>
                        <?php if (isset($cpname)) echo $cpname; ?>
                    </td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>
                        <?php if (isset($cpquantity)) echo $cpquantity; ?>
                    </td>
                </tr>
                <tr>
                    <th>Price(1)</th>
                    <td>
                        <?php if (isset($cpeach)) echo $cpeach; ?>
                    </td>
                </tr>
                <tr>
                    <th>Total Cost</th>
                    <td>
                        <?php if (isset($cptotal)) echo $cptotal; ?>
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>
                        <?php if (isset($cpdate)) echo $cpdate; ?>
                    </td>
                </tr>
            </table>
            <div class="btns">
                <button type="submit" class="printbtn" name="printbtn" onclick="window.print()">Print</button>
                <button type=" reset" class="closebtn" name="closebtn" onclick="location.href = 'assets.php';">Close</button>
            </div>
        </div>

    </div>



</body>

</html>