<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 12; $i++) {
  $days["October $i"] = "Proverbs $i, Ecclesiastes $i";
}
for($i = 13; $i <= 31; $i++) {
  $days["October $i"] = "Proverbs $i";
}

$YEAR = "2012";

echo_list($days, $YEAR);

?>