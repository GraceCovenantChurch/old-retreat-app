<?php

include('authenticate.php');	// authentication script. ?>

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

   <?php
$group_id_q = $db_object->query("SELECT group_id FROM Members WHERE user_id = '".$_SESSION['user_id']."'");
if(DB::isError($db_object)) {
  die($group_id_q->getMessage());
}
$group_id = $group_id_q->fetchRow();

if ($group_id == NULL){?>
<h4>Main Login Page</h4><br>

  <font color="#FF0000" size="3" face="Verdana, Arial, Helvetica, sans-serif"> 
    <strong><em>According to our records, your GCC web account 
    is NOT connected to a family group. Please add yourself 
    to a family group by clicking <a href="groups.php">HERE</a></em></strong></font> 
  <br>
  <?}?>
  <TABLE border = "0">
    <TR> 
      <TD align = "center"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Welcome 
            back, <font color="#0000FF"> 
              <?=$_SESSION['username']?>
            </font>!</strong></font> 
      </TD>
    </TR>
  </TABLE>
  <table width="538" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td width="40">&nbsp;</td>
        <td width="10">&nbsp;</td>
        <td><p> 
            <?php
	       $query = "SELECT * FROM Groups";
	       $rs = $db_object->query($query);
	    if(DB::isError($rs)) {
	    die('database error.');	}
	    ?>
            <table border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFF33">
              <!--DWLayoutTable-->
              <tr> 
                <td align="left" valign="top"> <strong><font color="#000000" size="3" face="Verdana, Arial, Helvetica, sans-serif">My 
                      Groups and Ministries:</font></strong></td>
              </tr>
              <?php		while($result = $rs->fetchRow()){					$query2 = "SELECT * FROM Members WHERE user_id = '".$_SESSION['user_id']."' AND group_id = '".$result['group_id']."' ";			$rs2 = $db_object->query($query2);			if(DB::isError($rs2)) {				die('database error.');			}			$check = $rs2->fetchRow();				if ($check != NULL){				$ok = 100;		?>
              <tr> 
                <td valign="top" bordercolor="#FFFFFF"> <table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td> <BR>
                        <strong><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <?=$result['name'] ?>
                      </font> </strong> </td>
                    </tr>
                    <tr> 
                      <td><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="members.php?id=<?=$result['group_id']?>">details</a></font> 
                      </strong></td>
                    </tr>
                    <tr> 
                      <td colspan=2><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          Announcements: </font></td>
                    </tr>
                    <td colspan = 2>&nbsp; </td>
                </table></td>
              </tr>
              <?			}		}		if ($ok != 100) {			?>
              <font size="6" face="Verdana, Arial, Helvetica, sans-serif"><strong>Please 
                  add a family group to your account by selecting "details" 
                  from the list below.</strong></font><br>
              <br>
              <?		}	$query = "SELECT * FROM Groups WHERE type = 1 OR type = 2";		$rs = $db_object->query($query);	if(DB::isError($rs)) {		die('database error.');	}	?>
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
            <table border="0" cellpadding="0" cellspacing="0" bordercolor="#66FFFF">
              <!--DWLayoutTable-->
              <tr> 
                <td align="left" valign="top"> <strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif">All 
                      Family Groups: </font></strong></td>
              </tr>
              <?php	while($result = $rs->fetchRow()){	?>
              <tr> 
                <td valign="top" bordercolor="#FFFFFF"> <table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td> <BR>
                        <strong><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <?=$result['name'] ?>
                      </font> </strong> </td>
                    </tr>
                    <tr> 
                      <td><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="members.php?id=<?=$result['group_id']?>">details</a></font> 
                      </strong></td>
                    </tr>
                    <tr> 
                      <td colspan=2><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          Contact: </font></td>
                    </tr>
                    <td colspan=2>&nbsp; </td>
                  </table>
                  <?		}	?>
                </td>
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
            <?php	$query = "SELECT * FROM Groups WHERE type = 3";		$rs = $db_object->query($query);	if(DB::isError($rs)) {		die('database error.');	}	?>
            <table border="0" cellpadding="0" cellspacing="0" bordercolor="#66FF66">
              <!--DWLayoutTable-->
              <tr> 
                <td align="left" valign="top"> <strong><font size="3" face="Verdana, Arial, Helvetica, sans-serif">All 
                      Ministries: </font></strong></td>
              </tr>
              <?php	while($result = $rs->fetchRow()){	?>
              <tr> 
                <td align="center" valign="top" bordercolor="#FFFFFF"> <table border="0" cellpadding="0" cellspacing="0">
                    <tr> 
                      <td> <BR>
                        <strong><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                            <?=$result['name'] ?>
                      </font> </strong> </td>
                    </tr>
                    <tr> 
                      <td><strong> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="members.php?id=<?=$result['group_id']?>">details</a></font> 
                      </strong></td>
                    </tr>
                    <tr> 
                      <td colspan=2><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          Contact: </font></td>
                    </tr>
                    <td colspan=2>&nbsp; </td>
                  </table>
                  <?php	}?>
                </td>
              </tr>
            </table>
          <p></p></td>
        <td width="15">&nbsp;</td>
        <td width="40">&nbsp;</td>
      </tr>
  </table></td>
</tr>
<? } }?>
</table>

<?php include('../footer.html'); ?>
