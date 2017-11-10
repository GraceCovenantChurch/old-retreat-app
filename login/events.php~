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

<h4>Events</h4><br>
<!--<?php
$group_id_q = $db_object->query("SELECT group_id FROM Members WHERE user_id = '".$_SESSION['user_id']."'");
if(DB::isError($db_object)) {
  die($group_id_q->getMessage());
}
$group_id = $group_id_q->fetchRow();
if ($group_id == NULL)
{?>
  <BR>
    <BR>
    <font color="#FF0000" size="3" face="Verdana, Arial, Helvetica, sans-serif"> 
    <strong><em>According to our records, your GCC web account 
    is NOT connected to a family group. Please add yourself 
    to a family group by clicking <a href="groups.php">HERE</a></em></strong>
    <br>
    <?} //end if group_id == NULL
?>
-->
    <h4><strong>Welcome back, <font color="#0000FF"> 
      <?=$_SESSION['username']?>!</strong></h4>

  <p>
  <?php
  $query = "SELECT * FROM Events";
$rs = $db_object->query($query);
if(DB::isError($rs)) {
  die('database error.');
}
?>
</p>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <!--DWLayoutTable-->
  <tr> 
    <td align="left" valign="top">
      <h4>My Events and Classes:</h4><br>
  <?php
  while($result = $rs->fetchRow())
  {
    $query2 = "SELECT * FROM Participants WHERE user_id = '".$_SESSION['user_id']."' AND event_id = '".$result['event_id']."' ";
    $rs2 = $db_object->query($query2);
    if(DB::isError($rs2)) {
      die('database error.');
    }			
    $check = $rs2->fetchRow();
    if ($check != NULL) 
    {
   ?>
  <table border="0" cellpadding="0" cellspacing="0" style="margin-left: 20px;">
    <tr> 
      <td> <strong><font color="#0000FF"> 
	    <?=$result['name'] ?>
      </font> </strong> </td>
    </tr>
    <tr> 
      <td> 
	<strong> 
	  <?php
	     if ($result['status']==1)
	     {
	     
	     ?>
	  <a href="signup.php?id=<?=$result['event_id']?>">View/change signup info</a>
	  <?						
	     } else {
	     ?>
	</strong>Online signup is closed.
	  <?						
	     }					
	     ?>
      </td>
    </tr>
    <tr> 
      <td colspan=2>
	  Dates: 
	  <?=date("l, F jS Y",strtotime ($result['stime']))?>
	  <?php					
	     if ($result['type']==1){					
	     ?>
	  - 
	  <?=date("l, F jS Y",strtotime ($result['etime']))?>
      </td>
    </tr>
    <?php						
       }					
       ?>
  </table><br>
  <?			
     }		
     }
     $query = "SELECT * FROM Events WHERE catagory = 1";

     // if you're me, show the "fake/in-progress" catagory item.
     if ($_SESSION['type'] == 5) {
	echo "<!-- super user -- you can see category 2 (test-registration) items. -->\n";
	$query .= " OR catagory = 2";
     }

     $rs = $db_object->query($query);	
     if(DB::isError($rs)) {		
	die('database error.');
     } 
     ?>
   <h4>All Events: </h4><br>
     <?php	while($result = $rs->fetchRow()){	?>
     <table border="0" cellpadding="0" cellspacing="0" style="margin-left: 20px;">
       <tr> 
         <td><strong><font color="#0000FF"> 
               <?=$result['name'] ?>
         </font> </strong> </td>
       </tr>
       <tr> 
         <td> <strong> 
             <?php		if ($result['status']==1){	?>
             <a href="signup.php?id=<?=$result['event_id']?>">view 
                 details/signup!</a>
             <?		}else{	?>
           </strong>Online signup is closed.<strong> 
             <?		}	?>
         </strong></td>
       </tr>
       <tr> 
         <td>
             Dates: 
             <?=date("l, F jS Y",strtotime ($result['stime']))?>
             <?php		if ($result['type']==1){	?>
             - 
             <?=date("l, F jS Y",strtotime ($result['etime']))?>
         </td>
       </tr>
       <td colspan=2>&nbsp; </td>
       <?php	}?>
     </table><br>
     <?		}	?>
     <?php
	if(isset($rs)) {
	while($result = $rs->fetchRow()){
     ?>
   <h4>All Classes: </h4><br>
   <?php	while($result = $rs->fetchRow()){	?>
   <table border="0" cellpadding="0" cellspacing="0">
     <tr> 
       <td bordercolor="#ccffcc"><strong><font color="#0000FF" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
             <?=$result['name'] ?>
       </font></strong></td>
     </tr>
     <tr> 
       <td> <strong> 
           <?php		if ($result['status']==1){	?>
           <font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="signup.php?id=<?=$result['event_id']?>">view 
               details/signup!</a></font> 
           <?		}else{	?>
         </strong><font size="1" face="Verdana, Arial, Helvetica, sans-serif">Online 
           signup is closed.</font> 
         <?		}	?>
       </td>
     </tr>
     <tr bordercolor="#FFFFFF"> 
       <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
           Dates: 
           <?=date("l, F jS Y",strtotime ($result['stime']))?>
           <?php		if ($result['type']==1){	?>
           - 
           <?=date("l, F jS Y",strtotime ($result['etime']))?>
           <?		}	?>
       </font></td>
     </tr>
     <tr bordercolor="#FFFFFF"> 
       <td colspan=2>&nbsp; </td>
   </table><br>
   <?php	}?>
  <? } }?>

  </td>
 </tr>
</table>

<?php include('../footer.html'); ?>
</html>