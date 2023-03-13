<?php
include "../connection.php";
include "include/header-sidebar.php";

$sql = "SELECT * FROM user_login";
$run = mysqli_query($conn, $sql);
//delete data
if (isset($_POST['delete-btn'])) {
    $u_id = $_POST['uid'];
    $sql2 = "DELETE FROM user_login WHERE u_id = '$u_id'";
    $run2 = mysqli_query($conn, $sql2);
    if($run2){
        echo '<script>location.href="requester.php";</script>';
    }
    else{
        echo '<script>alert("Unable to Delete!");</script>';

    }
}
?>

<head>
    <title>Requesters</title>
    <style>
        .container {
            box-shadow: 0.4rem 0.4rem 1.6rem rgba(0, 0, 0, 0.3);

        }

        .container .heading {
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

        .form-btn {
            display: flex;
            flex-direction: row;
            gap: 1.5rem;
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
        .add-btn:hover{
            background: #1275c6;
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
  width: 50vw;
  z-index: 2000;
  background-color: #fff;
  box-shadow: 0.4rem 0.4rem 1.4rem rgba(0, 0, 0, 0.8);
  border-radius: 0.5rem;
  padding: 1rem;
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
  height: 3rem;
  width: 100%;
  margin: 4rem 0;
  position: relative;
}

.modal-content .form-content .input-box input {
  height: 100%;
  width: 100%;
  outline: none;
  border: none;
  padding: 0 3rem;
  font-size: 1.6rem;
  border-bottom: 0.1rem solid rgba(0, 0, 0, 0.2);
  transition: all 0.3s ease;
}

.modal-content .form-content .input-box input:focus {
  border-color: var(--black);
}

.modal-content .form-content .input-box i {
  position: absolute;
  color: var(--blue);
  font-size: 1.6rem;
}

.modal-content .forms .form-content .text {
  font-size: 1rem;
  font-weight: 500;
  color: #333;
}

.modal-content .forms .form-content .text button {
  text-decoration: none;
  color: var(--blue);
  background: transparent;
  cursor: pointer;
  font-size: 1.7rem;
}

.modal-content .forms .form-content .text button:hover {
  text-decoration: underline;
}

.modal-content .forms .form-content .button {
  color: #fff;
  margin-top: 2.5rem;
  height: 5rem;
}

.modal-content .forms .form-content .button input {
  color: #fff;
  background: var(--blue);
  border-radius: 0.4rem;
  cursor: pointer;
  font-size: 2rem;
  font-weight: 500;
  letter-spacing: 0.05rem;
  transition: all 0.4s ease;
}

.modal-content .forms .form-content .button input:hover {
  background: #1276c8;
}

.modal-content .forms .form-content .sign-up-text {
  text-align: center;
  margin: 1.5rem 0;
  font-size: 1.7rem;
}


        @media (max-width: 850px) {
            .table-data {
                overflow-x: scroll;
            }
        }
    </style>
</head>
<div class="content">
    <span class="add-btn" onclick="open_register_modal()"><i class="fa-solid fa-plus"></i></span>

    <div class="container">

        <div class="heading">
            <p>List of Requesters</p>
        </div>
        <div class="table-data">
            <table>
                <thead>
                    <tr>
                        <th>Requester ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($result = mysqli_fetch_array($run)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $result['u_id']; ?>
                        </td>
                        <td>
                            <?php echo $result['u_name']; ?>
                        </td>
                        <td>
                            <?php echo $result['u_email']; ?>
                        </td>
                        <td>
                            <div class="form-btn">
                                <form action="edit-requester.php" method="post">
                                    <input type="hidden" name="uid" value="<?php echo $result['u_id']; ?>">
                                    <button type="submit" name="edit-btn" class="edit-btn"><i
                                            class="fa-solid fa-pen"></i></button>
                                </form>
                                <form action="" method="post">
                                    <input type="hidden" name="uid" value="<?php echo $result['u_id']; ?>">
                                    <button type="submit" name="delete-btn" class="delete-btn"
                                        Onclick="return ConfirmDelete();"><i class="fa-solid fa-trash"></i></button>
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
<!-- add new user  modal starts -->

<div class="overlay" id="overlay">
    <div class="modal-content">

        <div class="container">
            <div class="forms">
                <div class="form-content">
                    <div class="signup-form">
                        <div class="back-btn"><button onclick="close_register_modal()"><i
                                    class="fa-solid fa-xmark"></i></button></div>
                        <div class="title">Create Account</div>
                        <form action="" method="POST">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <i class="fas fa-user"></i>
                                    <input type="text" placeholder="Name" name="uName" required>
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" placeholder="Email" name="uEmail" required>
                                </div>
                                <div class="input-box">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" placeholder="Password" name="uPassword" required>
                                </div>
                                <div class="button input-box">
                                    <input type="submit" value="Sign Up" name="uSignup">
                                </div>
                                <div class="text sign-up-text">Already have an account? <button
                                        onclick="login_here()">Login here</button>
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
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
</script>