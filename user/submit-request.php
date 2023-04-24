<?php
$page = "submitrequest";

include "../connection.php";
include "include/header-sidebar.php";
//show profile data
$uEmail = $_SESSION['is_login'];
$uid = $_SESSION['u_id'];
$sql  = "SELECT * FROM user_login WHERE u_id = '$uid'";
$run = mysqli_query($conn, $sql);
if ($result = mysqli_fetch_array($run)) {
   $uname = $result['u_name'];
   $umobile = $result['u_mobile'];
}
//show service info
$sqls = "SELECT DISTINCT(appliance_name) FROM services_tb ORDER BY appliance_name";
$runs = mysqli_query($conn, $sqls);

//insert data
if (isset($_POST['submitbtn'])) {
   $sa = strtolower($_POST['sa']);
   $ss = strtolower($_POST['ss']);
   $rdesc = $_POST['rdesc'];
   $rstate = $_POST['rstate'];
   $rcity = $_POST['rcity'];
   $raddress1 = $_POST['raddress1'];
   $raddress2 = $_POST['raddress2'];
   $rmobile = $_POST['rmobile'];
   $ramobile = $_POST['ramobile'];
   $rdate = date('Y-m-d');

   if ($sa == "" || $ss == "" || $rdesc == "" || $rstate == "" || $rcity == "" || $raddress1 == "" || $raddress2 == "" || $rmobile == "") {
      echo '<script>alert("All Fields Are Required!");</script>';
   } else {
      //request code
      $sqlp = "SELECT service_price FROM services_tb WHERE appliance_name = '$sa' AND `service_name`='$ss'";
      $runp = mysqli_query($conn, $sqlp);
      if ($resultp = mysqli_fetch_array($runp)) {
         $sprice = $resultp['service_price'];
         $r_code = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
         $sql = "INSERT INTO requests_tb(u_id, s_appliance, s_service, request_desc, requester_name, requester_add1, requester_add2, requester_city, requester_state, requester_email, requester_mobile, requester_alt_mobile, request_date, s_price, request_code, r_status) VALUES('$uid','$sa', '$ss', '$rdesc','$uname','$raddress1','$raddress2','$rcity','$rstate','$uEmail','$rmobile','$ramobile','$rdate','$sprice','$r_code', '1')";
         $run = mysqli_query($conn, $sql);
         if ($run) {
            $_SESSION['status_title'] = "Success";
            $_SESSION['status_text'] = "Your request has been submitted.";
            $_SESSION['status_icon'] = "success";
         } else {
            echo '<script>alert("Unable to Submit Your Request.");</script>';
         }
      } else {
         $_SESSION['status_title2'] = "Oops!";
         $_SESSION['status_text2'] = "This service is not available.";
         $_SESSION['status_icon2'] = "info";
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
      input::-webkit-inner-spin-button {
         display: none;
      }

      .container {
         padding: 1.6rem;
         box-shadow: 0.4rem 0.4rem 1rem rgba(0, 0, 0, 0.4);
         width: 100%;
      }

      label {
         font-size: 1.7rem;
         color: var(--black);
      }

      input[type="text"],
      input[type="number"] {
         text-transform: capitalize;
         width: 100%;
         padding: 1rem;
         margin: 1.5rem 0;
         background: #f8f8ff;
         border: .1rem solid rgba(0, 0, 0, 0.05);
         font-size: 1.4rem;

      }

      input[type="text"]:focus,
      input[type="number"]:focus,
      .container .selectbox:focus {
         outline: .1rem solid rgba(0, 0, 0, 0.4);

      }

      .input-container {
         display: flex;
         flex-direction: row;
         column-gap: 2rem;
      }

      .inputbox {
         width: 50%;
      }

      .container .selectbox {
         text-transform: capitalize;
         font-size: 1.5rem;
         width: 100%;
         margin: 1.5rem 0;
         padding: 1rem;
         background: #f8f8ff;
         border: .1rem solid rgba(0, 0, 0, 0.05);
         cursor: pointer;
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

      .required::after {
         content: " *";
         color: red;
         font-weight: bolder;
      }

      @media (max-width:750px) {

         .input-container {
            flex-direction: column;
            column-gap: 0;
         }

         .inputbox {
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
            <label for="sinfo" class="required"><b>Service Info</b></label>
            <div class="input-container">
               <div class="inputbox">
                  <select name="sa" id="sa" class="selectbox" required>
                     <option value="">Select Appliance</option>
                     <?php while ($results = mysqli_fetch_array($runs)) { ?>
                        <option value="<?php echo $results['appliance_name']; ?>"><?php echo $results['appliance_name']; ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="inputbox">
                  <select name="ss" id="ss" class="selectbox" required>
                     <option value="">Select Service</option>
                     <option value="Fault Repair">Fault Repair</option>
                     <option value="Installation">Installation</option>
                     <option value="Maintenance">Maintenance</option>
                  </select>
               </div>
            </div>

            <label for="rdesc" class="required"><b>Discription</b></label>
            <input type="text" name="rdesc" id="rdesc" placeholder="Write Discription" required>

            <div class="input-container">
               <div class="inputbox">
                  <label for="rstate" class="required"><b>State</b></label>
                  <select name="rstate" id="" class="selectbox" required>
                     <option value="Rajasthan">Rajasthan</option>
                  </select>
               </div>
               <div class="inputbox">
                  <label for="rcity" class="required"><b>City</b></label>
                  <select name="rcity" id="" class="selectbox" required>
                     <option value="Pilani">Pilani</option>
                  </select>
               </div>
            </div>
            <div class="input-container">
               <div class="inputbox">
                  <label for="raddress1" class="required"><b>Address Line 1</b></label>
                  <input type="text" name="raddress1" id="raddress1" placeholder="House No. / Street" value="" required>
               </div>
               <div class="inputbox">
                  <label for="raddress2" class="required"><b>Address Line 2</b></label>
                  <input type="text" name="raddress2" id="raddress2" placeholder="Landmark / Area" value="" required>
               </div>
            </div>

            <div class="input-container">
               <div class="inputbox">
                  <label for="rmobile" class="required"><b>Mobile No.</b></label>
                  <input type="number" name="rmobile" id="rmobile" value="<?php echo $umobile; ?>" placeholder="Enter Mobile Number" required>
               </div>
               <div class="inputbox">
                  <label for="ramobile"><b>Alternate Contact</b></label>
                  <input type="number" name="ramobile" id="ramobile" value="" placeholder="Alternate Mobile Number">
               </div>

            </div>

            <button type="submit" class="submitbtn" name="submitbtn">Submit</button>
            <button type="reset" class="resetbtn" name="resetbtn">Reset</button>

         </form>
      </div>

   </div>



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
               location.href = 'my-requests.php'
            }
         });
      </script>
   <?php
      unset($_SESSION['status_title']);
   }
   ?>
   <!-- sweet alert js2 -->
   <?php
   if (isset($_SESSION['status_title2']) && $_SESSION['status_title2'] != '') {
   ?>
      <script>
         Swal.fire({
            icon: '<?php echo $_SESSION['status_icon2'] ?>',
            title: '<?php echo $_SESSION['status_title2'] ?>',
            text: '<?php echo $_SESSION['status_text2'] ?>',
            confirmButtonColor: '#2597f4',
            confirmButtonText: 'OK'
         })
      </script>
   <?php
      unset($_SESSION['status_title2']);
   }
   ?>

</body>

</html>