<?php

function yearLine($ycurrent)
{
  $ybegin = 2008;
  $yend = 2015;
  echo "<tr>
   	<td>
     	<span class='yearline'><b>Videos</b> - [";
 
  for($count=$ybegin; $count<=$yend; $count++){
	echo "&nbsp;";
	if($count!=$ycurrent){
		echo "<a href='./videos$count" . ".php'>$count</a>";
	}
	else{
	     	echo "<b>$count</b>";
	}
	echo "&nbsp;";
	if($count<$yend){
		echo "|";
	}
  }

  echo "]</span>";
}

function addLink($dir, $file, $title)
{
  echo "<a href='" . $dir . "/" . $file . "'>" . $title . "</a>";
}

function addLink2($file, $title)
{
  echo "<a class='fancybox-media' href='" . $file . "'>" . $title . "</a>";
}

?>