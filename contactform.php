 <?php
    include "connection.php";

    //php mailer
    //send mail function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    function sendMail($fname, $subject, $semail, $smobile, $message)
    {
        require 'phpmailer/Exception.php';
        require 'phpmailer/PHPMailer.php';
        require 'phpmailer/SMTP.php';

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
            $mail->addAddress('shubhambiwal21042003@gmail.com');     //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'New Submission Contact Us Form - OSMS';
            $mail->Body    = "<b>Subject: $subject</b><br><br>$message<br><br>Name: $fname<br>Email: $semail<br>Mobile: $smobile";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    //message send
    if (isset($_POST['sendbtn'])) {
        $fname = $_POST['f_name'];
        $subject = $_POST['sub'];
        $semail = strtolower(trim($_POST['semail']));
        $smobile = $_POST['smobile'];
        $message = $_POST['message'];
        date_default_timezone_set("Asia/Kolkata");
        $mdate = date("Y-m-d");
        if ($fname == "" || $subject == "" || $semail == "" || $smobile == "" | $message == "") {
            $_SESSION['status_title'] = "Oops...";
            $_SESSION['status_text'] = "All fields are required to be filled.";
            $_SESSION['status_icon'] = "info";
            echo '<script>location.href ="#contact"</script>';
        } else {
            $sql = "INSERT INTO messages(`f_name`, `m_subject`, `email`, `mobile`, `message`, `m_date`) VALUES ('$fname','$subject','$semail','$smobile','$message','$mdate')";
            $run = mysqli_query($conn, $sql);
            if ($run && sendMail($fname, $subject, $semail, $smobile, $message)) {
                $_SESSION['status_title'] = "Good job!";
                $_SESSION['status_text'] = "Thank you for your message. It has been sent.";
                $_SESSION['status_icon'] = "success";
            } else {
                $_SESSION['status_title'] = "Error!";
                $_SESSION['status_text'] = "Unable to send message. Something went wrong!!";
                $_SESSION['status_icon'] = "error";
            }
        }
    }

    ?>

 <style>
     #msg {
         color: red;
         font-size: 1.5rem;
         font-weight: 550;
     }
 </style>
 <form action="" method="post">
     <h3>get in touch</h3>
     <p id="msg"><?php if (isset($msg)) echo $msg; ?></p>
     <div class="inputBox">
         <input type="text" placeholder="Full Name" name="f_name" required>
         <input type="text" placeholder="Subject" name="sub" required>
     </div>
     <div class="inputBox">
         <input type="email" placeholder="Email" name="semail" required>
         <input type="number" placeholder="Mobile" name="smobile" required>
     </div>
     <textarea name="message" placeholder="Message" id="" cols="30" rows="10" required></textarea>
     <input type="submit" value="send message" class="btn" name="sendbtn">
 </form>
 <!-- sweet alert -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
         })
     </script>
 <?php
        unset($_SESSION['status_title']);
    }
    ?>