<?php
include('authenticate.php');	// authentication script. 
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
<?php include('./topbar.html'); ?>

<h4>Directory</h4><br>
 <!--   <?php
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
    <?}?>-->
      <?php
  if(($_POST)) { // if form has been submitted
    if($_POST['type']=="qsearch") {
      if($_POST['searchby']=="fname") {
	if(!get_magic_quotes_gpc()) {
	  $_POST['searchtext'] = addslashes($_POST['searchtext']);			}
	$query = "SELECT * FROM Users WHERE fname LIKE '".$_POST['searchtext']."%' ORDER BY lname ASC, fname ASC";
      }elseif($_POST['searchby']=='lname') {
	if(!get_magic_quotes_gpc()) {
	  $_POST['searchtext'] = addslashes($_POST['searchtext']);
	}			$query = "SELECT * FROM Users WHERE lname LIKE '".$_POST['searchtext']."%' ORDER BY lname ASC, fname ASC";
      }	
    }else{
      if(!get_magic_quotes_gpc()) {
	$_POST['fname'] = addslashes($_POST['fname']);			$_POST['lname'] = addslashes($_POST['lname']);
      }
      if ($_POST['fname']){
	$query = "SELECT * FROM Users WHERE fname LIKE '".$_POST['fname']."%' ORDER BY lname ASC, fname ASC";
	if($_POST['lname']){
	  $query = "SELECT * FROM Users WHERE fname LIKE '".$_POST['fname']."%' AND lname LIKE '".$_POST['lname']."%' ORDER BY lname ASC, fname ASC";
	}
      }elseif($_POST['lname']){
	$query = "SELECT * FROM Users WHERE lname LIKE '".$_POST['lname']."%' ORDER BY lname ASC, fname ASC";
      }		else{
	die ('you must put in a search field.');
      }
    }	$rs = $db_object->query($query);
    if(DB::isError($rs)) {
      die('database error.');	}}?>
    <h4><strong>Welcome back, <font color="#0000FF"> 
      <?=$_SESSION['username']?>!</strong></h4><br>

    <form action="<?=$HTTP_SERVER_VARS['PHP_SELF']?>" method="post">
    <div align="center">
      <?php 
	 include('../subbox.php');
	 $caption = "Search the GCC Directory!";
	 if (isset($_POST['Submit'])) {
	   $caption = "Search Again";
	 }
	 start_subbox('350','orange',$caption,'left','left','_fill');
       ?>
      The directory is now searchable with partial matches.<br><br>
      <strong>First name : </strong>
        <input name="fname" type="text" id="fname" size="20" maxlength="50">
        <BR>
      <strong>Last name :</strong> 
        <input name="lname" type="text" id="lname" size="20" maxlength="50">
	<br><br>
      <input name="Submit" type="submit" value="Search!">
      <?php end_subbox('orange','_fill'); ?>
    </div>
    </form>
</td>
</tr>
<tr> 
  <td height="30" background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td><p> 
            <table border="0" cellpadding="0" cellspacing="0">
              <!--DWLayoutTable-->
              <tr> 
                <td align="center" valign="top"> <strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> 
                      Search Results:</font></strong></td>
              </tr>
        </table></td>
      </tr>
  </table></td>
</tr>
<tr>
  <td>
<?php
   if(isset($rs)) {
   while($result = $rs->fetchRow()){
     echo '<div align="center">';
     $uid = $result['user_id']; $fn = $result['fname']; $ln = $result['lname'];
     $em = $result['email'];
     $caption = <<<EOF
     <!-- $uid -->
     $fn
     $ln
     &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
     <a href="mailto:$em">$em</a>
EOF;
     start_subbox('455','orange',$caption,'left','left','');
?>
  <table border="0" cellspacing="0" cellpadding="0">
    <tr> 
      <td>
        <table border="0" cellpadding="4" cellspacing="0" bordercolor="#FFCC00">
          <tr> 
            <td width="120" valign="top">Birthday:</td>
            <td valign="top">
                <?php
		   if (($result['share']%100)%10 >= 1){
		     echo $result['dob'];
		   } else {
		     echo "(birthday private)";
		   }
		?>
                    &nbsp;</font>
            </td>
           </tr>
           <tr> 
            <td valign="top">contact:</td>
            <td valign="top">  
                    <?php

		       if ($result['share']%100 >= 10){

			 if ($result['address']) { echo $result['address']."<br>"; }
			 echo $result['city']."  ".$result['state'].($result['zip']?(", ".$result['zip']):'');
			 if ($result['city'] || $result['state'] || $result['zip']) { echo "<br>"; }

			 if ($result['hphone']) { echo '<strong>home #: </strong>'.$result['hphone'].'<br>'; }
			 if ($result['cphone']) { echo '<strong>cell #: </strong>'.$result['cphone'].'<br>'; }
			 if ($result['wphone']) { echo '<strong>work/dorm #: </strong>'.$result['wphone'].'<br>'; }
		     ?>
                    <strong>AIM/ICQ:</strong> <a href="aim:goim?screenname=<?=$result['im']?>"> 
                      <?=$result['im']?>
                  </a>
                    <?
		       } else {
			 echo "(contact information private)";
		       }
	            ?>
                    </td>
              </tr>
              <tr> 
                <td valign="top">Misc 
                    Info:</td>
                <td valign="top">  
                    <?php
		       if ($result['share']/100 >= 1){
		    echo "Work: ".$result['work']."<br>"."School: ".$result['school'].", class of ".$result['class'].".";
		    }else{
		    echo "(misc information private)";
		    }
		    ?>
                    &nbsp;</td>
              </tr>
            </table>
          <p></p></td>
      </tr>
  </table>
   <?php end_subbox('orange',''); ?>
   <br>
   </div>
<? } }?>
</td>
</tr>
</table>
<?php include('../footer.html'); ?>
