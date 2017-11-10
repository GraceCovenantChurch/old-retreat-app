<?php
include('../home/db_connect.php');

session_start();

if($_POST) { // if form has NOT been submitted
  $target_url = $_POST['url'];
}else{
  $target_url = $_REQUEST['url'];
}

if(isset($_POST['Submit'])) { // if form has been submitted
  /* check they filled in what they were supposed to and authenticate */
  if(!$_POST['username'] | !$_POST['password']) {
    die('You didn\'t fill in a required field.');
  }
					      
  // authenticate.
  if(!get_magic_quotes_gpc()) {
    $_POST['username'] = addslashes($_POST['username']);		
  }
											       
  $userpass = "SELECT user_id,username, password FROM Users WHERE username = '".$_POST['username']."'";
  $check = $db_object->query($userpass);
  if(DB::isError($check)) {
    $result = 0;
    $insert = "INSERT INTO Log (result, ip, username, password, referer, browser) VALUES ('$result','".$HTTP_SERVER_VARS['REMOTE_ADDR']."', '".$_POST['username']."', '".$_POST['password']."', '".$HTTP_SERVER_VARS['HTTP_REFERER']."', '".$HTTP_SERVER_VARS['HTTP_USER_AGENT']."')";
    $add_log = $db_object->query($insert);
    if(DB::isError($add_log)) {
      die($add_log->getMessage());
    }
    die('That username doesn\'t exist in our database.');
  }
  $info = $check->fetchRow();

// check passwords match
  $_POST['password'] = stripslashes($_POST['password']);
  $info['password'] = stripslashes($info['password']);
  $_POST['password'] = md5($_POST['password']);
  if($_POST['password'] != $info['password']) {
    $result = 1;
    $insert = "INSERT INTO Log (result, ip, username, password, referer, browser) VALUES ('$result','".$HTTP_SERVER_VARS['REMOTE_ADDR']."', '".$_POST['username']."', '".$_POST['password']."', '".$HTTP_SERVER_VARS['HTTP_REFERER']."', '".$HTTP_SERVER_VARS['HTTP_USER_AGENT']."')";
    $add_log = $db_object->query($insert);
    if(DB::isError($add_log)) {
      die($add_log->getMessage());
    }
    die('Incorrect password, please try again.');
  }

  $_POST['username'] = stripslashes($_POST['username']);
  $_SESSION['user_id'] = $info['user_id'];
  $_SESSION['username'] = $_POST['username'];
  $_SESSION['password'] = $_POST['password'];

// log this login attempt
  $result = 2;
  $insert = "INSERT INTO Log (result, ip, username, password, referer, browser) VALUES ('$result','".$HTTP_SERVER_VARS['REMOTE_ADDR']."', '".$_POST['username']."', '".$_POST['password']."', '".$HTTP_SERVER_VARS['HTTP_REFERER']."', '".$HTTP_SERVER_VARS['HTTP_USER_AGENT']."')";
  $add_log = $db_object->query($insert);
  if(DB::isError($add_log)) {
    die($add_log->getMessage());
  }
  $db_object->disconnect();

  if ($target_url == NULL){
    header('Location: main.php');
  }else{
    header('Location: '.$target_url);
  }
}
else {	// if form hasn't been submitted
  ?>

  <HTML>
    <head>
    <title>Grace Covenant Church - University City, Philadelphia PA</title>
    <link rel="stylesheet" type="text/css" href="/style.css" />
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
    <script language="JavaScript" src="/menu.js"></script>
  </head>

  <?php include('../header.html'); ?>
  <?php include('./sidebar.html'); ?>

  <table width="100%" height="100%" cellspacing="8">
    <tr><td>
	<?php
	   if ($target_url){
	   echo "The specific document you requested requires you to LOGIN. Once you login, you will be forwarded to your original destination.";
	   }
	   ?>
	<form action="/login/index.php" method="post"><div align="center">
	  <?php 
	     include('../subbox.php');
	     start_subbox('250','orange','Please log in','center','left','');
	     ?>
	  <table><tr>
	      <td>username: </td>
	      <td><input name="username" type="text" id="username3" size="16" maxlength="16"></td>
	    </tr><tr>
	      <td>password: </td>
	      <td><input name="password" type="password" id="password3" size="16" maxlength="16"></td>
	    </tr><tr>
	      <td colspan="2">
		<input name="url" type="hidden" id="url" value="<?=$target_url?>">
		<input name="Submit" type="submit" value="login!">
	  </td></tr></table>
	  <?php end_subbox('orange',''); ?>
	</div></form>
    </td></tr>
    <tr><td>
	<ul>
	  <li><a href="/login/explain.php">What is this?</a></li>
	  <li><a href="/login/newuser.php">Create a Login!</a></li>
	  <li><a href="mailto:jyjin@alumni.upenn.edu">Lost passwords?</a></li>
	</ul>
	<br><br>
      </td>
    </tr>
  </table>
  <?php
     } // if form hasn't been submitted
  ?>

  <?php include('../footer.html'); ?>

