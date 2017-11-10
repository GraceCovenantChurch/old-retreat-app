<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./home/style.css" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('./header.html'); ?>
<?php include('./sidebar.html'); ?>
<table width="556" cellspacing="8">
  <tr>
    <td valign="top"><a href="uncovered.php"><img src="/images/fnluncovered.jpg" width="324" border="0"><br>
	             <p align="center"><a href="uncovered.php">Uncovered FNL series information</a></p></td>
    <td rowspan="2" align="right" valign="top">
<?php 
   include('./subbox.php');
   start_subbox(204,'orange','announcements','right','left',''); 
?>
	    <ul class="small">
<?php
include('home/dblogin.php');
$table = 'Announcements'; $site = 0;

$query = "SELECT text FROM $table WHERE site = $site AND front = 1 ORDER BY id";
$announcements = mysql_query($query);
while ($ann = mysql_fetch_array($announcements)) {
  $val = $ann['text'];
  $val = str_replace("\n", "", $val);
  $val = str_replace("\r", "", $val);
  $val = str_replace("http://gracecovenant.net/aboutgcc/announcements.php", "about/announcements.php", $val);
  $val = str_replace("http://www.gracecovenant.net/aboutgcc/announcements.php", "about/announcements.php", $val);
  $val = rtrim($val);
    
  echo "<li>$val</li>";
}
  echo "</ul>";
   end_subbox('orange','');
?>
  </td></tr>
  <tr>
    <td>
<?php start_subbox(324,'orange','photo gallery','left','center','_fill'); ?>
      <table width="100%" cellspacing="0" cellpadding="0"><tr>
	  <td colspan="3" width="306" height="231" bgcolor="#000000"><div id="gallery_container"><table cellpadding=0 cellspacing=0 width="306" height="231"><tr><td valign="center" align="center"><div id="gallerydiv"><img id="gallery" src="/images/blank.gif"></div></td></tr></table><div id="gallerybg"></div></div></td>
	</tr><tr>
	  <td align="left"><h3 class="white"><a class="link" onclick="gallery_prev()"><img src="images/prev.gif" border="0" style="position: relative; top: 3px"></a></h3></td>
	  <td align="center"><h3 class="white"><a class="link" onclick="gallery_pause()"><img src="images/stop.gif" border="0" id="gallery_stop" style="position: relative; top: 3px"></a></h3></td>
	  <td align="right"><h3 class="white"><a class="link" onclick="gallery_next()"><img src="images/next.gif" border="0" style="position: relative; top: 3px"></a></h3></td>
      </tr></table>
<?php end_subbox('orange','_fill'); ?>
<script language="JavaScript" src="/gallery.js"></script>
    </td>
  </tr>
</table>
<?php include('./footer.html'); ?>
