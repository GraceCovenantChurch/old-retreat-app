<?php $handle=opendir('/home/gccweb/gracecovenant.net/home/images/blanks/login');

while (false !== ($file = readdir($handle))) { $images[] = $file;} closedir($handle); 
$rand = rand(2, count($images) - 1);
?>

<table width="232" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="23">&nbsp;</td>
          <td height="23">&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td><img src="/home/images/blanks/login/<?=$images[$rand]?>" width="164" height="334"></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><strong>Login</strong><br>
            -<a href="/alumniboards/" target="_blank">Alumni Boards</a><br>
            -<a href="/db/index.php">Directory</a><br>
            -Family Group Web Pages<br>
            -Sign Ups<br>
            </font></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
	  
	  
