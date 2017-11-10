<?php
  $user="gccweb";
  $pass="webuser";
  $host="mysql.gracecovenant.net";
  $dbname="gcc";
  $basedir="/home/gccweb/gracecovenant.net";
  
  $db = mysql_connect($host, $user, $pass);
  if (!$db) {
   print 'Could not connect: ' . mysql_error();
  }
  mysql_select_db($dbname);
  
  function closeDB() {
    global $db;
    mysql_close($db);
  }
  function isAdmin($user) {
    global $db;
    $res = mysql_query("SELECT 1 FROM Utils u, UtilsUsers s, UtilsUsers_Permissions p WHERE UserName='$user' AND s.UserID=p.UserID AND p.UtilID=u.ID AND u.desc='admin'");
    if ($row = mysql_fetch_assoc($res)) {
      return true;
    }
    return false;
  }
?>
