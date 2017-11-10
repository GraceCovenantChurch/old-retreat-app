<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 13; $i++) {
  $days["December $i"] = "Hebrews $i";
}

for($i = 14; $i <= 18; $i++) {
  $b = $i - 13;
  $days["December $i"] = "James $b";
}

for($i = 19; $i <= 22; $i++) {
  $b = $i - 18;
  $days["December $i"] = "1 Peter $b";
}

for($i = 23; $i <= 25; $i++) {
  $b = $i - 22;
  $days["December $i"] = "2 Peter $b";
}

for($i = 26; $i <= 30; $i++) {
  $b = $i - 25;
  $days["December $i"] = "1 John $b";
}

$days["December 31"] = "2 John 1";

$YEAR = "2013";

echo_list($days, $YEAR);

?>