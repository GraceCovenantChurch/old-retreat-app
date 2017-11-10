<?php

include('authenticate.php');	// authentication script.

// get the year of the graduating class -- 1+year if it's fall, else year.
$senior_class = date('Y');
if (date('n') > 8) {
	// sept thru dec
	$senior_class++;
}

$query = "SELECT * FROM Users WHERE user_id = '".$_SESSION['user_id']."'";

$info = $db_object->query($query);

if(DB::isError($info)) {

die($info->getMessage());
	}
$userinfo = $info->fetchRow();

if($_POST) {	
$event_id = $_POST['event_id'];
if($_POST['Submit'] == "Sign Me Up!") {	
//	if(!$_POST['youngadult'] || !$_POST['gender']) {
	if (!$_POST['gender']) {
		die('You didn\'t fill in a required field: gender.');
	}
//	else if($_POST['youngadult'] == 1) {
	        if(!$_POST['school'] || !$_POST['class']) {
			die('You didn\'t fill in a required field: class or school.');
		}
//	}
	if ($_POST['ride'] == "getride") {
		$ride = -1;
	}
	elseif ($_POST['ride'] == "noride") {	
		$ride = 0;	
	}
	elseif ($_POST['ride'] == "giveride") {		
		$ride = $_POST['ridenumber'];
	}
	$comments = $_POST['comments'];	
	$commenttxt = $_POST['commenttxt'];
	$gender = $_POST['gender'];
	$familygroup = $_POST['familygroup'];
	$youngadult = $_POST['youngadult'];
	$school = $_POST['school'];
	$class = $_POST['class'];
}
elseif($_POST['Submit'] == "Confirm my signup.") 
{
	$ride = $_POST['ride'];	
	$groupid = $_POST['familygroup'];
	$comments = $_POST['comments'];

	$query2 = "INSERT INTO Participants (user_id, event_id, ride, comments,
		 signuptime)
		 VALUES ('".$_SESSION['user_id']."','".$event_id."','".$ride."',
		 '".$comments."', NOW())";
	if($_POST['school']) {
		$userupdquery = "UPDATE Users SET "
				. "gender=".$_POST['gender']
//				. ", youngadult=".$_POST['youngadult']
				. ", school='".$_POST['school']
				."', class='".$_POST['class']
				."', email='".$_POST['email']
				."', cphone='".$_POST['cphone']
				."' WHERE user_id=".$userinfo['user_id'];
	}
	else {
	        $userupdquery = "UPDATE Users SET "
				. "gender=".$_POST['gender']
//				. ", youngadult=".$_POST['youngadult']
				. " WHERE user_id=".$userinfo['user_id'];
	}
	$rs = $db_object->query($query2);
	if(DB::isError($rs)) {
		die('database error.');
	}
	$rs = $db_object->query($userupdquery);
	if(DB::isError($rs)) {
		die('database error.');
	}

	$info = $db_object->query($query);

	if(DB::isError($info)) {
		die($info->getMessage());
	}
	$userinfo = $info->fetchRow();

	$famgroup = $db_object->query("SELECT member_id FROM Members WHERE user_id=".$userinfo['user_id']);
	if(DB::isError($famgroup)) {
		die('database error.');
	}
	$memid = $famgroup->fetchRow();

	if($groupid != NULL && $groupid != "") {
		if($memid == NULL) {
		        $db_object->query("INSERT INTO Members (user_id, group_id, type) VALUES (".$userinfo['user_id'].",".$groupid.",0)");
		}
		else {
		        $db_object->query("UPDATE Members SET group_id=".$groupid." WHERE member_id=".$memid['member_id']);
		}

		$groupname_q = $db_object->query("SELECT name FROM Groups WHERE group_id=".$groupid);
		$groupname = $groupname_q->fetchRow();
	}


$query3 = "SELECT * FROM Events WHERE event_id = '".$event_id."'";
	$events = $db_object->query($query3);
if(DB::isError($events)) {
	die($events->getMessage());
}
$event = $events->fetchRow();									// EMAIL confirmation message
$to  = $userinfo['fname']." ".$userinfo['lname']." <".$userinfo['email'].">";
												/* subject */
$subject = "Event signup confirmation!";
/* message */
$message = '			<HTML>			<HEAD>			
<title>Event signup confirmation!</title></HEAD>
			<BODY>			
			<p><FONT face=Arial size=2>Hello '.$userinfo['fname']." ".$userinfo['lname'].'!</FONT></p>
				<p><FONT face=Arial size=4>Congratulations, you have successfully signed up for 			  <b>'.$event['name'].'</b> </FONT></p>
			<p><FONT face=Arial size=2>This is a summary of information you entered. </FONT> 			
			</p>			
			<BLOCKQUOTE dir=ltr style="MARGIN-RIGHT: 0px">
			 <strong>Name:</strong>'.$userinfo['fname']." ".$userinfo['lname'].'<BR>
			 <strong>Gender:</strong> ';
			 if($userinfo['gender'] == 1) {
				$message .= 'Male';
			}
			else {
		 		$message .= 'Female';
		 	}
/*			 $message .= '<BR>
			 <strong>Status:</strong> ';
			 if($userinfo['youngadult'] == 1) {
				$message .= 'Undergrad';
			}
			else if($userinfo['youngadult'] == 2) {
		 		$message .= 'Young Adult';
		 	}
		 	else if($userinfo['youngadult'] == 3){
		 	        $message .= 'Graduate Student';
		 	        }
*/
			 $message .= '<BR>
			 <strong>Email:</strong> '			.$userinfo['email'].'<BR>
			 <strong>Cell Phone:</strong> '.$userinfo['cphone'].'<br>
			 <strong>School:</strong> '			.$userinfo['school'].'<BR>
			 <strong>Class:</strong> '			.$userinfo['class'].'<BR>';
/*			 $message .= '
			 <strong>Family Group:</strong> ';
				if($groupname == NULL) {
					$message .= 'NONE';
				}
				else {
			 		$message .= $groupname['name'];
			 	}
*/
			 $message .=	'<BR>
			 <strong>Ride:</strong> ';
	if ($ride==-1){
			$message .= 'I need a ride.';
	}elseif($ride==0){
			$message .= 'I don\'t need a ride, but I do not have extra space.';
	}else{
			$message .= 'Can provide rides for '.$ride.' person(people).';
							
	}	
	if($event['commenttxt'] != "") {					
	$message .= '<BR><STRONG>Comments:</STRONG> '.$comments;
	}
	$message .= '</BLOCKQUOTE>
				<p><FONT face=Arial size=2>Please make sure the above information is correct. 
				(</FONT><FONT 			face=Arial size=2>If you notice any errors, don\'t worry you can change your information
by logging in <a href="http://www.gracecovenant.net/db/signup.php?id='.$event_id.'">HERE</a>.)</FONT></p>';
	if($event['emailtxt'] != "") {
		$message .= '<p><FONT face=Arial size=2>'.$event['emailtxt'].'</FONT></p>';
	}
	$message .= '		<p><FONT face=Arial size=2>If you have any problems or suggestions/comments, simply reply to this email (<A href="mailto:web@gracecovenant.net">web@gracecovenant.net</A>)</FONT></p>
			<p> <FONT face=Arial size=2>Please bear with us as we continuously work to bring you a better web-experience, and thank you again for your registration!<br>
		 <BR>-from the web committee of Grace Covenant Church 	:)</FONT></p>
			<p><FONT face=Arial size=2><b>You do NOT need to reply to this email. This is just a notification.</b></FONT></p>
		</BODY>			</HTML>';
	/* To send HTML mail, you can set the Content-type header. */
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: Web Admin <web@gracecovenant.net>\r\n";
	$headers .= "Reply-To: Web Admin <web@gracecovenant.net>\r\n";
	
	mail($to, $subject, $message, $headers);
	header('Location: thankyou.php?status=ok&activity=eventplus');
	}elseif($_POST['Submit'] == "Remove My signup from the database.") {	
	$query2 = "DELETE FROM Participants WHERE particip_id = '".$_POST['part_id']."'";	
	$rs = $db_object->query($query2);
		if(DB::isError($rs)) {
				die('database error.');
		}
		$query3 = "SELECT * FROM Events WHERE event_id = '".$event_id."'";				
		$events = $db_object->query($query3);
		if(DB::isError($events)) {
			die($events->getMessage());
			}
		$event = $events->fetchRow();
		// EMAIL confirmation message
		$to  = $userinfo['fname']." ".$userinfo['lname']." <".$userinfo['email'].">";
		/* subject */
		$subject = "Event signup cancellation!";
		/* message */
		$message = '<HTML><HEAD><title>Event signup cancellation!</title>
		</HEAD><BODY><p><FONT face=Arial size=2>Hello '.$userinfo['fname']." ".$userinfo['lname'].'!
		</FONT></p><p><FONT face=Arial size=4>You have cancelled your signup for <b>'.$event['name'].'</b>
		 </FONT></p><p><FONT face=Arial size=2>If this is a mistake, of if you would like to sign up again, please click <a href="http://www.gracecovenant.net/db/signup.php?id='.$event_id.'">HERE</a> and sign up again :) </FONT></p>
		 <p><FONT face=Arial size=2>If you have any problems or suggestions/comments, simply   reply to this email (<A href="mailto:web@gracecovenant.net">web@gracecovenant.net</A>)</FONT></p>
		 <p> <FONT face=Arial size=2>Please bear with us as we continuously work to bring   you a better web-experience, and thank you again for your registration!<br>
		   <BR>-from the web committee of Grace Covenant Church   :)</FONT></p>
		   <p><FONT face=Arial size=2><b>You do NOT need to reply to this email. This is just a notification.</b></FONT></p></BODY></HTML>';
		   									
		/* To send HTML mail, you can set the Content-type header. */
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		/* additional headers */						
		$headers .= "From: Web Admin <web@gracecovenant.net>\r\n";
		$headers .= "Reply-To: Web Admin <web@gracecovenant.net>\r\n";
		
		/* and now mail it */						
		mail($to, $subject, $message, $headers);
		header('Location: thankyou.php?status=ok&activity=eventminus');
		}elseif($_POST['Submit'] == "Cancel and return to previous page.") 
		{	
		$_POST['Submit'] = ""; }
		}
		else{	
		$event_id = $_REQUEST['id'];
		}
		?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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



<table width="538" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td background="images/middle.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="361"><div align="left"> 
                    <p><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><em>SIGNUP 
					<!--
                      <?php
$group_id_q = $db_object->query("SELECT group_id FROM Members WHERE user_id = '".$_SESSION['user_id']."'");
if(DB::isError($db_object)) {
	die($group_id_q->getMessage());
}	
$group_id = $group_id_q->fetchRow();
if ($group_id == NULL){?>
                      <BR>
                      <BR>
                      <font color="#FF0000" size="3" face="Verdana, Arial, Helvetica, sans-serif"> 
                      <strong><em>According to our records, your GCC web account 
                      is NOT connected to a family group. Please add yourself 
                      to a family group by clicking <a href="groups.php">HERE</a></em></strong></font> 
                      <br>
                      <?}?>
                      <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                      </font> </em></font></strong></p>
                  </div>
				  -->
				</td>
                <td width="40">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td background="images/middle.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td height="30" background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="60">&nbsp;</td>
                <td><table width="438" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td> <p><font face="Verdana, Arial, Helvetica, sans-serif"> 
                          <?php	$query2 = "SELECT * FROM Participants WHERE user_id = '".$_SESSION['user_id']."' AND event_id = '".$event_id."' ";	$rs2 = $db_object->query($query2);	if(DB::isError($rs2)) {		die($rs2->getMessage());	}	$check = $rs2->fetchRow();	$query3 = "SELECT * FROM Events WHERE event_id = '".$event_id."'";	$events = $db_object->query($query3);	if(DB::isError($events)) {		die($events->getMessage());	}	$event = $events->fetchRow();?>
                          </font></p>
                        <table width="437" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="10">&nbsp;</td>
                            <td width="426"><table width="418" border="0" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td><strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> 
                                    <?=$event['name'] ?>
                                    <BR><BR>
                                    </font></strong></td>
                                </tr>
                                <tr> 
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Date(s):</strong> 
                                    <?=date("l, F jS Y",strtotime ($event['stime']))?>
                                    <?php		if ($event['type']==1){	?>
                                    ~ 
                                    <?=date("l, F jS",strtotime ($event['etime']))?>
                                    <?		}	?>
                                    <br>
                                    <br>
                                    <?=$event['schedule'] ?>
                                    </font></td>
                                </tr>
                                <tr> 
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Location:</strong> 
                                    <?=$event['location'] ?>
                                    <BR><BR>
                                    </font></td>
                                </tr>
                                <tr> 
                                  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Description:</strong>
                                    <?=$event['desc'] ?>
                                    <BR>
                                    <?php		if ($event['price']>0){	?>
                                    <br>
                                    <strong>Price :</strong> $ 
                                    <?=$event['price']?>
				    <br><br>
                                    <?		}	?>
                                    </font></td>
                                </tr>
                              </table></td>
                            <td width="10">&nbsp;</td>
                          </tr>
                        </table>
                        
                          <?php	if ($event['status']==1){ ?>
                          <form action="<?=$HTTP_SERVER_VARS['PHP_SELF']?>" method="post"
			  	name="signup" id="signup">
                          </td>
                    </tr>
                  </table></td>
                <td width="60">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td background="images/middle.jpg">&nbsp;</td>
        </tr>
        <tr> 
          <td background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="60">&nbsp;</td>
                <td><table width="418" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>

<?php
if ($_POST['Submit'] == "Sign Me Up!" && $_POST['comments'] == ""
	&& $event['commenttxt'] != "") {
	// don't require comments
	// $_POST['Submit'] = "";
	$commentmissing = 0; // $commentmissing = 1;
}
else {
	$commentmissing = 0;
}

if ($check == NULL && !$_POST['Submit'] == "Confirm my signup."){ 			?>
		    <tr> 
                      <td><div align="center"><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Signup 
                          Form </strong></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <input name="event_id" type="hidden" id="event_id9" value="<?=$event_id?>">
                          </font></div></td>
                    </tr>
                    <tr> 
                      <td>&nbsp;</td>
                    </tr>
                    
                    <?php if ($event['catagory']==1 || $_SESSION['type'] == 5 ){ ?>
                    <tr>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        Gender: <BR>
                        <input name="gender" type="radio" value="1"
			<? if($userinfo['gender'] == 1) echo " checked"; ?>
			>Male<BR>
			<input name="gender" type="radio" value="2"
                        <? if($userinfo['gender'] == 2) echo " checked"; ?>
			>Female
			</font></td>
                    </tr>

<!--                <tr>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><BR>
                        Status: <BR>
                        <input name="youngadult" type="radio" value="1"
			<? if($userinfo['youngadult'] == 1) echo " checked "; ?>
			>Undergrad<BR>
			<input name="youngadult" type="radio" value="3"
			<? if($userinfo['youngadult'] == 3) echo " checked "; ?>
			>Graduate Student<BR>
			<input name="youngadult" type="radio" value="2"
                        <? if($userinfo['youngadult'] == 2) echo " checked "; ?>
			>Young Adult
			</font></td>
                    </tr>
-->
		    
                    <tr> 
                      <td><BR><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Contact Information</font>
		      
                      <TABLE><TR>
                        <TD><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Email: </font></TD>
			<TD><input name="email" type="text" value="<?=$userinfo['email']?>" size="40" maxlength="100"></TD>
                        </TR>
                        <TR>
			<TD><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cell Phone: </font></TD>
			<TD><input name="cphone" type="text" value="<?=$userinfo['cphone']?>" size="15" maxlength="15"></TD>
			</TR>
			</TABLE>
		        </font>
		      </td>
                    </tr>
		    
                    <tr>
                      <td><BR><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                      If you are currently a student, please fill out your school and class below:<BR>
                      <TABLE><TR>
                        <TD><font size="2" face="Verdana, Arial, Helvetica, sans-serif">School: </font></TD><TD><input name="school" type="text" id="school" value="<?=$userinfo['school']?>" size="40" maxlength="100"></TD>
                        </TR>
                        <TR>
			<TD><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Class: </font></TD>
			<TD><select name="class">
			<option name="othr">other</option>
			<?php
			for ($i=0; $i<4; $i++) { 
				echo '<option '.($userinfo['class']==($i+$senior_class)?'selected':'').'>'.($i+$senior_class)."</option>\n";
			}
			?>
			</select>
			</TR>
			</TABLE>
			</font></td>
                    </tr>
                    
                    <tr>
                      <td><BR><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                      <?
                      $allgroups_q = $db_object->query("SELECT * FROM Groups");
                      if(DB::isError($db_object)) {
				die($allgroups_q->getMessage());
		      }
		      
		      if($group_id != NULL) {
	                      $mygroup_q = $db_object->query("SELECT name FROM Groups WHERE group_id=".$group_id['group_id']);;
				if(DB::isError($db_object)) {
					die($mygroup_q->getMessage());
				}
				$mygroup = $mygroup_q->fetchRow();
			}
			?>
<!--                  Family Group:
                      <select name="familygroup">
			<option value=""></option>
                        <? while ($onegroup = $allgroups_q->fetchRow()) { ?>
			<option value="<?=$onegroup['group_id']?>"
			<? if($group_id != NULL) {
			 if($onegroup['name'] == $mygroup['name']) echo " selected"; }?>
			><?=$onegroup['name']?></option>
			<? } ?>
			</select>
			</font></td>
-->
                    </tr>
                    
                    <!--<tr> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><BR>
                        <input name="ride" type="radio" value="getride" checked
				onclick="document.signup.ridenumber.disabled=true">
                        I need a ride<br>
                        <input name="ride" type="radio" value="noride"
				onclick="document.signup.ridenumber.disabled=true">
                        I don't need a ride, but I do not have extra space.
			<br>
                        <input name="ride" type="radio" value="giveride"
				onclick="document.signup.ridenumber.disabled=false">
                        I can provide rides for 
                        <input name="ridenumber" type="text" id="ridenumber"
				size="2" maxlength="2" Disabled>
                        people. </font></td>
                    </tr> -->
                    
                    <?	}	?>
                    
                    <?php if ($event['commenttxt'] != "") {
		    	// extra question for days attending etc.		?>
                    <tr> 
                      <td> 
                      <BR>
                        <? if($commentmissing == 1) { ?>
                        <font color = "red" size="2" face="Verdana, Arial, Helvetica, sans-serif"><B>Please 
                        fill out the comment section before continuing</B></font><BR><BR>
                        <? } ?>
                        <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <?=$event['commenttxt'] ?>
                        </font><font size="-3">&nbsp;<BR>&nbsp;<BR></font> <textarea name = "comments" cols=49 rows=3></textarea>
                        <input name="commenttxt" type="hidden" id="commenttxt"
				value="<?=$event['commenttxt']?>">
                      </td>
                    </tr>
                    <? } ?>
                    
                    <tr> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <BR><center>
                        <input name="Submit" type="submit" value="Sign Me Up!">
                        </center>
                        </font></td>
                    </tr>
                    </table></td>
                    
                    <?php	}elseif($_POST['Submit'] == "Sign Me Up!") {
		   	$query5 = "SELECT name FROM Groups WHERE group_id =
			   '".$group_id['group_id']."' AND (type = 1 OR type = 2)";
			   $rs5 = $db_object->query($query5);
			   if(DB::isError($rs5)) {
			   	die('database error5.');
			   }
			   $group = $rs5->fetchRow();?>
                    
                    <tr> 
                      <td><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>YOU 
                        ARE NOT DONE YET! You must click on "Confirm my signup" 
                        to finish your signup!</strong></font> </td>
                    </tr>
                  </table></td>
                <td width="60">&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif">Please 
                  Confirm Your Signup info:</font></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><table width="418" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr> 
                      <td width="103"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Name:</font></strong></td>
                      <td width="241"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <?=$userinfo['fname']?>
                        <?=$userinfo['lname']?>
                        </font></td>
                      <td width="54"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>
                    
                    <tr>
                      <td width="103"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Gender:</font></strong></td>
                      <td width="241"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <input name="gender" type="hidden" value="<?=$gender?>">
			<? if($gender == 1) echo "Male";
			else echo "Female";
			?>
                        </font></td>
                      <td width="54"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>
                    
		    <input name="youngadult" type="hidden" value="<?=$youngadult?>">
<!--
		    <tr>
                      <td width="103"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Status:</font></strong></td>
                      <td width="241"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                       
			<? if($youngadult == 1) echo "Undergrad";
			else {
				if ($youngadult == 2) echo "Young Adult";
				else if ($youngadult == 3) echo "Graduate Student";
			}
			?>
                        </font></td>
                      <td width="54"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="myinfo.php">incorrect?</a>
                        </font></td>
                    </tr>
-->                    
                    <tr> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Email:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="email" type="hidden" value="<?=$userinfo['email']?>">
                        <?=$userinfo['email']?>
                        </font></td>
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>
                    <tr> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Cell 
                        Phone:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <input name="cphone" type="hidden" value="<?=$userinfo['cphone']?>">
                        <?=$userinfo['cphone']?>
                        </font></td>
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>
                    
                    <tr>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>
                        School:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                      <input name="school" type="hidden" value="<?=$school?>">
                        <?=$school?>
                        </font></td>
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>
                    
                    <tr>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>
                        Class:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                      <input name="class" type="hidden" value="<?=$class?>">
                        <?=$class?>
                        </font></td>
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>
                    
                    <tr> 
                    <?
                    if($familygroup != NULL && familygroup != "") {
			    $groupname_q = $db_object->query("SELECT name FROM Groups WHERE group_id=".$familygroup);
			    if(DB::isError($groupname_q)) {

				die($groupname_q->getMessage());
					}
			    $groupname = $groupname_q->fetchRow();
			}
		    ?>
		    
		    <input name="familygroup" type="hidden" value="<?=$familygroup?>">
<!--                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Family 
                        Group:</strong></font> </td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                      
                        <?							
				  if ($familygroup == NULL || $familygroup == ""){
				  ?>
                        <font color="#FF0000" size="3" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <strong>NONE</strong></font> 
                        <? 
				  }else{
				  ?>
                        <?=$groupname['name']?>
		    	<?							}?>
                        </font></td>
-->
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
                         </font></td>
                    </tr>
					<!--
                    <tr> 
                      <td height="19"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Ride:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <? 							if ($ride==-1){								echo "I need a ride.";								}elseif($ride==0){								echo "I don't need a ride, but I do not have extra space.";								}else{								echo "Can provide for ".$ride." person(people).";							}				?>
                        </font></td>
                      <td>&nbsp;</td>
                    </tr>
					-->
                    <? if($event['commenttxt'] != "") { ?>
                    <tr> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><B> 
                        <?=$commenttxt?>
                        </B></font> </td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <?=$comments?>
                        </font> </td>
                    </tr>
                    <? } ?>
                  </table></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input name="event_id" type="hidden" id="event_id" value="<?=$event_id?>">
				   <input name="part_id" type="hidden" value="<?=$check['particip_id']?>">
                  <!--
				  <input name="ride" type="hidden" id="ride" value="<?=$ride?>">
                    -->
					<input name="comments" type="hidden" id="comments" value="<?=$comments?>">
                    <BR>
                    <input name="Submit" type="submit" value="Confirm my signup.">
                    &nbsp;</font></p>
                  <p align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input name="Submit" type="submit" value="Cancel and return to previous page.">
                    </font></p></td>
                <td>&nbsp;</td>
              </tr>
              
              <?php
	      }else{
	      	$query5 = "SELECT name FROM Groups WHERE group_id = '".$group_id['group_id']."'
		       AND (type = 1 OR type = 2)";
		$rs5 = $db_object->query($query5);
		if(DB::isError($rs5)) {
			die('database error5.');
		}
		$group = $rs5->fetchRow();
		?>
              <tr> 
                <td>&nbsp;</td>
                <td><div align="center"><font color="#FF0000" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>YOU 
                    ARE ALREADY SIGNED UP!</strong> </font></div></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr> 
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Your 
                  Signup info:</font></strong></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><table width="418" border="0" align="center" cellpadding="5" cellspacing="0">
                    <tr>
                      <td width="103"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Name:</font></strong></td>
                      <td width="241"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <?=$userinfo['fname']?>
                        <?=$userinfo['lname']?>
                        </font></td>
                      <td width="54"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>

                    <tr>
                      <td width="103"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Gender:</font></strong></td>
                      <td width="241"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
			<? if($userinfo['gender'] == 1) echo "Male";
			else echo "Female";
			?>
                        </font></td>
                      <td width="54"><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>

<!--
                    <tr>
                      <td width="103"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Status:</font></strong></td>
                      <td width="241"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
			<? if($userinfo['youngadult'] == 1) echo "Undergrad";
			else {
				if($userinfo['youngadult'] == 2) echo "Young Adult";
				else if($userinfo['youngadult'] == 3) echo "Graduate Student";
			}
			?>
                        </font></td>
                      <td width="54"><font size="1" face="Verdana, Arial, Helvetica, sans-serif"><a href="myinfo.php">incorrect?</a>
                        </font></td>
                    </tr>
-->

                    <tr>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Email:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <?=$userinfo['email']?>
                        </font></td>
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>
                    <tr>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Cell
                        Phone:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <?=$userinfo['cphone']?>
                        </font></td>
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>

                    <tr>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>
                        School:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <?=$userinfo['school']?>
                        </font></td>
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>

                    <tr>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>
                        Class:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <?=$userinfo['class']?>
                        </font></td>
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                        </font></td>
                    </tr>

                    <tr>
                    <?
                    if($group_id != NULL) {
			    $groupname_q = $db_object->query("SELECT name FROM Groups WHERE group_id=".$group_id['group_id']);
			    if(DB::isError($groupname_q)) {

				die($groupname_q->getMessage());
					}
			    $groupname = $groupname_q->fetchRow();
			}
		    ?>
<!--
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Family
                        Group:</strong></font> </td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                      <input name="familygroup" type="hidden" value="<?=$familygroup?>">
                        <?
				  if ($group_id == NULL){
				  ?>
                        <font color="#FF0000" size="3" face="Verdana, Arial, Helvetica, sans-serif">
                        <strong>NONE</strong></font>
                        <?
				  }else{
				  ?>
                        <?=$groupname['name']?>
                        <?							}?>
                        </font></td>
-->
                      <td><font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                         </font></td>
                    </tr>
                   <!-- 
				   <tr>
                      <td height="19"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Ride:</strong></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                        <? 							if ($check['ride']==-1){								echo "I need a ride.";								}elseif($check['ride']==0){								echo "I don't need a ride, but I do not have extra space.";								}else{								echo "Can provide for ".$check['ride']." person(people).";							}				?>
                        </font></td>
                      <td>&nbsp;</td>
                    </tr>
					-->
                    <?		if($check['comments'] != "") {				?>
                    <tr> 
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><B> 
                        <?=$event['commenttxt']?>
                        :</B></font></td>
                      <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <?=$check['comments']?>
                        </font></td>
                    </tr>
                    <? }				?>
                  </table></td>
                <td>&nbsp;</td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
               <!--
			   <td><div align="center"><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>If 
                    the &quot;RIDE&quot; information above is incorrect, please 
                    cancel your registration and signup again.</strong></font><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input name="event_id" type="hidden" id="event_id" value="<?=$event_id?>">
                    </font></div></td>
                <td>&nbsp;</td>
				-->
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <BR>
                    <input name="Submit" type="submit" value="Remove My signup from the database.">
                    <input name="part_id" type="hidden" value="<?=$check['particip_id']?>">
                    </font></div></td>
                <td>&nbsp;</td>
              </tr>
              </table></td>
              <?php 		  } 		   ?>
              <tr>
                <td>&nbsp;</td>
                <td><font color="#0000FF" size="3">
                </form>
                  <?						}else{					?>
                  <BR><BR><CENTER>
                  </font><font size="3"><font color="#FF0000" size="4" face="Verdana, Arial, Helvetica, sans-serif"><strong>Online 
                  signup for this event is closed.</strong></font></font> </CENTER><font color="#0000FF" size="3"><BR>
                  </table></td>
                  <?						}					?>
                  </font> <font color="#0000FF" size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>&nbsp;</strong></font></td>
                <td>&nbsp;</td>
              </tr>
            </table>

<?php include('../footer.html'); ?>
