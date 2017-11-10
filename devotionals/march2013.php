<?php

include("plan_funcs.php");

$days = array();

for($i = 1; $i <= 31; $i++) {
  $days["March $i"] = "1 Samuel $i";
}

$YEAR = "2013";

echo_list($days, $YEAR);

?>