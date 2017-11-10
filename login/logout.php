<?php
include('authenticate.php');
unset($_SESSION['username']);
unset($_SESSION['password']); // kill session variables
$_SESSION = array(); // reset session array
session_destroy();   // destroy session.
header('Location: thankyou.php?status=ok&activity=logout');
?>