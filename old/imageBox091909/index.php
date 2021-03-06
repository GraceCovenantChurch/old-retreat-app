<HTML>
<?php
  include "./imageBox.php"; 
  //-----format of a slide array-------
  //title
  //big image src
  //thumbnail src
  //link if you want to redirect from big image
  //caption if you want
  //html code to overide entire slide if you want
  //----------------------------------------
  $welcome_slide = array(
	"Welcome!",
	'./images/slides/uc.jpg',
	"./images/slides/uc_thumb.jpg",
	'',
	'Sunday service 11:15am at Meyerson - <a href="./about/directions/meyersonmap.php">Directions</a> - <a href="./about/calendar.php">Calendar</a>',
	''
	);
  $newcomer_slide = array(
    	"Newcomer Info",
	'./images/slides/newcomer.jpg',
	"./images/slides/newcomer_thumb.jpg",
	'./about/newcomers.php',
	'',
	''
	);
  $sermons_slide = array(
	"Audio Sermons",
	'./images/slides/audio_sermons2.jpg',
	"./images/slides/headphones_thumb.jpg",
	'',
	'<a href="./multimedia/audiosermons.php">Sunday sermons</a> - <a href="./multimedia/audiosermons.php?year=2009&type=F">FNL messages</a>',
	''
	);
  $blog_slide = array(
	"Pastor Young's Blog",
	'./images/slides/blog.jpg',
	"./images/slides/blog_thumb.jpg",
	'http://www.xanga.com/passionprayerpurity',
	'',
	'<a href="http://www.xanga.com/passionprayerpurity" target="_blank"><img src="./images/slides/blog.jpg" border="0"/></a>'
	);	
  $slides = array($welcome_slide, $newcomer_slide, $sermons_slide, $blog_slide);
?>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1" >
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="/imageBox.css" />
  <link rel="stylesheet" type="text/css" href="./home/style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
  <script language="JavaScript" src="./imageBox.js"></script>
   <?php fillJavaScript($slides);?>
</head>

<?php include('./header.html'); ?>
<?php include('./sidebar.html'); ?>
<table id="widemaintable">
 <tr>

 <td valign="top">
   <?php makeImageBox($slides);?>
   <br><br>
 </td>

 <td valign="top">
  <table cellpadding="4">
    <tr><td>
	<?php
		include('./subbox.php'); 
   		start_subbox('100%','orange','announcements','right','left',''); 
   		include('./announcements_front.html');
		end_subbox('orange','');
	?>
    </td></tr>
  </table>

</td></tr>
</table>

<?php include('./footer.html'); ?>