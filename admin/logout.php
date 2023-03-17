<?php
$page = "logout";

session_start();
session_unset();
session_destroy();

echo '<script>location.href = "/osms/admin";</script>';
?>