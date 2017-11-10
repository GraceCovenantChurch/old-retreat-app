<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 30; $i++) {
  $days["September $i"] = "Proverbs $i";
}

$YEAR = "2012";

echo_list($days, $YEAR);

?>