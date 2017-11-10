<?php 
function rand_string($len, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
{
   $string = '';
   for ($i = 0; $i < $len; $i++)
   {
       $pos = rand(0, strlen($chars)-1);
       $string .= $chars{$pos};
   }
   return $string;
}
?>

<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="../home/style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" type="text/css" href="./style.css" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
  <script language="JavaScript" src="/menu.js"></script>

<?php
if ($js_files) {
  foreach($js_files as $js) {
    echo '<script language="JavaScript" src="' . $js . '"></script>';
  }
}

$prefix = ".";
$curFile = $_SERVER['SCRIPT_NAME'];
$curFile = substr($curFile,strrpos($curFile,'/')+1);
$isHome = false;

if ($extra_header) { echo $extra_header."\n"; } 
?>

</head>

<?php include('../header.html'); ?>
<?php include('../sidebar.html'); ?>
<table id="widemaintable">
  <tr>
    <td valign="top">
	<h4>UNITED IN CHRIST RETREAT 2013</h4>
        <br>
