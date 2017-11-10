<?php
include('authenticate.php');	// authentication script.
if(isset($_POST['submit'])) { // if form has been submitted
	/* check they filled in what they supposed to, passwords matched, username
	isn't already taken, etc. */
	if(!$_POST['fname'] | !$_POST['lname'] | !$_POST['email'] |
		!$_POST['gender']) {
		die('You didn\'t fill in a required field.');
	}
	
	$_POST['fname'] = ucfirst(addslashes($_POST['fname']));
	$_POST['lname'] = ucfirst(addslashes($_POST['lname']));
	// check passwords match
	if($_POST['password'] != $_POST['password_again']) {
		die('Sorry your password and confirmation password did not match, please try again.');
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
        $ppatterns = array ("/(\d{3})(\d{3})(\d{4})(\z)/","/(\d{3})(\D{1,})(\d{3})(\D{1,})(\d{4})(\z)/","/(\D{1,})(\d{3})(\D{1,})(\d{3})(\D{1,})(\d{4})(\z)/");
        $preplace = array ("(\\1) \\2-\\3","(\\1) \\3-\\5","(\\2) \\4-\\6");
        if($_POST['weirdphone']=="yes") {
                $hphone = addslashes($_POST['hphone']);
        }else{
                $hphone = preg_replace ($ppatterns, $preplace, $_POST['hphone']);
        }
        $cphone = preg_replace ($ppatterns, $preplace, $_POST['cphone']);
        $wphone = preg_replace ($ppatterns, $preplace, $_POST['wphone']);
        // correct bithday format
        $dpattern = array ("/(\d{2})(\d{2})(\d{4})(\z)/","/(\d{2})(\d{2})(\d{2})(\z)/","/(\d{2})(\D{1,})(\d{2})(\D{1,})(\d{2})(\z)/","/(\d{2})(\D{1,})(\d{2})(\D{1,})(\d{4})(\z)/");
        $dreplace = array ("\\1/\\2/\\3","\\1/\\2/19\\3","\\1/\\3/19\\5","\\1/\\3/\\5");
        $dob = preg_replace ($dpattern, $dreplace, $_POST['dob']);
        // correct im format
        $im = preg_replace ("(\s{1,})","", $_POST['im']);
		
        // correct class (convert 2 digit year format to 4 digit)
        $class = preg_replace ("(\D{1,})","", $_POST['class']);
        if (strlen($class) <= 2){
                if ($class > 50){
                        $class = preg_replace ("/(\d{2})/","19\\1", $class);
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
	if($_POST['password'] && strlen($_POST['password'])<4 ) {
		die('Sorry, your password must be 4 letter/digits or longer');
	}
	// encrypt password
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
	$gender = $_POST['gender'];
	$youngadult = $_POST['youngadult'];
	// now we can add them to the database.
	if ($_POST['password'] !="") {
		$_POST['password'] = md5($_POST['password']);
		$update = "UPDATE Users SET password='".$_POST['password']."',email='".$_POST['email']."',fname='".$_POST['fname']."',lname='".$_POST['lname']."',dob='".$dob."',im='".$im."',hphone='".$hphone."',cphone='".$cphone."',wphone='".$wphone."',address='".$_POST['address']."',city='".$_POST['city']."',state='".$_POST['state']."',zip='".$_POST['zip']."',work='".$_POST['work']."',school='".$_POST['school']."',share='".$share."',class='".$class."',gender=".$gender.", youngadult=".$youngadult." WHERE username = '".$_POST['username']."'";
	}else{
		$update = "UPDATE Users SET email='".$_POST['email']."',fname='".$_POST['fname']."',lname='".$_POST['lname']."',dob='".$dob."',im='".$im."',hphone='".$hphone."',cphone='".$cphone."',wphone='".$wphone."',address='".$_POST['address']."',city='".$_POST['city']."',state='".$_POST['state']."',zip='".$_POST['zip']."',work='".$_POST['work']."',school='".$_POST['school']."',share='".$share."',class='".$class."',gender=".$gender.", youngadult=".$youngadult." WHERE username = '".$_POST['username']."'";
	}
	$update_user = $db_object->query($update);
	if(DB::isError($update_user)) {
		die($update_user->getMessage());
	}
	header('Location: thankyou.php?status=ok&activity=updateinfo');
}
	$query = "SELECT * FROM Users WHERE username = '".$_SESSION['username']."'";
	$info = $db_object->query($query);
	if(DB::isError($info)) {
		die($info->getMessage());
	}
	$myinfo = $info->fetchRow();
?>
<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('../header.html'); ?>
<?php include('./sidebar.html'); ?>
<?php include('./topbar.html'); ?>

<h4>My Info</h4><br>
<!--
<?php
$group_id_q = $db_object->query("SELECT group_id FROM Members WHERE user_id = '".$_SESSION['user_id']."'");
if(DB::isError($db_object)) {
  die($group_id_q->getMessage());
}
$group_id = $group_id_q->fetchRow();
if ($group_id == NULL){?>
<font color="#FF0000" size="3">
  <strong><em>According to our records, your GCC web account 
      is NOT connected to a family group. Please add yourself 
      to a family group by clicking <a href="groups.php">HERE</a></em></strong></font>
<br>
<?}?>
-->
<h4><strong>Welcome back, <font color="#0000FF"> 
      <?=$_SESSION['username']?>!</strong></h4><br>

<form action="<?=$HTTP_SERVER_VARS['PHP_SELF']?>" method="post">
  <div align="center">
  <?php include('../subbox.php'); ?>
  <?php start_subbox('92%','orange','Required Information:','left','left',''); ?>
  <table>
    <tr bordercolor="#CCCCCC"> 
      <td><font color="#0000FF"><strong>First 
	    name:</strong></font></td>
      <td> 
        <input name="fname" value="<?=$myinfo['fname']?>" type="text" id="fname" size="20" maxlength="50">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td><font color="#0000FF"><strong>Last 
	    name:</strong></font></td>
      <td>  
        <input name="lname" value="<?=$myinfo['lname']?>" type="text" id="lname" size="20" maxlength="50">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td><font color="#0000FF"><strong>username:</strong></font></td>
      <td>  
        <?=$myinfo['username']?>
        <input name="username" type="hidden" value="<?=$myinfo['username']?>">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td><font color="#0000FF"><strong>email:</strong></font></td>
      <td>  
        <input name="email" value="<?=$myinfo['email']?>" type="text" size="30" maxlength="100">
      </td>
    </tr>
    
    <tr bordercolor="#CCCCCC">
      <td><font color="#0000FF"><strong>gender:</strong></font></td>
      <td> 
        <input type=radio name="gender" value="1"
	       <? if($myinfo['gender']==1) {
		  echo " checked"; }?>
	       >Male<BR>
        <input type=radio name="gender" value="2"
	       <? if($myinfo['gender']==2) {
		  echo " checked"; }?>
	       >Female
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td colspan=2><font color="#FF0000"><strong>The 
	    username and email will be shared with all other registered 
	    users.</strong></font></td>
    </tr>
  </table>
  <?php end_subbox('orange',''); ?><br>

  <?php start_subbox('92%','orange','Birthday: [ <input name="sharedob" type="checkbox" id="sharedob223" value="yes" '. (($myinfo["share"]%100)%10 >= 1 ? 'checked' : '') . '>share this info! ]','left','left',''); ?>
  <table><tr>
      <td>Date of Birth (m/d/y)</td>
      <td><input name="dob" value="<?=$myinfo['dob']?>" type="text" id="dob3" size="15" maxlength="20"></td>
  </tr></table>
  <?php end_subbox('orange',''); ?><br>

  <?php start_subbox('92%','orange','Contact Information: [ <input name="sharecontact" type="checkbox" id="sharecontact" value="yes" '. ($myinfo["share"]%100 >= 10 ? 'checked' : '') . '>share this info! ]','left','left',''); ?>
  <table>
    <tr bordercolor="#CCCCCC"> 
      <td>AIM 
          or ICQ ID:</td>
      <td>  
          <input name="im" type="text" id="im" value="<?=$myinfo['im']?>" size="20" maxlength="20">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>home 
          Phone#:</td>
      <td>  
          <input name="hphone" type="text" id="hphone" value="<?=$myinfo['hphone']?>" size="15" maxlength="20">
          <input name="weirdphone" type="checkbox" id="weirdphone" value="yes">
          international number</td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>mobile 
          Phone#:</td>
      <td>  
          <input name="cphone" type="text" id="cphone" value="<?=$myinfo['cphone']?>" size="15" maxlength="20">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>work/school 
          Phone#:</td>
      <td>  
          <input name="wphone" type="text" id="wphone" value="<?=$myinfo['wphone']?>" size="15" maxlength="20">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>street 
          address:</td>
      <td>  
          <input name="address" type="text" id="address" value="<?=$myinfo['address']?>" size="40" maxlength="100">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>city:</td>
      <td>  
          <input name="city" type="text" id="city" value="<?=$myinfo['city']?>" size="30" maxlength="40">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>State 
          &amp; ZIP:</td>
      <td> 
          <input name="state" type="text" id="state" value="<?=$myinfo['state']?>" size="3" maxlength="2">
          <input name="zip" type="text" id="zip" value="<?=$myinfo['zip']?>" size="7" maxlength="5">
      </td>
    </tr>
  </table>
  <?php end_subbox('orange',''); ?><br>

  <?php start_subbox('92%','orange','Misc Information: [ <input name="shareetc" type="checkbox" id="shareetc" value="yes" '. ($myinfo["share"]/100 >= 1 ? 'checked' : '').'> share this info! ]','left','left',''); ?>
  <table border="0" cellpadding="3" cellspacing="0" dwcopytype="CopyTableRow">
    <tr bordercolor="#CCCCCC"> 
      <td width="216">work:</td>
      <td width="366">  
	  <input name="work" value="<?=$myinfo['work']?>" type="text" id="work" size="40" maxlength="100">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>school 
	  (most recent):</td>
      <td>  
	  <input name="school" value="<?=$myinfo['school']?>" type="text" id="school" size="40" maxlength="100">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>graduated/graduating 
	  year:</td>
      <td>  
	  <input name="class" value="<?=$myinfo['class']?>" type="text" id="class" size="5" maxlength="4">
	  eg: 2003</td>
    </tr>
    
    <tr bordercolor="#CCCCCC">
      <td>status:</td>
      <td> 
        <input type=radio name="youngadult" value="1"
	       <? if($myinfo['youngadult']==1) {
		  echo " checked"; }?>
	       >Undergrad<BR>
        <input type=radio name="youngadult" value="3"
	       <? if($myinfo['youngadult']==3) {
		  echo " checked"; }?>
	       >Graduate Student<BR>
        <input type=radio name="youngadult" value="2"
	       <? if($myinfo['youngadult']==2) {
		  echo " checked"; }?>
	       >Young Adult</td>
    </tr>
  </table>
  <?php end_subbox('orange',''); ?><br>

  <?php start_subbox('92%','orange','Type in your password ONLY if you wish to CHANGE it.','left','left',''); ?>
  <table border="0" cellpadding="3" cellspacing="0">
    <tr bordercolor="#CCCCCC"> 
      <td width="210"><font color="#0000FF"><strong>password:</strong></font>(4~16 
        char)</td>
      <td width="372"> 
        <input name="password" type="password" id="password" size="16" maxlength="16">
      </td>
    </tr>
    <tr bordercolor="#CCCCCC"> 
      <td>Confirm 
        Password:</td>
      <td> 
        <input name="password_again" type="password" id="password_again" size="16" maxlength="16">
      </td>
    </tr>
  </table>
  <?php end_subbox('orange',''); ?><br>

    <div align="center"> 
      <input type="submit" name="submit" value="Update my info!">
    </div>
  </div>
</form>
  </td>
 </tr>
</table>
<?php include('../footer.html'); ?>
