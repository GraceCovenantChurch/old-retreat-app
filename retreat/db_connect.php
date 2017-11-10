<?php
$link = mysql_connect("mysql.gracecovenant.net", "gccweb", "webuser");
if (!$link) { die("Error: can't connect to database: " . mysql_error()); }
$ret = mysql_select_db("gcc", $link);
if (!$ret) { die("Error: Database not found: " . mysql_error()); }

function escape_string($str)
{
  global $link;
  return mysql_real_escape_string($str, $link);
}

function get_field_types($res)
{
  $n = mysql_num_fields($res);
  $ret = array();
  for ($i=0; $i<$n; $i++)
  {
    $k = mysql_field_name($res,$i);
    $v = mysql_field_type($res,$i);
    $ret[$k] = $v;
  }
  return $ret;
}
?>
