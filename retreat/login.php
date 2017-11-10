<?php
$title = "Log In";
include_once("gcc_header.php");

?>

<form method="post" action="logged_in.php">

<?php echo_tabs(); ?>
<p>
<table width=80% border=0 bgcolor="#2b2b2b" cellspacing=1 cellpadding=4 align="center">
 <tr bgcolor='#FFFFFF'>
  <td width='150' class='small'>Email</td>
  <td class='small'><input type='text' name='email' size='24' maxlength='50'></td>
 </tr>
 <tr bgcolor='#FFFFFF'>
  <td width='150' class='small'>Password</td>
  <td class='small'><input type='password' name='password' size='16' maxlength='31'> <a href="forgotpw.php">forgot your password?</a></td>
 </tr>
 <tr bgcolor='#FFFFFF'>
  <td colspan='2' align='center'><input type='submit' value='Log In'></td>
 </tr>
</table>
</form>

<?php
include_once("gcc_footer.php");
?>
