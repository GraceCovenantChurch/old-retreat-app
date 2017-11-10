<?php
  //message processor.
if($_REQUEST['activity']!=NULL){
  if($_REQUEST['status']=="ok"){
    switch ($_REQUEST['activity']) {
    case "eventplus":
      $msg = "You have successfully signed up for this event!";
      $msg .= "<BR><BR>A confirmation email has been sent to your email account.";
      $location = "events.php";
      break;
    case "eventminus":
      $msg = "You have canceled your signup successfully.";
      $msg .= "<BR><BR>A confirmation email has been sent to your email account.";
      $location = "events.php";
      break;
    case "groupplus":
      $msg = "You have joined this group successfully!";
      $location = "groups.php";
      break;
    case "groupminus":
      $msg = "You have successfully left this group.";
      $location = "groups.php";
      break;
    case "newuser":
      $msg = "Thank you for registering with Grace Covenant Church! Your information has been added to the database, and you may now login.";
      $msg .= "<BR><BR>A confirmation email has been sent to your email account.";
      $location = "index.php";
      break;
    case "updateinfo":
      $msg = "Your account information has been successfully updated.";
      $location = "main.php";
      break;
    case "logout":
      $msg = "You have successfully logged out.";
      $location = "index.php";
      break;
    case "survey":
      $msg = "You have successfully completed the survey!";
      $msg .= "<BR><BR>A confirmation email has been sent to your email account.";
      $location = "index.php";
      break;
    case "finance":
      $msg = "You have successfully submitted your information to the finance committee!";
      $msg .= "<BR><BR>A confirmation email has been sent to your email account.";
      $location = "main.php";
      break;
    }
  }else{
    $msg = "There was an unknown error. Please go back and try again.";
    $location = "main.php";
  }
}else{
  $msg = "Hey hey hey! Who told you to type in this URL? Now go back to the mainpage!";
  $location = "main.php";
}
?>

<HTML>
  <head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <META HTTP-EQUIV=Refresh CONTENT="2; URL=<?=$location?>"> 
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('../header.html'); ?>
<?php include('./sidebar.html'); ?>

<table width="100%" height="100%" cellspacing="8">
  <tr>
    <td width="433"><p><STRONG>Thank you for submitting your form! </STRONG>
        <BR>
        <BR>
        <font color="#FF0000" size="5"><strong> 
            <?=$msg?>
            <BR>
            <BR>
        </strong></font>You will be redirected in 2 seconds. :)<BR>
        If you are still here after 2 seconds, click <a href="<?=$location?>">here</a>.
	<br><br>
	<br><br>
	<br><br>
	<br><br>
    </p></td>
  </tr>
</table>
<?php include('../footer.html'); ?>
