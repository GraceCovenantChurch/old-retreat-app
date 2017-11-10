<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 24; $i++) {
  $days["April $i"] = "2 Samuel $i";
}
for($i = 25; $i <= 29; $i++) {
  $micah_chap = $i - 24;
  $days["April $i"] = "Micah $micah_chap";
}
$days["April 30"] = "Micah 6-7";

$YEAR = "2013";

echo_list($days, $YEAR);

?>