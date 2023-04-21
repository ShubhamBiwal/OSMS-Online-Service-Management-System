<?php
$page = "messages";
include "../connection.php";
include "include/header-sidebar.php";
//php mailer
//send mail function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $areply)
{
    require '../phpmailer/Exception.php';
    require '../phpmailer/PHPMailer.php';
    require '../phpmailer/SMTP.php';

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'shubhambiwal21042003@gmail.com';                     //SMTP username
        $mail->Password   = 'layllemfzdliahlg';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('shubhambiwal21042003@gmail.com', 'OSMS');
        $mail->addAddress($email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Thank you for contacting OSMS.';
        $mail->Body    = "$areply";
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


//for message card
$sql = "SELECT m_id, f_name, m_subject, email, mobile, `message`, m_date FROM messages";
$run = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($run);

if ($rows == 0) {
    $msg = "No Messages";
}


//show data in reply form
if (isset($_POST['view-btn'])) {
    $m_id =  $_POST['m_id'];
    $sql1 = "SELECT * FROM messages WHERE m_id = '$m_id'";
    $run1 = mysqli_query($conn, $sql1);
    $result1 = mysqli_fetch_array($run1);
}
// close btn
if (isset($_POST['close-btn'])) {
    $sql2 = "DELETE FROM messages WHERE m_id = '{$_POST['m_id']}' ";
    $run2 = mysqli_query($conn, $sql2);
    if ($run2) {
        echo "<script> location.href='messages.php';</script>";
    } else {
        echo '<script>alert("Unable to Delete.");</script>';
    }
}
// delete btn
if (isset($_POST['delbtn'])) {
    $sql2 = "DELETE FROM messages WHERE m_id = '{$_POST['mid']}' ";
    $run2 = mysqli_query($conn, $sql2);
    if ($run2) {
        echo "<script> location.href='messages.php';</script>";
    } else {
        echo '<script>alert("Unable to Delete.");</script>';
    }
}


//reply
if (isset($_POST['send-btn'])) {
    $email = $_POST['semail'];
    $mid =  $_POST['mid'];
    $text = $_POST['areply'];
    $areply = nl2br($text);

    if ($mid == "" || $email == "" || $_POST['msub'] == "" || $_POST['msg'] == "" || $areply == "") {
        $_SESSION['status_title'] = "Error!";
        $_SESSION['status_text'] = "All fields are required to filled.";
        $_SESSION['status_icon'] = "info";
    } else {
        if (sendMail($email, $areply)) {
            $sqldel = "DELETE FROM messages WHERE m_id = '$mid' ";
            $rundel  = mysqli_query($conn, $sqldel);
            $_SESSION['status_title'] = "Done";
            $_SESSION['status_text'] = "Message has been sent successfully.";
            $_SESSION['status_icon'] = "success";
        } else {
            $_SESSION['status_title'] = "Error!";
            $_SESSION['status_text'] = "unable to sent message! Something went wrong.";
            $_SESSION['status_icon'] = "error";
        }
    }
}


?>

<head>
    <title>Messages</title>
    <style>
        #msg {
            text-align: center;
            font-size: 1.7rem;
            padding: 1rem 0;
            font-weight: bold;
            color: var(--black);
        }

        .left::-webkit-scrollbar {
            width: .5rem;
        }

        .left::-webkit-scrollbar-track {
            background: lightgray;
        }

        .left::-webkit-scrollbar-thumb {
            background: var(--black);
            border-radius: .5rem;
        }

        .reply::-webkit-scrollbar {
            width: .7rem;
        }

        .reply::-webkit-scrollbar-track {
            background: lightgray;
        }

        .reply-work::-webkit-scrollbar-thumb {
            background: var(--black);
            border-radius: .5rem;
        }

        .outer-box {
            display: flex;
            column-gap: 3rem;
        }

        .left {
            display: flex;
            flex-direction: column;
            width: 40%;
            height: calc(100vh - 15rem);
            overflow-y: scroll;
            padding: 1rem;
            border-top: 1rem solid var(--blue);
            box-shadow: -0.2rem 0.2rem 1rem rgba(0, 0, 0, 0.3);

        }

        .request-card {
            display: flex;
            flex-direction: column;
            width: 100%;
            border: .1rem solid rgb(51, 51, 68, 0.2);
            margin-bottom: 3rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.2);

        }

        .request-card .card-head {
            background: var(--black);
            text-transform: capitalize;
            color: #fff;
            font-size: 1.5rem;
            font-weight: 550;
            padding: 1rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.3);

        }

        .request-card .card-body {
            padding: 1rem;
            line-height: 2;
        }

        .card-body h2,
        p {
            font-size: 1.5rem;
        }

        .view-btn,
        .close-btn {
            margin: 1rem;
            padding: 1rem;
            float: right;
            cursor: pointer;
            border-radius: .2rem;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.2);
            font-weight: 550;
            opacity: .85;
        }

        .view-btn {
            background: var(--blue);
            color: white;
        }

        .close-btn {
            background: #333;
            color: white;
        }

        .view-btn:hover,
        .close-btn:hover {
            opacity: 1;
        }

        .reply {
            border-top: 1rem solid var(--blue);
            width: 60%;
            height: calc(100vh - 15rem);
            overflow-y: scroll;
            box-shadow: -0.2rem 0.2rem 1rem rgba(0, 0, 0, 0.3);
            background: rgb(224, 242, 250);

        }

        .container {
            padding: 1.6rem;
            width: 100%;
            background: rgb(224, 242, 250);
        }

        .container .form-heading {
            text-align: center;
            padding: 1.5rem 0;
        }

        label {
            font-size: 1.5rem;
            color: var(--black);
        }

        input[type="text"],
        input[type="number"] {
            font-size: 1.3rem;
            width: 100%;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.07);
        }

        #areply {
            font-size: 1.5rem;
            width: 100%;
            height: auto;
            padding: 1rem;
            margin: 1.5rem 0;
            background: #f8f8ff;
            border: .1rem solid rgba(0, 0, 0, 0.07);
        }

        #areply:focus {
            outline: .1rem solid rgba(0, 0, 0, 0.3);

        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: .1rem solid rgba(0, 0, 0, 0.3);

        }

        .inputbox {
            width: 50%;
        }

        .inputbox2 {
            width: 33%;
        }

        input::-webkit-inner-spin-button {
            display: none;
        }

        .buttons {
            display: flex;
            justify-content: flex-end;
        }

        .sendbtn {
            background-color: var(--blue);
            padding: 1rem 0;
            margin: 1rem 0;
            cursor: pointer;
            border: none;
            width: 10rem;
            opacity: 0.8;
            color: white;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: 0.1rem;
            border-radius: .5rem;
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .resetbtn {
            background-color: #000;
            padding: 1rem 0;
            margin: 1rem 0 1rem 2rem;
            cursor: pointer;
            border: none;
            width: 10rem;
            opacity: 0.8;
            color: white;
            font-size: 1.6rem;
            letter-spacing: 0.1rem;
            border-radius: .5rem;
            font-weight: 500;
            box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

        }

        .sendbtn:hover,
        .resetbtn:hover {
            opacity: 1;
        }

        @media (max-width: 950px) {
            .outer-box {
                flex-direction: column;
                row-gap: 3rem;
                height: calc(100vh - 15rem);
            }

            .left {
                width: 100%;
                height: 40%;

            }

            .reply {
                width: 100%;
                height: 60%;
            }

        }



        @media (max-width: 750px) {

            .address,
            .address2,
            .address3 {
                flex-direction: column;
            }

            .inputbox,
            .inputbox2 {
                width: 100%;
            }

            .content {
                padding: 1.5rem;
            }

        }
    </style>
</head>
<div class="content">

    <div class="outer-box">
        <div class="left">

            <?php while ($result = mysqli_fetch_array($run)) {
            ?>
                <div class="request-card">
                    <div class="card-head">
                        <p>Msg ID:
                            <?php echo $result['m_id']; ?>
                        </p>
                    </div>
                    <div class="card-body">

                        <p><b>Name :</b>
                            <?php echo $result['f_name']; ?>
                        </p>
                        <p><b>Email :</b>
                            <?php echo $result['email']; ?>
                        </p>

                        <p class="request-desc"><b>Mobile No:</b>
                            <?php echo $result['mobile']; ?>
                        </p>
                        <p><b>Subject :</b>
                            <?php echo $result['m_subject']; ?>
                        </p>
                        <p><b>Date:</b>
                            <?php echo date("j-n-Y", strtotime($result['m_date'])); ?>
                        </p>
                        <form action="" method="post">
                            <input type="hidden" name="m_id" value="<?php echo $result['m_id']; ?>">
                            <input type="submit" name="close-btn" class="close-btn" value="Close" onclick="return confirmation();">
                            <input type="submit" name="view-btn" class="view-btn" value="View & Reply">
                        </form>

                    </div>
                </div>
            <?php } ?>
            <div id="msg"><?php if (isset($msg)) echo $msg; ?></div>

        </div>

        <div class="reply">
            <div class="container">

                <h1 class="form-heading">View & Reply</h1>
                <form action="" method="post">
                    <label for="mid"><b>Message ID</b></label>
                    <input type="number" name="mid" id="mid" value="<?php if (isset($result1['m_id'])) echo $result1['m_id']; ?>" readonly required>
                    <label for="semail"><b>Email</b></label>
                    <input type="text" name="semail" id="semail" value="<?php if (isset($result1['email'])) echo $result1['email']; ?>" readonly required>
                    <label for="msub"><b>Subject</b></label>
                    <input type="text" name="msub" id="msub" value="<?php if (isset($result1['m_subject'])) echo $result1['m_subject']; ?>" readonly required>

                    <label for="msg"><b>Message</b></label>
                    <input type="text" name="msg" id="message" value="<?php if (isset($result1['message'])) echo $result1['message']; ?>" required readonly>
                    <label for="areply"><b>Reply</b></label>
                    <textarea name="areply" id="areply" rows="5" placeholder="Enter Message" required></textarea>

                    <div class="buttons">
                        <button type="submit" class="sendbtn" name="send-btn"><i class="fa-solid fa-paper-plane"></i> Send</button>
                        <button type="reset" class="resetbtn"><i class="fa-solid fa-rotate"></i> Reset</button>
                    </div>

                </form>

            </div>

        </div>
    </div>


</div>
<script>
    function confirmation() {
        return confirm("Are Your Sure to Delete?");
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
            text: '<?php echo $_SESSION['status_text'] ?>',
            confirmButtonColor: '#2597f4',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                location.href = location.href
            }
        });
    </script>
<?php
    unset($_SESSION['status_title']);
}
?>