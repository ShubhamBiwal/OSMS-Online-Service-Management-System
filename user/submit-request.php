<?php
$page = "submitrequest";

include "../connection.php";
include "include/header-sidebar.php";
//show profile data
$uEmail = $_SESSION['is_login'];
$sql  = "SELECT * FROM user_login WHERE u_email = '$uEmail'";
$run = mysqli_query($conn, $sql);
if ($result = mysqli_fetch_array($run)) {
   $uname = $result['u_name'];
   $uadd1 = $result['u_add1'];
   $uadd2 = $result['u_add2'];
   $ucity = $result['u_city'];
   $ustate = $result['u_state'];
   $uzip = $result['u_zip'];
   $umobile = $result['u_mobile'];
}

//insert data
if (isset($_POST['submitbtn'])) {
   $rinfo = $_POST['rinfo'];
   $rdesc = $_POST['rdesc'];
   $rname = $_POST['rname'];
   $raddress1 = $_POST['raddress1'];
   $raddress2 = $_POST['raddress2'];
   $rcity = $_POST['rcity'];
   $rstate = $_POST['rstate'];
   $rzip = $_POST['rzip'];
   $remail = $_POST['remail'];
   $rmobile = $_POST['rmobile'];
   $rdate = date('Y-m-d');

   if ($rinfo == "" || $rdesc == "" || $rname == "" || $raddress1 == "" || $raddress2 == "" || $rcity == "" || $rstate == "" || $rzip == "" || $remail == "" || $rmobile == "" || $rdate == "") {
      echo '<script>alert("All Fields Are Required!");</script>';
   } else {
      //request code
      $r_code = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
      $sql = "INSERT INTO submit_request(request_info, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_zip, requester_email, requester_mobile, request_date, request_code) VALUES ('$rinfo','$rdesc','$rname','$raddress1','$raddress2','$rcity','$rstate','$rzip','$remail','$rmobile','$rdate','$r_code')";
      $run = mysqli_query($conn, $sql);
      if ($run) {
         // $genid = mysqli_insert_id($conn);
         echo '<script>alert("Request Submitted Successfully.");</script>';
         // $_SESSION['myid'] = $genid;
         echo '<script>location.href = "my-requests.php";</script>';
      } else {
         echo '<script>alert("Unable to Submit Your Request.");</script>';
      }
   }
}






?>


<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="theme-color" content="#2597f4">
   <title>Submit Request</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">
   <!-- external stylesheet -->
   <link rel="stylesheet" href="../css/user-style.css">
   <style>
      .container {
         padding: 1.6rem;
         box-shadow: 0.4rem 0.4rem 1rem rgba(0, 0, 0, 0.4);
         width: 100%;
      }

      label {
         font-size: 1.5rem;
         color: var(--black);
      }

      input[type="text"],
      input[type="date"],
      input[type="number"] {
         width: 100%;
         padding: 1rem;
         margin: 1.5rem 0;
         background: #f8f8ff;
         border: .1rem solid rgba(0, 0, 0, 0.05);

      }

      input[type="text"]:focus,
      input[type="number"]:focus {
         outline: .1rem solid rgba(0, 0, 0, 0.4);

      }

      .address,
      .address2,
      .address3 {
         display: flex;
         flex-direction: row;
         gap: 2rem;
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


      .submitbtn {
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
         font-weight: 500;
         box-shadow: .2rem .2rem .5rem rgba(0, 0, 0, 0.5);

      }

      .resetbtn {
         background-color: #000;
         padding: 1rem 0;
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

      .submitbtn:hover,
      .resetbtn:hover {
         opacity: 1;
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
            padding: 2rem;
         }
      }
   </style>
</head>

<body>

   <div class="content">
      <div class="container">
         <form action="" method="post">
            <label for="rinfo"><b>Request Info</b></label>
            <input type="text" name="rinfo" id="rinfo" placeholder="Enter Issue" required>
            <label for="rdesc"><b>Discription</b></label>
            <input type="text" name="rdesc" id="rdesc" placeholder="Write Discription" required>
            <label for="rname"><b>Name</b></label>
            <input type="text" name="rname" id="rname" value="<?php echo $uname; ?>" required>

            <div class="address">
               <div class="inputbox">
                  <label for="raddress1"><b>Address Line 1</b></label>
                  <input type="text" name="raddress1" id="raddress1" placeholder="House No. / Street" value="<?php echo $uadd1; ?>" required>
               </div>
               <div class="inputbox">
                  <label for="raddress2"><b>Address Line 2</b></label>
                  <input type="text" name="raddress2" id="raddress2" placeholder="Area / Villege" value="<?php echo $uadd2; ?>" required>
               </div>
            </div>

            <div class="address2">
               <div class="inputbox2">
                  <label for="rcity"><b>City</b></label>
                  <input type="text" name="rcity" id="rcity" value="<?php echo $ucity; ?>" required>
               </div>
               <div class="inputbox2">
                  <label for="rstate"><b>State</b></label>
                  <input type="text" name="rstate" id="rstate" value="<?php echo $ustate; ?>" required>
               </div>

               <div class="inputbox2">
                  <label for="rzip"><b>Zip</b></label>
                  <input type="number" name="rzip" id="rzip" value="<?php echo $uzip; ?>" required>
               </div>
            </div>
            <div class="address3">
               <div class="inputbox">
                  <label for="remail"><b>Email</b></label>
                  <input type="text" name="remail" id="remail" value="<?php echo $uEmail ?>" required>
               </div>
               <div class="inputbox">

                  <label for="rmobile"><b>Mobile</b></label>
                  <input type="number" name="rmobile" id="rmobile" value="<?php echo $umobile ?>" required>
               </div>

            </div>

            <button type="submit" class="submitbtn" name="submitbtn">Submit</button>
            <button type="reset" class="resetbtn" name="resetbtn">Reset</button>

         </form>
      </div>

   </div>
   <script>
      var zip = document.getElementById("rzip").value;
      var mobile = document.getElementById("rmobile").value;
      if (zip == 0) {
         document.getElementById("rzip").value = "";
      }
      if (mobile == 0) {
         document.getElementById("rmobile").value = "";
      }
   </script>
</body>

</html>