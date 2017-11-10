<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
  <script language="JavaScript" src="/menu.js"></script>
  <script type="text/javascript">

function onLoad() {
  show_details("february2014");
}

function show_details($month) {
    $("#" + $month + "details").slideToggle("fast");
    $("#" + $month + "details:not(:contains('-'))").load($month + ".php");
    return false;
}

$(document).ready(function(){
  $("a.monthlink").click(function(){
    return show_details($(this).attr('id'));
  });
});

  </script>
  <style type="text/css">
    .details { display: none }
  </style>
</head>

<?php include('../header.html'); ?>
<?php include('../sidebar.html'); ?>

<table id="widemaintable">
 <tr>
  <td>
    <h4>Bible Reading Plan</h4><br><br>

<p>Please join us as we go through the Word together!</p>

<ul>
  <li><b><a href="#" id="february2014" class="monthlink">February 2014: 1 Corinthians 1-16, Daniel 1-12</a></b>
    <div id="february2014details" class="details"></div>
  </li>
  <li><a href="#" id="january2014" class="monthlink">January 2014: Romans 1-16, Mark 1-16</a>
    <div id="january2014details" class="details"></div>
  </li>
  <li><a href="#" id="december2013" class="monthlink">December 2013: Hebrews 1-13, James 1-5, 1 Peter 1-5, 2 Peter 1-3, 1 John 1-5, 2 John 1</a>
    <div id="december2013details" class="details"></div>
  </li>
  <li><a href="#" id="november2013" class="monthlink">November 2013: Acts 1-28, Psalm 14-15</a>
    <div id="november2013details" class="details"></div>
  </li>
  <li><a href="#" id="october2013" class="monthlink">October 2013: Revelation 1-22, Psalm 3-11</a>
    <div id="october2013details" class="details"></div>
  </li>
  <li><a href="#" id="september2013" class="monthlink">September 2013: Matthew 1-28, Psalm 1-2</a>
    <div id="september2013details" class="details"></div>
  </li>
  <li><a href="#" id="august2013" class="monthlink">August 2013: Jeremiah 32-51, Amos 1-9, Obadiah 1, Philemon 1</a>
    <div id="august2013details" class="details"></div>
  </li>
  <li><a href="#" id="july2013" class="monthlink">July 2013: Jeremiah 1-31</a>
    <div id="july2013details" class="details"></div>
  </li>
  <li><a href="#" id="june2013" class="monthlink">June 2013: Proverbs 1-30</a>
    <div id="june2013details" class="details"></div>
  </li>
  <li><a href="#" id="may2013" class="monthlink">May 2013: 1 Kings 1-22, 1 Thessalonians 1-5, 2 Thessalonians 1-3, Proverbs 31</a>
    <div id="may2013details" class="details"></div>
  </li>
  <li><a href="#" id="april2013" class="monthlink">April 2013: 2 Samuel 1-24, Micah 1-7</a>
    <div id="april2013details" class="details"></div>
  </li>
  <li><a href="#" id="march2013" class="monthlink">March 2013: 1 Samuel 1-31</a>
    <div id="march2013details" class="details"></div>
  </li>
  <li><a href="#" id="february2013" class="monthlink">February 2013: 1 Corinthians 1-16, 2 Corinthians 1-11</a>
    <div id="february2013details" class="details"></div>
  </li>
  <li><a href="#" id="january2013" class="monthlink">January 2013: Galatians 1-6, Ephesians 1-6, Philippians 1-4, Colossians 1-4, Philemon 1, 1 Timothy 1-6, 2 Timothy 1-4</a>
    <div id="january2013details" class="details"></div>
  </li>
  <li><a href="#" id="december2012" class="monthlink">December 2012: Luke 1-24, 1 Peter 1-5, 2 Peter 1-3</a>
    <div id="december2012details" class="details"></div>
  </li>
  <li><a href="#" id="november2012" class="monthlink">November 2012: Matthew 1-28, Phillipians 1-4</a>
    <div id="november2012details" class="details"></div>
  </li>
  <li><a href="#" id="october2012" class="monthlink">October 2012: Proverbs 1-31, Ecclesiastes 1-12</a>
    <div id="october2012details" class="details"></div>
  </li>
  <li><a href="#" id="september2012" class="monthlink">September 2012: Proverbs 1-30</a>
    <div id="september2012details" class="details"></div>
  </li>
  <li><a href="#" id="august2012" class="monthlink">August 2012: Exodus 1-31</a>
    <div id="august2012details" class="details"></div>
  </li>
  <li><a href="#" id="july2012" class="monthlink">July 2012: Genesis 31-50, Psalms 12-22</a>
    <div id="july2012details" class="details"></div>
  </li>
  <li><a href="#" id="june2012" class="monthlink">June 2012: Genesis 1-30</a>
    <div id="june2012details" class="details"></div>
  </li>
  <li><a href="#" id="may2012" class="monthlink">May 2012: Revelation 1-22, Psalm 3-11</a>
    <div id="may2012details" class="details"></div>
  </li>
  <li><a href="#" id="april2012" class="monthlink">April 2012: Acts 1-28, Psalm 1-2</a>
    <div id="april2012details" class="details"></div>
    <!--ul>
      <li><a href="passionweek.php">Passion Week 2012</a></li>
    </ul-->
  </li>

</ul> 

  </td>
 </tr>
</table>
<?php include('../footer.html'); ?>
</HTML>

