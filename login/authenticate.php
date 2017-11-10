<?
// This file includes the Pear:DB script for the GCC database. Only SU has privilage.. Ask Yongwon Lee for assistance.
require('../home/db_connect.php');

/* authentication check script, should be included in EVERY protected page by using-> include('authenticate.php'); on the first line!*/

session_start();

if(!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
	session_unset();   // Unset session variables.
	session_destroy(); // End Session we created earlier.
	header('Location: index.php?url='.$HTTP_SERVER_VARS["REQUEST_URI"]);
}
else {
// remember, $_SESSION['password'] will be encrypted.

	if(!get_magic_quotes_gpc()) {
		$_SESSION['username'] = addslashes($_SESSION['username']);
	}
	// addslashes to session username before using in a query.
	
	$pass = $db_object->query("SELECT user_id, password, type FROM Users WHERE username = '".$_SESSION['username']."'");
	if(DB::isError($pass)) {
		unset($_SESSION['username']);
		unset($_SESSION['password']); // kill incorrect session variables.
		header('Location: index.php?url='.$HTTP_SERVER_VARS["REQUEST_URI"]);
	}
	$db_pass = $pass->fetchRow();
	// now we have encrypted pass from DB in $db_pass['password'], stripslashes() just incase:
	
	$db_pass['password'] = stripslashes($db_pass['password']);
	$_SESSION['password'] = stripslashes($_SESSION['password']);
	//compare:
	
	if($_SESSION['password'] == $db_pass['password']) { // valid password for username
		$_SESSION["user_id"] = $db_pass['user_id'];
		$_SESSION["type"] = $db_pass['type'];
	}
	else {
		unset($_SESSION['username']);
		unset($_SESSION['password']); // kill incorrect session variables.
		header('Location: index.php?url='.$HTTP_SERVER_VARS["REQUEST_URI"]);
	}
}

// clean up
unset($db_pass['password']);
$_SESSION['username'] = stripslashes($_SESSION['username']);
?>
