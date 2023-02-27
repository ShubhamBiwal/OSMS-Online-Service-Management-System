<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "osms";

//create connection
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
//check connection
if ($conn->connect_error) {
    die("Connection failed");
}
?>
