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
     <p><b>1 TIMOTHY BIBLE STUDIES - SUMMER 2012</b></p>
     <table cellpadding='10' style='border: 1px solid black'>
       <tr bgcolor='orange'><th> </th><th>Title</th><th>Passages</th><th>Study</th><th>Comments</th></tr>
<?php
$studies = array(
  array(
   "no" => "1",
   "title" => "Extreme Makeover",
   "passages" => array(
       "Acts 19:1-22",
       "1 Timothy 1:12-17"
     ),
   "study" => "Acts19.docx",
   "notes" => "Acts19_notes.docx",
   "comments" => "Did not go over together."
  ),
  array(
   "no" => "2",
   "title" => "1 Timothy 1",
   "passages" => array(
       "1 Timothy 1"
     ),
   "study" => "1Timothy1_UC.docx",
   "notes" => "1Timothy1_UC_notes.docx",
   "comments" => "Went over 6/2."
  ),
  array(
   "no" => "3",
   "title" => "1 Timothy 2",
   "passages" => array(
       "1 Timothy 2"
     ),
   "study" => "1Timothy2UC.docx",
   "notes" => "1Timothy2UC_notes.docx",
   "comments" => "Did not go over together."
  ),
  array(
   "no" => "4",
   "title" => "1 Timothy 3",
   "passages" => array(
       "1 Timothy 3"
     ),
   "study" => "1Timothy3_UC.docx",
   "notes" => "1Timothy3_UC_notes.docx",
   "comments" => "Went over 6/16"
  ),
  array(
   "no" => "5",
   "title" => "1 Timothy 4",
   "passages" => array(
       "1 Timothy 4"
     ),
   "study" => "1Timothy4UC.docx",
   "notes" => "1Timothy4UCnotes.docx",
   "comments" => "Went over 6/23"
  ),
  array(
   "no" => "6",
   "title" => "1 Timothy 5",
   "passages" => array(
       "1 Timothy 5"
     ),
   "study" => "1Timothy5UC.docx",
   "notes" => "1Timothy5UCnotes.docx",
   "comments" => "Went over 7/7"
  ),
  array(
   "no" => "7",
   "title" => "1 Timothy 6",
   "passages" => array(
       "1 Timothy 6"
     ),
   "study" => "1Timothy6_UC.docx",
   "notes" => "1Timothy6_UC_notes.docx",
   "comments" => "Went over 7/21"
  ),
  array(
   "no" => "8",
   "title" => "2 Timothy 1",
   "passages" => array(
       "2 Timothy 1"
     ),
   "study" => "2Timothy1_UC.docx",
   "notes" => "2Timothy1_UC_notes.docx",
   "comments" => "Did not go over together."
  )
);

foreach ($studies as $study) {
  $notesHtml = ($study['notes']) ? "<li><a href='notes/$study[notes]'>Notes</a></li>" : "";
  $studyHtml = ($study['study']) ? "<li><a href='studies/$study[study]'>UC Study</a></li>" : "";
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
      $notesHtml
    </td>
    <td>$study[comments]</td>
  </tr>
EOF;
}

?>

     </table>


   </td>
 </tr>
</table>
<?php include('../../footer.html'); ?>

</HTML>

