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
  yearLine(2000);

  $col = 0;

  $col = newAlbum('Mini Olympics 2000','http://picasaweb.google.com/gcc.multimedia07/MiniOlympics2000','http://lh5.ggpht.com/gcc.multimedia07/SFwKLJPEFGI/AAAAAAAAF9w/N0YWsQ6J048/s160-c/MO75.jpg','', $col);

  $col = newAlbum('Group Photos from 2000','http://picasaweb.google.com/gcc.multimedia07/GroupPhotosFrom2000','http://lh4.ggpht.com/gcc.multimedia07/SFwLQ4wtb0E/AAAAAAAAGCY/gIQdq251Bmo/s160-c/GroupPhotosFrom2000.jpg','', $col);

  $col = newAlbum('Family Groups from 2000','http://picasaweb.google.com/gcc.multimedia07/FamilyGroupsFrom2000','http://lh4.ggpht.com/gcc.multimedia07/SFwL7ilxE1I/AAAAAAAAGDo/Pa0f2ABtQac/s160-c/penn1.jpg','', $col);

  endAlbums($col);
?>

<?php include('../../footer.html'); ?>

</HTML>

