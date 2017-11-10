<?php
include_once('db_verify.php');
unset($_SESSION['USER']);
unset($_SESSION['PASS']);
$newtime = mktime(0,0,0,7,4,2007);
setcookie('admin_user',FALSE,$newtime,"/admin/", ".amirevolution.com");
setcookie('admin_pass','newpass',$newtime,"/admin/", ".amirevolution.com");

$title = "Admin Interface";
include_once('../header.php');

echo <<<EOF

<table width="100%">
 <tr>
  <td style="text-align: right">$links</td>
 </tr>
</table>

<p>You have logged out.
EOF;

include_once('../footer.php');
?>
