<?php
$page = "services";
include "../connection.php";
include "include/header-sidebar.php";

$sql = "SELECT * FROM services_tb ORDER BY appliance_name, `service_name`";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);
if ($rows == 0) {
    $msg = "No Service Found";
} else {
    echo '<style>#msg{display:none;}</style>';
}

//delete data
if (isset($_POST['delete-btn'])) {
    $s_id = $_POST['sid'];
    $sql2 = "DELETE FROM services_tb WHERE s_id = '$s_id'";
    $run2 = mysqli_query($conn, $sql2);
    if ($run2) {
        echo '<script>location.href="services.php";</script>';
    } else {
        echo '<script>alert("Unable to Delete!");</script>';
    }
}
//add
if (isset($_POST['uSubmit'])) {
    $a_name = strtolower($_POST['aName']);
    $s_name = strtolower($_POST['sName']);
    $s_price =  $_POST['sPrice'];

    $sqlc = "SELECT * FROM services_tb where appliance_name='$a_name' and `service_name` ='$s_name' ";
    $runc = mysqli_query($conn, $sqlc);

    if (mysqli_num_rows($runc) > 0) {
        echo '<script>alert("Error: Service is Already exist!");</script>';
    } else {
        $sql = "INSERT INTO services_tb (appliance_name, `service_name`, service_price) VALUES('$a_name', '$s_name', '$s_price')";
        $run = mysqli_query($conn, $sql);
        if ($run) {
            echo '<script>alert("Service Added Successfully");</script>';
            echo '<script>location.href = "services.php";</script>';
        } else {
            echo '<script>alert("Unable to Add!");</script>';
        }
    }
}


?>

<head>
    <title>Services</title>
    <style>
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .table {
            box-shadow: 0.4rem 0.4rem 1.6rem rgba(0, 0, 0, 0.3);

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
            text-transform: capitalize;

        }


        .form-btn {
            display: flex;
            flex-direction: row;
            gap: .7rem;
            justify-content: center;
            align-items: center;
        }

        .edit-btn {
            background: #2597f4;
            padding: 1rem;
            color: white;
            cursor: pointer;
            border-radius: .5rem;
        }

        .delete-btn {
            background: gray;
            color: white;
            padding: 1rem;
            cursor: pointer;
            border-radius: .5rem;

        }

        .assign-btn {
            background: green;
            color: white;
            padding: 1rem;
            cursor: pointer;
            border-radius: .5rem;

        }

        .delete-btn:hover {
            background: #333;
        }

        .edit-btn:hover {
            background: #1275c6;
        }

        .add-btn {
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

        .add-btn:hover {
            background: #1275c6;
        }

        #msg {
            text-align: center;
            font-size: 1.7rem;
            padding: 1rem 0;
            font-weight: bold;
            color: var(--blue);
        }

        .overlay {
            top: 0;
            left: 0;
            right: 0;
            height: 100vh;
            width: 100vw;
            background: rgba(0, 0, 0, 0.4);
            position: fixed;
            z-index: 10000;
            display: none;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: auto;
            width: 40%;
            z-index: 2000;
            background-color: #fff;
            box-shadow: 0.4rem 0.4rem 1.4rem rgba(0, 0, 0, 0.8);
            border-radius: 0.5rem;
            padding: 0 1rem;
        }

        .modal-content .container {
            position: relative;
            width: 100%;

        }

        .modal-content .container .form-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-content .form-content .signup-form {
            width: 100%;
            padding: 1rem;
        }

        .modal-content .forms .form-content .title {
            position: relative;
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--black);
            border-left: 0.2rem solid var(--blue);
        }

        .modal-content .forms .form-content .back-btn {
            text-align: right;
        }

        .modal-content .forms .form-content .back-btn i {
            font-size: 3rem;
            font-weight: 600;
            color: #fff;
            padding: 0.5rem 1rem;
            background: var(--blue);
            border-radius: 0.4rem;
            text-align: right;
        }

        .modal-content .forms .form-content .back-btn button {
            background: transparent;
            border: none;
            cursor: pointer;
        }

        .modal-content .forms .form-content .back-btn i:hover {
            color: black;
        }

        .modal-content .forms .form-content .input-boxes {
            margin-top: 2rem;
        }

        .modal-content .forms .form-content .input-box {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: center;
            height: 3rem;
            margin: 4rem 0;
            gap: 2rem;
            position: relative;
        }

        .modal-content .forms .form-content .input-box label {
            font-size: 1.55rem;
            font-weight: 550;
            width: 20%;
        }

        .selectbox {
            text-transform: capitalize;
            outline: none;
            border: none;
            font-size: 1.6rem;
            width: 100%;
            padding: .5rem 0;
            border-bottom: 0.1rem solid rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }

        .modal-content .form-content .input-box input {
            height: 100%;
            width: 100%;
            outline: none;
            border: none;
            font-size: 1.6rem;
            border-bottom: 0.1rem solid rgba(0, 0, 0, 0.2);
            text-transform: capitalize;
        }

        .modal-content .form-content .input-box input[type="date"] {
            text-transform: none;
        }

        .modal-content .form-content .input-box input:focus {
            border-color: var(--black);
        }

        .modal-content .forms .form-content .button {
            color: #fff;
            margin-top: 2.5rem;
            height: 4rem;
        }

        .modal-content .forms .form-content .button input {
            color: #fff;
            background: var(--blue);
            border-radius: 0.4rem;
            cursor: pointer;
            font-size: 1.7rem;
            font-weight: 500;
            letter-spacing: 0.05rem;
            transition: all 0.4s ease;
        }

        .modal-content .forms .form-content .button input:hover {
            background: #1276c8;
        }

        @media (max-width: 850px) {
            .table-data {
                overflow-x: scroll;
            }

            .modal-content {
                width: 90%;
            }

            .modal-content .forms .form-content input {
                margin-bottom: -2rem;
                padding: 0;
            }

            .modal-content .forms .form-content .input-box {
                flex-direction: column;
                gap: .5rem;
            }

            .modal-content .forms .form-content .input-box label {
                width: 100%;
            }
        }

        @media(max-width:750px) {
            .content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<div class="content">
    <span class="add-btn" onclick="open_register_modal()"><i class="fa-solid fa-plus"></i></span>

    <div class="table">

        <div class="heading">
            <p>All Services</p>
        </div>
        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Service ID</th>
                        <th>Appliance Name</th>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                    while ($result = mysqli_fetch_array($run)) {
                        $count++;
                    ?>
                        <tr>
                            <td>
                                <b><?php echo $count; ?></b>
                            </td>
                            <td>
                                <?php echo $result['s_id']; ?>
                            </td>
                            <td>
                                <?php echo $result['appliance_name']; ?>
                            </td>
                            <td>
                                <?php echo $result['service_name']; ?>
                            </td>
                            <td>
                                <?php echo "Rs" . " " . $result['service_price']; ?>
                            </td>

                            <td>
                                <div class="form-btn">
                                    <form action="edit-services.php" method="post">
                                        <input type="hidden" name="sid" value="<?php echo $result['s_id']; ?>">
                                        <button type="submit" name="edit-btn" class="edit-btn"><i class="fa-solid fa-pen"></i></button>
                                    </form>
                                    <form action="" method="post">
                                        <input type="hidden" name="sid" value="<?php echo $result['s_id']; ?>">
                                        <button type="submit" name="delete-btn" class="delete-btn" Onclick="return ConfirmDelete();"><i class="fa-solid fa-trash"></i></button>
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
</div>
<!-- add new user  modal starts -->

<div class="overlay" id="overlay">
    <div class="modal-content">

        <div class="container">
            <div class="forms">
                <div class="form-content">
                    <div class="signup-form">
                        <div class="back-btn"><button onclick="close_register_modal()"><i class="fa-solid fa-xmark"></i></button></div>
                        <div class="title">Add New Service</div>
                        <form action="" method="POST">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <label>Appliance:</label>
                                    <input type="text" name="aName" required>
                                </div>
                                <div class="input-box">
                                    <label>Service:</label>
                                    <select name="sName" id="ss" class="selectbox" required>
                                        <option value="">Select Service</option>
                                        <option value="Installation">Installation</option>
                                        <option value="Maintenance">Maintenance</option>
                                        <option value="Fault Repair">Fault Repair</option>
                                    </select>
                                </div>

                                <div class="input-box">
                                    <label>Price(Rs):</label>
                                    <input type="number" name="sPrice" required>
                                </div>
                                <div class="button input-box">
                                    <input type="submit" value="Submit" name="uSubmit">
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- add new user  modal ends -->

<script>
    function ConfirmDelete() {
        return confirm("Are You Sure to Delete this?");
    }
    //modal
    var modal = document.getElementById("overlay");

    function open_register_modal() {
        modal.style.display = "block";
    }

    function close_register_modal() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>