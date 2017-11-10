<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
</head>

<?php include('../../header.html'); ?>
<?php include('../../sidebar.html'); ?>

<table id="widemaintable">
 <tr>
   <td>
     <p><b>JUDGES BIBLE STUDIES - SPRING 2012</b></p>
     <table cellpadding='10' style='border: 1px solid black'>
       <tr bgcolor='orange'><th> </th><th>Title</th><th>Passages</th><th>Study</th><th>Comments</th></tr>
<?php
$studies = array(
  array(
   "no" => "06",
   "title" => "The Ephraim Complex",
   "passages" => array(
       "Joshua 17:15-18",
       "Judges 1:27-29",
       "Judges 7:22 - 8:3",
       "Judges 12:1-6",
       "Psalm 78:9-11",
       "Ephesians 4:17-32"
     ),
   "study" => "Judges_S06_Servants.docx",
   "notes" => "Judges_T06.docx",
   "comments" => "Went over together on Feb 25."
  ),
  array(
   "no" => "07",
   "title" => "What May Not Appear as Sin Can Really Displease God",
   "passages" => array(
       "Judges 4:4-10, 14-22",
       "Judges 11:28-48"
     ),
   "study" => "Judges_S07_UC.docx",
   "pryunstudy" => "Judges_S07.docx",
   "notes" => "Judges_T07.docx",
   "comments" => "Did not go over together."
  ),
  array(
   "no" => "08",
   "title" => "Be Careful What You Sow, for You Will Reap It Later; You Can Count on That!",
   "passages" => array(
       "Judges 9:1-6, 16-20, 22-25, 39-49"
     ),
   "pryunstudy" => "Judges_S08.docx",
   "study" => "Judges_S08_UC.docx",
   "notes" => "Judges_T08.docx",
   "comments" => "Went over together on March 17."
  ),
  array(
   "no" => "09",
   "title" => "Seeking God's will for our lives: How can we discern it? ",
   "passages" => array(
       "Judges 6:11-24, 33-40",
       "Acts 16:6-10",
       "2 Cor. 6:14-15",
       "Romans 12:1-2"
     ),
   "pryunstudy" => "Judges_S09.docx",
   "study" => "Judges_S09_UC.docx",
   "notes" => "Judges_T09.docx",
   "comments" => "Went over together on March 24."
  ),
  array(
   "no" => "Easter",
   "title" => "Easter Study",
   "passages" => array(
       "John 19:17-30"
     ),
//   "pryunstudy" => "John19_UC.doc",
   "study" => "John19_UC.doc",
   "notes" => "John19_notes.doc",
   "comments" => "Went over together on March 31."
  ),
  array(
   "no" => "10",
   "title" => "Foolish mistakes we make when we are spiritually high: Why do we do this?",
   "passages" => array(
       "Judges 8:22-27",
       "Judges 9:33-34",
       "2 Kings 6:5-6"
     ),
   "pryunstudy" => "Judges_S10.docx",
   "study" => "Judges_S10_UC.docx",
   "notes" => "Judges_T10.docx",
   "comments" => "Went over together on April 8."
  ),
  array(
   "no" => "11",
   "title" => 'A "Buffet Style" Christianity: Negotiables & Non-Negotiables of Christian doctrines',
   "passages" => array(
      "2 Sam. 6",
      "Judges 17:1-13"
   ),
   "pryunstudy" => "Judges_S11.docx",
   "study" => "Judges_S11_UC.docx",
   "notes" => "Judges_T11.docx",
   "comments" => "Did not go over together."
  ),
  array(
   "no" => "End of Year",
   "title" => 'Running the Race',
   "passages" => array(
      "Hebrews 12:1-2"
   ),
//   "pryunstudy" => "Judges_S11.docx",
   "study" => "BibleStudy_Heb12_2012-04-22.docx",
   "notes" => "BibleStudy_Heb12_2012-04-22_notes.docx",
   "comments" => "Did not go over together."
  )
);

foreach ($studies as $study) {
  $notesHtml = ($study['notes']) ? "<li><a href='notes/$study[notes]'>Notes</a></li>" : "";
  $studyHtml = ($study['study']) ? "<li><a href='studies/$study[study]'>UC Study</a></li>" : "";
  $pryunStudyHtml = ($study['pryunstudy']) ? "<li><a href='studies/$study[pryunstudy]'>P. Ryun's Study</a></li>" : "";
  $passagesHtml = "<ul>";
  foreach ($study['passages'] as $passage) {
    $passagesHtml .= "<li>$passage</li>";
  }
  $passagesHtml .= "</ul>";
  echo <<<EOF
  <tr onMouseover="this.bgColor='#ADDFFF'" onMouseout="this.bgColor='#FFFFFF'">
    <td><b>$study[no]</b></td>
    <td>$study[title]</td>
    <td>$passagesHtml</td>
    <td>
      $studyHtml
      $pryunStudyHtml
      $notesHtml
    </td>
    <td>$study[comments]</td>
  </tr>
EOF;
}

?>

     </table>

<p>* <a href="ephesiansBibleStudies.html">Fall 2011 Ephesians Bible Studies</a></p>

   </td>
 </tr>
</table>
<?php include('../../footer.html'); ?>

</HTML>

