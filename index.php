<?php
header("Location: http://ucity.gracecovenant.net");
die();
?>
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
  //caption height
  //----------------------------------------
  
  
  $passion_slide = array(
        "Passion Conference 2012: Awaken - Promo Video",
        '',
        "images/slides/passion_2012_promo_thumb.jpg",
        '',
        '',
        '<iframe width="500" height="335" src="http://www.youtube.com/embed/1Q3ceKyb58s" frameborder="0" allowfullscreen></iframe>',
        ''
        );
  $mp_slide = array(
        "Friday Morning Prayer",
        "images/slides/fmp.jpg",
        "images/slides/fmp_thumb.jpg",
        '',
        '',
        '',
        ''
        );
  $passion2013_slide = array(
        "Passion 2013: Encountering the Holy Spirit",
        "images/slides/passion2013.jpg",
        "images/slides/passion2013_thumb.jpg",
        '',
        '',
        '',
        ''
        );
  $upcoming_slide = array(
        "Upcoming Services",
        "images/slides/upcoming_services.jpg",
        "images/slides/upcoming_services_thumb.jpg",
        '',
        '',
        '',
        ''
        );
  $feast_slide = array(
        "Feasting, Fasting, and Prayer Calendar",
        "images/slides/feast-fast-cal.jpg",
        "images/slides/feast-fast-cal_thumb.jpg",
        'misc/feast-fast-cal.pdf',
        'Join us for Feasting, Fasting, and Prayer to start off the year!',
        '',
        '45px'
        );
  $womens_slide = array(
        "Women's Large Group",
        "images/slides/womens_large_group.jpg",
        "images/slides/womens_large_group_thumb.jpg",
        '',
        '',
        '',
        ''
        );
  $passionweek_slide = array(
        "Passion Week",
        "images/slides/passionweek2013.jpg",
        "images/slides/passionweek2013_thumb.jpg",
        '',
        '<a href="devotionals/passionweek.php">Passion Week Devotionals and Readings</a>',
        '',
        '45px'
        );
  $dailydevotional_slide = array(
        "Daily Devotionals",
        "images/slides/dailydevotionals.jpg",
        "images/slides/dailydevotionals_thumb.jpg",
        'http://devotionals.gracecovenant.net',
        '',
        '',
        ''
        );
  $easter_kickoff_slide = array(
        "Easter Kickoff Service",
        "images/slides/easter_kickoff.jpg",
        "images/slides/easter_kickoff_thumb.jpg",
        '',
        'FNL is at Meyerson! (<a href="./about/directions/meyersonmap.php">Directions</a>)',
        '',
        '45px'
        );
  $pn_slide = array(
        "Praise Night",
        "images/slides/pn2013.jpg",
        "images/slides/pn2013_thumb.jpg",
        '',
        '',
        '',
        ''
        );
  $thanksgiving_quotes_slide = array(
        "Thanksgiving 2012 Responses",
        "images/slides/thanksgiving_quotes.jpg",
        "images/slides/thanksgiving_quotes_thumb.jpg",
        'misc/thanksgiving_quotes.php',
        'Click above to see more Thanksgiving responses.',
        '',
        '45px'
        );
  $ocg_slide = array(
        "Operation Christmas Gift",
        "images/slides/ocg_2012.jpg",
        "images/slides/ocg_2012_thumb.jpg",
        '',
        'Collection date is 12/2 - <a href="misc/files/Operation_Christmas_Gift_2012.pdf">Brochure</a>',
        '',
        '45px'
        );
  $college_bowling_slide = array(
        "College Thanksgiving Potluck",
        "images/slides/bowling_2013.jpg",
        "images/slides/bowling_2013_thumb.jpg",
        '',
        'RSVP on this <a href="https://www.facebook.com/events/292847144195405/" target="_blank">facebook event</a> or let your FG servant know!',
        '',
        '45px'
        );
  $fnl_slide = array(
        "Friday Night Live",
        "images/slides/2014-02-21_fnl.jpg",
        "images/slides/2014-02-21_fnl_thumb.jpg",
        '',
        '',
        '',
        ''
        );
  $minios_slide = array(
        "MiniOs 16",
        "images/slides/minios16.jpg",
        "images/slides/minios16_thumb.jpg",
        '',
        '',
        '<a href="https://www.facebook.com/events/440027826113251/" target="_blank"><img src="./images/slides/minios16.jpg" border="0"/></a>',
        ''
        );
  $fg_slide = array(
        "Family Groups",
        './images/slides/fgsignup.jpg',
        "./images/slides/fgsignup_thumb.jpg",
        '',
        '<a href="ministries/familygroups.php">What are family groups?</a> - <a href="/fg/">College Signup</a> - <a href="/fg/ya.php">YA Signup</a>',
        '',
        '45px'
        );
  $mey_slide = array(
        "Sunday Service is at Meyerson Hall",
        './images/slides/mey_service.jpg',
        "./images/slides/mey_service_thumb.jpg",
        'about/directions/meyersonmap.php',
        '',
        '',
        ''
        );
  $somnt_slide = array(
        "School of Ministry and Theology",
        './images/slides/somnt.jpg',
        "./images/slides/somnt_thumb.jpg",
        'somnt/',
        '',
        '',
        ''
        );
  $rainey_slide = array(
        "Sunday Service is at Rainey Auditorium",
        './images/slides/2013rainey.jpg',
        "./images/slides/2013rainey_thumb.jpg",
        'about/directions/raineymap.php',
        '',
        '',
        ''
        );
  $welcome_slide = array(
	"Welcome!",
	'./images/slides/uc.jpg',
	"./images/slides/uc_thumb.jpg",
	'',
   '<b>Sunday service</b> - 11:15am at <font color="red"><b>Meyerson</b></font> (<a href="about/directions/meyersonmap.php">map</a>)',
        '',
	'45px'
	);
  $newcomer_slide = array(
    	"Newcomer Info",
	'./images/slides/newcomer.jpg',
	"./images/slides/newcomer_thumb.jpg",
	'./about/newcomers.php',
	'',
	'',
	''
	);
  $college_retreat_slide = array(
        "Collge Retreat 2014",
        './images/slides/college_retreat_2014.jpg',
        "./images/slides/college_retreat_2014_thumb.jpg",
        '',
        '<a href="multimedia/audioseries.php?series=50&year=2014">Messages: Audio</a> | <a href="http://www.youtube.com/playlist?list=PLFs-pEI2pcj7vggKPd92AYcUMmDJSXl1O" target="_blank">Messages: Video</a> | <a href="https://plus.google.com/photos/111069949203933616981/albums/5975916249706974577" target="_blank">Pictures</a>',
        '',
        '45px'
        );
  $ya_retreat_slide = array(
        "YA Retreat 2014",
        './images/slides/2014-02-09_xrr.jpg',
        "./images/slides/ya_retreat_2014_thumb.jpg",
        'https://sites.google.com/site/gcccrossroadretreat2014/home',
        '',
        '',
        '45px'
        );
  $sermons_slide = array(
	"Audio Sermons",
	'./images/slides/audio_sermons2.jpg',
	"./images/slides/headphones_thumb.jpg",
	'',
	'<a href="multimedia/audiosermons.php">Sunday sermons</a>',
	'',
	'45px'
	);
  $ami_rev_slide = array(
        "AMI Revolution",
        'images/slides/amirev2013.jpg',
        "images/slides/amirev2013_thumb.jpg",
        '',
        '',
        '<a href="http://2013.amirevolution.com/gcc" target="_blank"><img src="./images/slides/amirev2013.jpg" border="0"/></a>',
        ''
        );
  $mandate_slide = array(
        "626 Mandate",
        'images/slides/626_mandate.jpg',
        "images/slides/626_mandate_thumb.jpg",
        '',
        '',
        '<a href="http://626mandate.com/626Mandate/Default.aspx" target="_blank"><img src="./images/slides/626_mandate.jpg" border="0"/></a>',
        ''
        );
  $pn_slide = array(
        "Praise Night",
        'images/slides/praise_night.jpg',
        "images/slides/praise_night_thumb.jpg",
        '',
        '',
        '<a href="https://www.facebook.com/events/806167099397247/" target="_blank"><img src="./images/slides/praise_night.jpg" border="0"/></a>',
        ''
        );
  $blog_slide = array(
	"Pastor Young's Blog",
	'./images/slides/blog.jpg',
	"./images/slides/blog_thumb.jpg",
	'http://www.xanga.com/passionprayerpurity',
	'',
	'<a href="http://www.xanga.com/passionprayerpurity" target="_blank"><img src="./images/slides/blog.jpg" border="0"/></a>',
	''
	);	
  $mem_slide = array(
        "Membership Class",
        './images/slides/2013membership.jpg',
        "./images/slides/2013membership_thumb.jpg",
        '',
        'Sign up after service or <a href="https://docs.google.com/forms/d/1ZGqfOfV3iDowCzKk1MWZMQkoS3Hw0gZ7LcJ4Uzs1FSY/viewform" target="_blank">here</a>!',
        '',
        '45px'
        );
  $thanks_slide = array(
   "Thanksgiving Potlucks",
        './images/slides/college_thanks.jpg',
        "./images/slides/college_thanks_thumb.jpg",
        '',
        '<a href="https://www.facebook.com/events/221454498028712/" target="_blank">fb event</a>',
        '',
        '45px'
        );
	
  $slides = array($welcome_slide, $pn_slide, $fnl_slide, $fg_slide, $somnt_slide, $sermons_slide);
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
   <div style="height:275px;">&nbsp;</div>
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
