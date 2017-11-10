<?php

include('authenticate.php');	// authentication script. ?>

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

<h4>Main Login Page</h4><br>
<?php
$group_id_q = $db_object->query("SELECT group_id FROM Members WHERE user_id = '".$_SESSION['user_id']."'");
if(DB::isError($db_object)) {
  die($group_id_q->getMessage());
}
$group_id = $group_id_q->fetchRow();
?>
    <h4><strong>Welcome back, <font color="#0000FF"> 
      <?=$_SESSION['username']?>
    </font>!</strong></h4>

  <?php
  $uid = $_SESSION['user_id'];

$numgroups_serving = 0;
$numgroups_member = 0;
$my_sgroups = array( );

// is a servant?
$sgroup_id_q = $db_object->query("SELECT Members.group_id, name FROM Members, Groups WHERE Members.user_id = $uid AND Members.group_id = Groups.group_id AND Members.type < 4");
if(DB::isError($db_object)) { die($sgroup_id_q->getMessage()); }
while ($sgroup_id = $sgroup_id_q->fetchRow())
{
  if (!isset($my_groups[$sgroup_id['group_id']])) {
    $numgroups_serving++;
    $my_groups[$sgroup_id['group_id']] = $sgroup_id['name'];;
  }
}

if ($numgroups_serving > 0) {
  // echo "<p>Groups you are serving in:<br>\n";
  echo "<ul>\n";
  foreach ($my_groups as $my_gid => $my_gname) {
    echo "  <li><strong>$my_gname</strong> [<a href='group.php?gid=$my_gid'>member page</a>] [<a href='group.php?gid=$my_gid&servant=1'>servant page</a>]</li>\n";
  }
  // echo "</ul>\n";
  
  // echo "<p>Groups you are a member of:<br>\n";
}

// groups they're a member of
$mgroup_id_q = $db_object->query("SELECT Members.group_id, name FROM Members, Groups WHERE Members.user_id = $uid AND Members.group_id = Groups.group_id AND Members.type >= 4");
if(DB::isError($db_object)) { die($mgroup_id_q->getMessage()); }
if ($numgroups_serving == 0) {
  echo "<ul>\n";
}
while ($mgroup_id = $mgroup_id_q->fetchRow())
{
  if (!isset($my_groups[$mgroup_id['group_id']])) {
    $numgroups_member++;
    $my_gname = $mgroup_id['name'];
    $my_gid = $mgroup_id['group_id'];
    $my_groups[$my_gid] = $my_gname;
    echo "  <li><a href='group.php?gid=$my_gid'>$my_gname</a></li>\n";
  }
}
echo "</ul>\n";

?>
<br><br><br><br><br><br><br><br><br><br><br><br>
  </td>
 </tr>
</table>

<?php include('../footer.html'); ?>

</html>