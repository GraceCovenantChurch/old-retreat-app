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

function echo_tabs() {
  $tabs = array(
    "Sign Up" => "index.php",
    "Log in" => "login.php",
    "Info" => "info.php"
  );
  
  $currentPage = basename(htmlentities($_SERVER["PHP_SELF"]));
  if($currentPage == "") {
    $currentPage = "index.php";
  }

  $str = '<ul class="tab-nav">';
  foreach($tabs as $name => $link) {
    $str .= "      <li";
    if($currentPage == $link) {
        $str .= ' class="selected"';
    }
    $str .= "><a href='$link'>$name</a></li>";
  }
  $str .= '</ul>';

  echo $str;
}
?>

<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="../home/style.css" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
<?php
if ($js) {
echo <<<EOF
<script language="javascript">
$js
</script>
EOF;
}
$prefix = ".";
$curFile = $_SERVER['SCRIPT_NAME'];
$curFile = substr($curFile,strrpos($curFile,'/')+1);
$isHome = false;

if ($extra_header) { echo $extra_header."\n"; } 
?>

</head>

<?php include('./header.html'); ?>
<?php include('./sidebar.html'); ?>
<table id="widemaintable">
  <tr>
    <td valign="top">
	<h4>COLLEGE RETREAT 2017</h4>
        <br>
