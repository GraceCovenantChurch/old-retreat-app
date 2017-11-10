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

<table id="widemaintable">
 <tr>
  <td>
<?php 
  include('../home/dblogin.php');

  global $img_dir, $last_update;
  $last_update_qry = "SELECT DATE_FORMAT(last_update,'%M %D, %Y') FROM Announcements ORDER BY last_update DESC LIMIT 1";
  $last_update_res = mysql_query($last_update_qry);
  if ($last_update_row = mysql_fetch_array($last_update_res)) {
    $last_update = $last_update_row[0];
    $last_update = preg_replace('/([0-9])([snrt][tdh]),/', '$1<font size="-2"><sup>$2</sup></font>,', $last_update);
  }

   include('../subbox.php'); 
   start_subbox(740, 'orange',"Announcements - $last_update",'left','left','');

   $query = "SELECT text FROM Announcements WHERE site = 0 AND main = 1 ORDER BY id";
   echo "<ol>";
   $announcements = mysql_query($query);
   while ($ann = mysql_fetch_array($announcements)) {
     $val = $ann['text'];
     $val = str_replace("\n", "", $val);
     $val = str_replace("\r", "", $val);
     $val = str_replace("http://gracecovenant.net/aboutgcc/announcements.php", "about/announcements.php", $val);
     $val = str_replace("http://www.gracecovenant.net/aboutgcc/announcements.php", "about/announcements.php", $val);
     $val = rtrim($val);
     
     echo "	      <li>$val</li>\n";
   }
   echo "</ol>";
   end_subbox('orange','');
   echo "</td></tr><!--tr><td>";
   start_subbox('100%','orange','Morning Prayer Schedule','right','left','');
?>
    <ul>
      <li>Wednesday 7:00am at Ralston House [<a href="directions/ralstonhouse.php">map</a>]</li>
    </ul>
<?php end_subbox('orange',''); ?>
-->
  </td>
 </tr>
 <tr height="300"><td>&nbsp;</td></tr>


</table>
<?php include('../footer.html'); ?>

</HTML>
