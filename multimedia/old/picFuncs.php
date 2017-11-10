<?php

function newAlbum($title, $picasalink, $imgsrc, $day, $col)
{
  $NUM_COLS = 4;
  if($col==0) echo "<tr>";
  if($col==$NUM_COLS) echo "</tr>";
  echo "<td align='center'>";
  start_subbox(185,'orange', $title ,'center','center','');
  echo "<a href=" . $picasalink . " target='_blank'>
        <img width='145' height='145' src=" . $imgsrc . " border='0' style='margin-top: 8px'>
        </a><br>
        <p class='medium' style='color:#888888'>" . $day . "</p>";
  end_subbox('orange','');
  echo "</td>";
}

function incCol($col)
{
  $NUM_COLS = 4;
  if($col==$NUM_COLS-1) 
	return 0;
  else
  	return $col + 1;
}

function endAlbums()
{
  echo "</tr>";
  echo "</table>";
}

function yearLine($ycurrent)
{
  $ybegin = 2000;
  $yend = 2009;
  echo "<tr>
   	<td colspan='4'>
     	<h4 align='left'>Pictures -  [";
 
  for($count=$ybegin; $count<=$yend; $count++){
	echo "&nbsp;";
	if($count!=$ycurrent){
		echo "<a href='./pictures$count" . ".php'>$count</a>";
	}
	else{
	     	echo $count;
	}
	echo "&nbsp;";
	if($count<$yend){
		echo "|";
	}
  }

  echo "]</h4>
   	</td>
 	</tr>
    	<tr>";
}

?>