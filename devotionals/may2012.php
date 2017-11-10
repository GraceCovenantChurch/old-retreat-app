<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 22; $i++) {
  $days["May $i"] = "Revelation $i";
}
for($i = 23; $i <= 31; $i++) {
  $psalm_chap = $i - 20;
  $days["May $i"] = "Psalm $psalm_chap";
}

$YEAR = "2012";

echo_list($days, $YEAR);

?>