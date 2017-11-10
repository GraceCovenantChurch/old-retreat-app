<?php
include("gcc_header.php");
echo_tabs();
?>

Forgot your password?<br><br>

<form action="pwchange.php" method="POST">
<table bgcolor='#000000' border=0 cellspacing=1 cellpadding=4 width='80%' align="center">
 <tr bgcolor='#ffffff'>
  <td>Email</td>
  <td><input name="email" type="text" /></td>
 </tr>
 <tr bgcolor='#ffffff'>
   <td colspan="2" align="center"><input type="Submit" value="Submit" /></td>
 </tr>
</table>
</form>


<div style="height: 480px">&nbsp;</div>

<?php
include("gcc_footer.php");
?>