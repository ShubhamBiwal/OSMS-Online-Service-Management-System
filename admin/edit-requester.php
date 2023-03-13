<?php
include "../connection.php";
include "include/header-sidebar.php";

if (isset($_POST['edit-btn'])) {
    $rid = $_POST['uid'];

    $sql = "SELECT * FROM user_login WHERE u_id = '$rid' ";
    $run = mysqli_query($conn, $sql);
    if ($result = mysqli_fetch_array($run)) {
        $r_id = $result['u_id'];
        $r_name = $result['u_name'];
        $r_email = $result['u_email'];
    }
}
//upadate data
if(isset($_POST['updatebtn'])){
    $uid = $_POST['rid'];
    $uname = $_POST['rname'];
    $uemail = $_POST['remail'];
    if($uid == "" || $uname == "" || $uemail == ""){
        echo '<script> alert("Error: All Fields are Required.");</script>';
    }
    else{
        $sql = "UPDATE user_login SET u_name= '$uname', u_email = '$uemail' WHERE u_id ='$uid' ";
        $run = mysqli_query($conn, $sql);
        if($run){
            echo '<script> alert("Data Updated Successfully.");</script>';
            echo '<script>location.href="requester.php";</script>';

        }
        else{
            echo '<script> alert("Error: Unable to Update!");</script>';

        }
    }
}
?>

<head>
    <title>Edit Requester</title>
    <style>
        .container {
            padding: 1.6rem;
            box-shadow: 0.4rem 0.4rem 1rem rgba(0, 0, 0, 0.4);
            width: 70%;
        }

        .container .heading {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem 0;
            font-size: 1.5rem;
        }

        label {
            font-size: 1.5rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f4f4f4;
            border: none;
        }

        input[type="text"]:focus {
            outline: none;
        }

        #rid {
            background: #dfdfdf;
        }

        .updatebtn {
            background-color: var(--blue);
            padding: 1rem 0;
            margin: 0.8rem 0;
            cursor: pointer;
            border: none;
            width: 12rem;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .2rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);
        }

        .closebtn {
            background-color: #000;
            padding: 1rem;
            margin: 0.8rem 0 0.8rem 2rem;
            cursor: pointer;
            border: none;
            width: 12rem;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .2rem;
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .updatebtn:hover,
        .closebtn:hover {
            opacity: 1;
        }

        .updatebtn:hover {
            opacity: 1;
        }

        @media(max-width:750px) {
            .container {
                width: 100%;
            }
        }
    </style>
</head>
<div class="content">
    <div class="container">
        <div class="heading">
            <h2>Update Requester Details</h2>
        </div>
        <form action="" method="post">
            <label for="rid"><b>Requester ID</b></label>
            <input type="text" name="rid" id="rid" value="<?php if (isset($r_id)) echo $r_id; ?>" readonly>
            <label for="rname"><b>Name</b></label>
            <input type="text" name="rname" id="rname" value="<?php if (isset($r_name)) echo $r_name; ?>">
            <label for="remail"><b>Email</b></label>
            <input type="text" name="remail" id="remail" value="<?php if (isset($r_email)) echo $r_email; ?>">
            <button type="submit" class="updatebtn" name="updatebtn">Update</button>
            <a href="requester.php" class="closebtn" name="closebtn">Close</a>

        </form>
    </div>

</div>