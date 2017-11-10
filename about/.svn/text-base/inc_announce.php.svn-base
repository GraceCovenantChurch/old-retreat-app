<?php

function ann_write_main_header()
{
  global $img_dir, $last_update;
  $last_update_qry = "SELECT DATE_FORMAT(last_update,'%M %D, %Y') FROM Announcements ORDER BY last_update DESC LIMIT 1";
  $last_update_res = mysql_query($last_update_qry);
  if ($last_update_row = mysql_fetch_array($last_update_res)) {
    $last_update = $last_update_row[0];
    $last_update = preg_replace('/([0-9])([snrt][tdh]),/', '$1<font size="-2"><sup>$2</sup></font>,', $last_update);
  }

  if (!isset($img_dir)) {
    $img_dir = '/aboutgcc/images';
  }
  echo <<<EOF
<p class="heading">ANNOUNCEMENTS 
         - $last_update</p>

   <ol>

EOF;
}

function ann_write_main_announce($str)
{
  echo "	<li>$str</li>\n";
}

function ann_write_main_footer()
{
  echo "</ol>";
}

?>