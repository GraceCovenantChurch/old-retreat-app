<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('../../header.html'); ?>
<?php include('../sidebar.html'); ?>

<?php include('./picFuncs.php'); ?>
<?php include('../../subbox.php'); ?>

<table id="widemaintable">

<?php 
  yearLine(2014);

  $col = 0;

  $col = newAlbum('GCC College Retreat: Intimacy with Jesus', 'https://plus.google.com/photos/111069949203933616981/albums/5975916249706974577', 'https://lh6.googleusercontent.com/id2dplsstLPRhAbXr1kagcRxh5ZUDY54X8DeVPSNSZqB=w338-h224-p-no', 'Jan 31-Feb 2, 2014', $col);
  
  $col = newAlbum('Crossroad Retreat: Let the River Flow', 'https://plus.google.com/photos/111069949203933616981/albums/5981605952313887569', 'https://lh5.googleusercontent.com/-alWssLm54s0/UwLu6_YIC1E/AAAAAAAAfdQ/PzPPAYWQZwE/w378-h256-p/CrossroadsRetreat2014', 'Feb 14-15, 2014', $col);

  $col = newAlbum('Praise Night', 'https://plus.google.com/photos/111069949203933616981/albums/5983473857886358529', 'https://lh5.googleusercontent.com/-_-bUd98HeEg/UwmRxZ4nDAE/AAAAAAAAfdY/iChpIXNMTgw/w378-h256-p/PraiseNight2014', 'Feb 22, 2014', $col);

  $col = newAlbum('Easter Sunday', 'https://plus.google.com/photos/111069949203933616981/albums/6005583669142778097', 'https://lh3.googleusercontent.com/-IrkpB9iSG4s/U1gehzQkcPE/AAAAAAAAh6Q/UTt06OoDrkg/w424-h294-p/Easter2014', 'Apr 20, 2014', $col);

  $col = newAlbum('Baptism Sunday', 'https://plus.google.com/photos/111069949203933616981/albums/6007073976893529345', 'https://lh4.googleusercontent.com/-vt1T5-lB-pk/U11p9IQ7XQE/AAAAAAAAh6M/eMK0h19nvsM/w424-h294-p/BaptismSunday2014', 'Apr 27, 2014', $col);

  $col = newAlbum('Grad Night', 'https://plus.google.com/photos/111069949203933616981/albums/6009018368205503089', 'https://lh5.googleusercontent.com/-Qwuw09-iLec/U2RSXmWvunE/AAAAAAAAh6Y/TCPTOHEZ2AQ/w424-h294-p/GradNight2014', 'May 1, 2014', $col);

  $col = newAlbum('College Hiking Trip', 'https://plus.google.com/photos/111069949203933616981/albums/6039750172664248417', 'https://lh6.googleusercontent.com/-7RkZQhujorI/U9GAyDXBuGE/AAAAAAAAiHI/PO77dIdf86c/w428-h296-p/SummerHikingTrip2014', 'July 19, 2014', $col);

  echo '<td width="180">&nbsp;</td>';
  endAlbums($col);
?>

<?php include('../../footer.html'); ?>

</HTML>

