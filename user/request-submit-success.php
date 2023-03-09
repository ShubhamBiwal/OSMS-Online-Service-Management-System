<?php
include "../connection.php";
include "include/header-sidebar.php";

$userid = $_SESSION['myid'];

$sql = "SELECT * FROM submit_request WHERE request_id = '$userid'";
$run = mysqli_query($conn, $sql);

if ($result = mysqli_fetch_array($run)) {
    $rid = $result['request_id'];
    $rname = $result['requester_name'];
    $remail = $result['requester_email'];
    $rinfo = $result['request_info'];
    $rdesc = $result['request_desc'];
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2597f4">
    <title>Request Success</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
    <!-- external stylesheet -->
    <link rel="stylesheet" href="../css/user-style.css">
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }

        th,
        td {
            text-align: left;
            border-top: .15rem solid rgb(0, 0, 0, 0.2);
        }

        td {
            padding: 1.5rem;
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
            margin-top: 1rem;

        }
        button:hover{
            opacity: 1;
            border: .1rem solid #2597f4;
        }
        @media(max-width:750px){
            table{
                width: 100%;
            }
        }
    </style>
</head>

<body>


    <div class="content">
        <div class="table-data" id="printme">
            <table>
                <tr>
                    <th>Request ID:</th>
                    <td> <?php echo $rid; ?></td>
                </tr>

                <tr>
                    <th>Name:</th>
                    <td> <?php echo $rname; ?></td>
                </tr>
                <tr>
                    <th>Email ID:</th>
                    <td> <?php echo $remail; ?></td>
                </tr>
                <tr>
                    <th>Request Info:</th>
                    <td> <?php echo $rinfo; ?></td>
                </tr>
                <tr>
                    <th>Request Description:</th>
                    <td> <?php echo $rdesc; ?>
                    </td>
                </tr>
            </table>
        </div>
        <button type="submit" name="printbtn" onclick="ContentPrint('printme')">Print</button>
    </div>









    <script>
        function ContentPrint(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
</body>

</html>