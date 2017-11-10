<?php
date_default_timezone_set("America/New_York");
$today = date("F j Y");

function echo_list($days, $year) {
  global $today;
  echo "<ul>";
  foreach($days as $day => $chap) {
    $content = "$day - $chap";
    $strcmp = strcmp("$day $year", $today);
    if($strcmp < 0) {
      $li = $content;
    } else if($strcmp == 0) {
      $li = "<b>$content</b>";
    } else {
      $li = $content;
    }
    echo "<li>$li</li>";
  }
  echo "</ul>";
}

?>