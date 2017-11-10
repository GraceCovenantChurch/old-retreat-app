<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('../header.html'); ?>
<?php include('./sidebar.html'); ?>

<table width="100%" height="100%" cellspacing="8">
          <td background="images/middle.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="361"><div align="left"> 
                    <p><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><em>DIRECTORY</em></font></strong><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><em> 
                      <?php
$group_id_q = $db_object->query("SELECT group_id FROM Members WHERE user_id = '".$_SESSION['user_id']."'");
if(DB::isError($db_object)) {
	die($group_id_q->getMessage());
}	$group_id = $group_id_q->fetchRow();

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
                      </font> </em></font></strong></p>
                  </div></td>
                <td width="130">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr> 
                <td colspan="3"><table width="538" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td width="60">&nbsp;</td>
                            <td><TABLE border = "0">
                                <TR> 
                                  <TD align = "center"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Welcome 
                                    back, <font color="#0000FF"> 
                                    <?=$_SESSION['username']?>
                                    </font>!</strong></font> </TD>
                                </TR>
                                <TR> 
                                  <td align="center" valign="top" bordercolor="#FFFFFF"> 
                                    <p><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong><a href="main.php"><br>
                                      Home</a> &#8226; <a href="myinfo.php">Account 
                                      info</a> &#8226; <a href="directory.php">Directory</a> 
                                      &#8226; <a href="events.php">Events &amp; 
                                      Classes</a> &#8226; <a href="groups.php">Groups</a> 
                                      &#8226; <a href="logout.php">Logout</a><br>
                                      <br>
                                      </strong></font></p></td>
                                </TR>
                              </TABLE></td>
                            <td width="60">&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                  </table></td>
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
                  <form action="<?=$HTTP_SERVER_VARS['PHP_SELF']?>" method="post">
                    <table border="0" cellpadding="0" cellspacing="0">
                      <!--DWLayoutTable-->
                      <tr> 
                        <td align="left" valign="top"> <strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif">Search 
                          the GCC directory!</font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <? if(isset($_POST['Submit'])){ 

?>
                          (again!) 
                          <? }

?>
                          </font></strong></td>
                      </tr>
				
			<tr> 
                        <td align="center" valign="top" bordercolor="#FFFFFF"> 
                          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
                          The directory is now searchable with partial matches.</font></td>
                      </tr>


                      <tr bordercolor="#FFFFFF"> 
                        <td align="center"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>First 
                          name :</strong></font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <input name="fname" type="text" id="fname" size="20" maxlength="50">
                          <BR>
                          <strong>Last name :</strong> 
                          <input name="lname" type="text" id="lname" size="20" maxlength="50">
                          </font></td>
                      </tr>
                      <tr bordercolor="#FFFFFF"> 
                        <td align="center" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <input name="Submit" type="submit" value="Search!">
                          </font></td>
                      </tr>
                    </table>
                  </form>
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
                  <table border="0" cellpadding="0" cellspacing="0">
                    <!--DWLayoutTable-->
                    <tr> 
                      <td align="center" valign="top"> <strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif"> 
                        Search Results:</font></strong></td>
                    </tr>
                  </table></td>
                <td width="15">&nbsp;</td>
                <td width="40">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td height="30" background="images/middle.jpg">&nbsp;</td>
        </tr>
        <?php
		if(isset($rs)) {
	while($result = $rs->fetchRow()){

	?>
        <tr> 
          <td height="30" background="images/middle2.jpg"><table width="538" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td width="40">&nbsp;</td>
                <td width="10">&nbsp;</td>
                <td><p> 
                  <table border="0" cellpadding="0" cellspacing="0" bordercolor="#FFCC00">
                    <tr align="left"> 
                      <td colspan="2" valign="top"> <strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong> 
			<!-- <?=$result['user_id'] ?> -->
                        <?=$result['fname'] ?>
                        <?=$result['lname'] ?>
                        &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:<?=$result['email'] ?>"> 
                        <?=$result['email']?>
                        </a></strong></font></strong></td>
                    </tr>
                    <tr> 
                      <td width="165" valign="top"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Birthday:</font></td>
                      <td width="428" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <?php

		if (($result['share']%100)%10 >= 1){

			echo $result['dob'];

		}else{

			echo "(birthday private)";

		}

            ?>
                        &nbsp;</font></td>
                    </tr>
                    <tr> 
                      <td width="165" valign="top"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">contact:</font></td>
                      <td width="428" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <?php

		if ($result['share']%100 >= 10){

			echo $result['address']."<br>".$result['city']."  ".$result['state'].", ".$result['zip']

		?>
                        <br>
                        <strong>home #:</strong> 
                        <?=$result['hphone'] ?>
                        <br>
                        <strong>cell #:</strong> 
                        <?=$result['cphone'] ?>
                        <br>
                        <strong>work/dorm #:</strong> 
                        <?=$result['wphone'] ?>
                        <br>
                        <strong>AIM/ICQ:</strong> <a href="aim:goim?screenname=<?=$result['im']?>"> 
                        <?=$result['im']?>
                        </a> </font> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <?

		}else{

		echo "(contact information private)";

		}

		?>
                        &nbsp;</font></td>
                    </tr>
                    <tr> 
                      <td width="165" valign="top"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Misc 
                        Info:</font></td>
                      <td width="428" valign="top"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                        <?php

		if ($result['share']/100 >= 1){

		echo "Work:".$result['work']."<br>"."School:".$result['school'].", class of ".$result['class'].".";

		}else{

		echo "(misc information private)";

		}

		?>
                        &nbsp;</font></td>
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
        <? } }?>
        <tr> 
          <td height="30" background="images/bottom.jpg">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
<?php include('../footer.html'); ?>

</HTML>

