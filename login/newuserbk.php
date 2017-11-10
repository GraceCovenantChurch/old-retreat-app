<?php
include('../php/includes/db_connect.php');	// authentication script.
if(isset($_POST['submit'])) { // if form has been submitted
	/* check they filled in what they supposed to, passwords matched, username
	isn't already taken, etc. */
	if(!$_POST['fname'] | !$_POST['lname'] | !$_POST['email'] |
		!$_POST['gender']) {
		die('You didn\'t fill in a required field.');
	}
	
	$_POST['fname'] = ucfirst(addslashes($_POST['fname']));
	$_POST['lname'] = ucfirst(addslashes($_POST['lname']));
	
	// check if username exists in database.
	if(!get_magic_quotes_gpc()) {
		$_POST['username'] = addslashes($_POST['username']);
	}
	if(strlen($_POST['username'])<4 ) {
		die('Sorry, your password must be 4 letter/digits or longer');
	}
	$name_check = $db_object->query("SELECT username FROM Users WHERE username = '".$_POST['username']."'");
	if(DB::isError($name_check)) {
		die($name_check->getMessage());
	}
	$name_checkk = $name_check->numRows();
	if($name_checkk != 0) {
		die('Sorry, the username: <strong>'.$_POST['username'].'</strong> is already taken, please pick another one.');
	}
	// check passwords match
	if($_POST['password'] != $_POST['password_again']) {
		die('Sorry your password and confirmation password did not match, please try again.');
	}
	if($_POST['password'] && strlen($_POST['password'])<4 ) {
		die('Sorry, your password must be 4 letter/digits or longer');
	}	
	
	// check e-mail format
	if(!preg_match("/.*\@.*\..*/", $_POST['email']) | preg_match("/(\<|\>)/", $_POST['email'])) {
		die('Sorry the e-mail address you submitted was of invalid format.');
	}
	
	// no HTML tags in username, website, location, password
	if(preg_match("/(\<|\>)/", $_POST['password'])
	| preg_match("/(\<|\>)/", $_POST['email'])
	| preg_match("/(\<|\>)/", $_POST['fname'])
	| preg_match("/(\<|\>)/", $_POST['lname'])
	| preg_match("/(\<|\>)/", $_POST['dob'])
	| preg_match("/(\<|\>)/", $_POST['im'])
	| preg_match("/(\<|\>)/", $_POST['hphone'])
	| preg_match("/(\<|\>)/", $_POST['cphone'])
	| preg_match("/(\<|\>)/", $_POST['wphone'])
	| preg_match("/(\<|\>)/", $_POST['address'])
	| preg_match("/(\<|\>)/", $_POST['city'])
	| preg_match("/(\<|\>)/", $_POST['state'])
	| preg_match("/(\<|\>)/", $_POST['zip'])
	| preg_match("/(\<|\>)/", $_POST['work'])
	| preg_match("/(\<|\>)/", $_POST['school'])
	| preg_match("/(\<|\>)/", $_POST['share'])
	){
		die('Invalid input, no HTML tags are allowed.');
	}
	
// correct phone number format
        $ppatterns = array
("/(\d{3})(\d{3})(\d{4})(\z)/","/(\d{3})(\D{1,})(\d{3})(\D{1,})(\d{4})(\z)/",
"/(\D{1,})(\d{3})(\D{1,})(\d{3})(\D{1,})(\d{4})(\z)/");
        $preplace = array ("(\\1) \\2-\\3","(\\1) \\3-\\5","(\\2)
\\4-\\6");
        if($_POST['weirdphone']=="yes") {
                $hphone = addslashes($_POST['hphone']);
        }else{
                $hphone = preg_replace ($ppatterns, $preplace,
$_POST['hphone']);
        }
        $cphone = preg_replace ($ppatterns, $preplace, $_POST['cphone']);
        $wphone = preg_replace ($ppatterns, $preplace, $_POST['wphone']);
        // correct bithday format
        $dpattern = array
("/(\d{2})(\d{2})(\d{4})(\z)/","/(\d{2})(\d{2})(\d{2})(\z)/",
"/(\d{2})(\D{1,})(\d{2})(\D{1,})(\d{2})(\z)/",
"/(\d{2})(\D{1,})(\d{2})(\D{1,})(\d{4})(\z)/");
        $dreplace = array
("\\1/\\2/\\3","\\1/\\2/19\\3","\\1/\\3/19\\5","\\1/\\3/\\5");
        $dob = preg_replace ($dpattern, $dreplace, $_POST['dob']);
        // correct im format
        $im = preg_replace ("(\s{1,})","", $_POST['im']);
        // correct class (convert 2 digit year format to 4 digit)
        $class = preg_replace ("(\D{1,})","", $_POST['class']);
        if (strlen($class) <= 2){
                if ($class > 50){
                        $class = preg_replace ("/(\d{2})/","19\\1", 
$class);
                }
        }
	// check sharing information
	$share = 0;
	if($_POST['sharedob']=="yes") {
		$share = 1;
	}
	if($_POST['sharecontact']=="yes") {
		$share = $share+10;
	}
	if($_POST['shareetc']=="yes") {
		$share = $share+100;
	}
	$gender = $_POST['gender'];
	$youngadult = $_POST['youngadult'];
	// now we can add them to the database.
	// encrypt password
	$_POST['password'] = md5($_POST['password']);
	if(!get_magic_quotes_gpc()) {
		$_POST['email'] = addslashes($_POST['email']);
		$_POST['fname'] = addslashes($_POST['fname']);
		$_POST['lname'] = addslashes($_POST['lname']);
		$_POST['address'] = addslashes($_POST['address']);
		$_POST['city'] = addslashes($_POST['city']);
		$_POST['state'] = addslashes($_POST['state']);
		$_POST['zip'] = addslashes($_POST['zip']);
		$_POST['work'] = addslashes($_POST['work']);
		$_POST['school'] = addslashes($_POST['school']);
		$_POST['share'] = addslashes($_POST['share']);
	}
	
	if($youngadult != NULL) {
	$insert = "INSERT INTO Users (username, password, fname, lname, email, im, hphone, cphone, wphone, dob, address, city, state, zip, work, school, class, share, gender, youngadult) VALUES ('".$_POST['username']."', '".$_POST['password']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['email']."','".$_POST['im']."','".$hphone."', '".$cphone."', '".$wphone."', '".$dob."', '".$_POST['address']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['zip']."', '".$_POST['work']."', '".$_POST['school']."', '".$class."', '".$share."', ".$gender.", ".$youngadult.")";
	}
	
	else
         $insert = "INSERT INTO Users (username, password, fname, lname, email, im, hphone, cphone, wphone, dob, address, city, state, zip, work, school, class, share, gender) VALUES ('".$_POST['username']."', '".$_POST['password']."','".$_POST['fname']."','".$_POST['lname']."','".$_POST['email']."','".$_POST['im']."','".$hphone."', '".$cphone."', '".$wphone."', '".$dob."', '".$_POST['address']."', '".$_POST['city']."', '".$_POST['state']."', '".$_POST['zip']."', '".$_POST['work']."', '".$_POST['school']."', '".$class."', '".$share."', ".$gender.")";
	$add_user = $db_object->query($insert);
	if(DB::isError($add_user)) {
		die($add_user->getMessage());
	}
				$query = "SELECT * FROM Users WHERE username = '".$_POST['username']."'";
				$info = $db_object->query($query);
				if(DB::isError($info)) {
					die($info->getMessage());
				}
				$userinfo = $info->fetchRow();
					// EMAIL confirmation message
						$to  = $userinfo['fname']." ".$userinfo['lname']." <".$userinfo['email'].">";
						
						/* subject */
						$subject = "Welcome to the GCC website!";
						
						/* message */
						$message = '
<HTML>
<HEAD>
<title>Welcome to the GCC website!</title></HEAD>
<BODY>
<p><FONT face=Arial size=2>Hello '.$userinfo['fname']." ".$userinfo['lname'].'!</FONT></p>
<p><FONT face=Arial size=2>Congratulations, you have successfully signed up for 
  a GCC web account!</FONT></p>
<p><FONT face=Arial size=2>This is a summery of information you entered. </FONT> 
</p>
<BLOCKQUOTE dir=ltr style="MARGIN-RIGHT: 0px"> 
  <p><FONT face=Arial size=2><STRONG><EM><U>Identification information:<br>
    </U></EM></STRONG></FONT><FONT face=Arial size=2><STRONG>Your name: '.$userinfo['fname']." ".$userinfo['lname'].'<br>
    username: '.$userinfo['username'].'<br>
    email: '.$userinfo['email'].'</STRONG><br>
    Date of birth: '.$userinfo['dob'].'<br>
    Your birthday will ';
	
	if(($userinfo['share']%100)%10 < 1){
		$message .= '<STRONG>NOT</STRONG> '; 
	}
	$message .= 'be shown in the directory.</FONT></p>
  <p> <FONT face=Arial size=2><STRONG><EM><U>Contact information:</U></EM></STRONG><br>
    home phone: '.$userinfo['hphone'].'<br>
    mobile phone: '.$userinfo['cphone'].'<br>
    work/school phone: '.$userinfo['wphone'].'<br>
    address: '.$userinfo['address']."<br>".$userinfo['city']."  ".$userinfo['state'].", ".$userinfo['zip'].'<br>
    AIM: '.$userinfo['im'].'<br>
    Your contact information will ';
	
	if($userinfo['share']%100 < 10){
		$message .='<STRONG>NOT</STRONG> ';
	}
	$message .= 'be shown in the directory.</FONT></p>
  <p><FONT face=Arial 
  size=2><STRONG><EM><U>Miscellaneous&nbsp;information:</U></EM></STRONG><br>
    workplace '.$userinfo['work'].':<br>
    school: '.$userinfo['school'].', class of: '.$userinfo['class'].'<br>
    Your misc information will ';
	
	if($userinfo['share']/100 < 1){
		$message .= '<STRONG>NOT</STRONG> ';
	}
	$message .= 'be shown in the directory.</FONT></p>
  </BLOCKQUOTE>
<p><FONT face=Arial size=2>Please make sure it is correct. (</FONT><FONT 
face=Arial size=2>If you notice any errors, don\'t worry you can change your information 
  by logging in.)</FONT></p>
<p> <FONT face=Arial size=2>From now on, you can access a variety of features 
  on the GCC website located at: <A 
href="http://www.gracecovenant.net/">http://www.gracecovenant.net/<br>
  </A> To access the login, simply scroll down and 
  enter your username and password. You can also click on "login" on the drop 
  down menu from the top of the screen. Once you log in, you can sign up for events 
  at GCC and search the online directory!</FONT></p>
<p><FONT face=Arial size=2>If you have any problems or suggestions/comments, simply 
  reply to this email (<A 
href="mailto:web@gracecovenant.net">web@gracecovenant.net</A>)</FONT></p>
<p> <FONT face=Arial size=2>Please bear with us as we continuously work to bring 
  you a better web-experience, and thank you again for your registration!<br>
  <BR>-from the web committee of Grace Covenant Church 
  :)</FONT></p>
<p><FONT face=Arial size=2><b>You do NOT need to reply to this email. This is just a 
notification.</b></FONT></p>
</BODY>
</HTML>';
						
						/* To send HTML mail, you can set the Content-type header. */
						$headers  = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						
						/* additional headers */
						$headers .= "From: Web Admin <web@gracecovenant.net>\r\n";
						$headers .= "Reply-To: Web Admin <web@gracecovenant.net>\r\n";
	
							
						/* and now mail it */
						mail($to, $subject, $message, $headers);
	
	$db_object->disconnect();
	header('Location: thankyou.php?status=ok&activity=newuser');
}
else {	// if form hasn't been submitted
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Middle</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
</head><style>
<!--
BODY{
scrollbar-face-color:#DB9864;
scrollbar-arrow-color:#DB9864;
scrollbar-track-color:#DB9864;
scrollbar-shadow-color:#BF875B;
scrollbar-highlight-color:#BF875B;
scrollbar-3dlight-color:'';
scrollbar-darkshadow-Color:'';
}
-->
</style>
<body background="images/brown.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="770" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="232" valign="top"><? require ("../php/includes/login.inc") ?>
</td>
    <td valign="top">
	<form action="<?=$HTTP_SERVER_VARS['PHP_SELF']?>" method="post">
<table width="538" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="40" background="images/top.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td background="images/middle.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="361"><div align="left"> 
                    <p><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><em>NEW 
                      USER<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                      </font> </em></font></strong></p>
                  </div></td>
                <td width="130">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td background="images/middle.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="10">&nbsp;</td>
                <td><p> 
                  <table border="0" cellpadding="3" cellspacing="0">
                    <tr align="center"> 
                      <td height="28" colspan=2><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Required 
                        Information:</strong></font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>First 
                        name:</strong></font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="fname" type="text" id="fname" size="20" maxlength="50">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Last 
                        name:</strong></font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="lname" type="text" id="lname" size="20" maxlength="50">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>username:</strong></font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="username" type="text" id="username" size="20" maxlength="50">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>password:</strong></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif">(4~16 
                        char)</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="password" type="password" id="password" size="16" maxlength="16">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Confirm 
                        Password:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="password_again" type="password" id="password_again" size="16" maxlength="16">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>email:</strong></font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="email" type="text" size="30" maxlength="100">
                        </font></td>
                    </tr>
                    
                    <tr bordercolor="#CCCCCC">
                      <td><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>gender:</strong></font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <input type=radio name="gender" value="1">Male<BR>
                        <input type=radio name="gender" value="2">Female
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td colspan=2><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>The 
                        username and email will be shared with all other registered 
                        users.</strong></font></td>
                    </tr>
                  </table>
                  <p></p></td>
                <td width="15">&nbsp;</td>
                <td width="40">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" background="images/middle.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="10">&nbsp;</td>
                <td><p> 
                  <table border="0" cellpadding="3" cellspacing="0">
                    <tr align="center"> 
                      <td colspan=2><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Birthday:</strong></font><font size="2"><strong><font face="Verdana, Arial, Helvetica, sans-serif">&nbsp; 
                        [ 
                        <input name="sharedob" type="checkbox" id="sharedob223" value="yes">
                        </font></strong><font face="Verdana, Arial, Helvetica, sans-serif"> 
                        share this info!<strong>]</strong></font></font></td>
                    <tr> 
                      <td width="191"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Date 
                        of Birth (m/d/y)</font></td>
                      <td width="391"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="dob" type="text" id="dob3" size="15" maxlength="20">
                        </font></td>
                    </tr>
                  </table>
                  <p></p></td>
                <td width="15">&nbsp;</td>
                <td width="40">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" background="images/middle.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" background="images/middle2.jpg"><table width="539" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="10">&nbsp;</td>
                <td><p> 
                  <table border="0" cellpadding="3" cellspacing="0" bordercolor="#FFFF66">
                    <tr align="center"> 
                      <td colspan=2><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Contact 
                        Information:</strong>&nbsp;</font><font size="2"><strong><font face="Verdana, Arial, Helvetica, sans-serif">&nbsp;[ 
                        <input name="sharecontact" type="checkbox" id="sharecontact" value="yes" >
                        </font></strong><font face="Verdana, Arial, Helvetica, sans-serif"> 
                        share this info!<strong>]</strong></font></font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">AIM 
                        or ICQ ID:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="im" type="text" id="im" size="20" maxlength="20">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">home 
                        Phone#:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="hphone" type="text" id="hphone" size="15" maxlength="20">
                        <input name="weirdphone" type="checkbox" id="weirdphone" value="yes">
                        international number</font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">mobile 
                        Phone#:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="cphone" type="text" id="cphone" size="15" maxlength="20">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">work/school 
                        Phone#:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="wphone" type="text" id="wphone" size="15" maxlength="20">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">street 
                        address:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="address" type="text" id="address" size="40" maxlength="100">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">city:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="city" type="text" id="city" size="30" maxlength="40">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">State 
                        &amp; ZIP:</font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="state" type="text" id="state" size="3" maxlength="2">
                        <input name="zip" type="text" id="zip" size="7" maxlength="5">
                        </font></td>
                  </table>
                  <p></p></td>
                <td width="15">&nbsp;</td>
                <td width="40">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" background="images/middle.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" background="images/middle2.jpg"><table width="539" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="10">&nbsp;</td>
                <td><p> 
                  <table border="0" cellpadding="3" cellspacing="0" dwcopytype="CopyTableRow">
                    <tr align="center"> 
                      <td colspan=2><font size="2"><strong><font face="Verdana, Arial, Helvetica, sans-serif">Misc 
                        Information: [ 
                        <input name="shareetc" type="checkbox" id="shareetc" value="yes">
                        </font></strong><font face="Verdana, Arial, Helvetica, sans-serif"> 
                        share this info!<strong>]</strong></font></font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td width="216"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">work:</font></td>
                      <td width="366"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="work" type="text" id="work" size="40" maxlength="100">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">school 
                        (most recent):</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="school" type="text" id="school" size="40" maxlength="100">
                        </font></td>
                    </tr>
                    <tr bordercolor="#CCCCCC"> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">graduated/graduating 
                        year:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="class" type="text" id="class" size="5" maxlength="4">
                        eg: 2003</font></td>
                    </tr>
                    
                    <tr bordercolor="#CCCCCC">
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">status:</font></td>
                      <td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <input type=radio name="youngadult" value="1">Undergrad<BR>
                        <input type=radio name="youngadult" value="3">Graduate Student<BR>
                        <input type=radio name="youngadult" value="2">Young Adult</font></td>
                    </tr>
                  </table>
                  <p></p></td>
                <td width="15">&nbsp;</td>
                <td width="40">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" background="images/middle.jpg"><div align="center"> 
              <input type="submit" name="submit" value="Create my Account!">
            </div></td>
        </tr>
        <tr> 
          <td height="30" background="images/bottom.jpg">&nbsp;</td>
        </tr>
      </table>
    </td>
</form>
  </tr>
</table>
</body>
</html>
<? } ?>
