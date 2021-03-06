<?
function fillJavaScript($slides_array){
   echo '<script language="JavaScript">';
   makeJSArray("imgsrcs", 1, $slides_array);
   makeJSArray("urls", 3, $slides_array);
   makeJSArray("captions", 4, $slides_array);
   makeJSArray("infront", 5, $slides_array);
   makeJSArray("captionheights", 6, $slides_array);
   echo '</script>';
}

function makeJSArray($var_name, $num, $slides_array){
   echo "var " . $var_name . "= [";
   $i=0;
   $size = count($slides_array);
   foreach($slides_array as $slide){
      $i++;
      echo "'" . $slide[$num] . "'";
	  if($i!=$size){
	     echo ", ";
	  }
   }
   echo "];";
}

function makeImageBox($slides_array){

echo <<<EOS
<script type="text/javascript">
     preloadpics();
</script>
<div class="imagebox">
	  <table cellpadding="0" margin="4" width="500px" align="center">
	     <tr><td colspan="6">
<div id="imagediv" style="position: relative;">
	<img name="bigpic" src="./images/blank.jpg" width="500px" height="335px" border="0" alt="" onclick='redirect();' />
        <div id="captionbox" style="position: absolute; bottom: 0px; left:0; width:500px;">
	  <div id="captionboxbg"></div>
        </div>
        <div style="color: white; background-color: none; position: absolute; bottom: 0px; left:0px; width:500px;" id="captioningtextbg">
          <div style="padding:15px; line-height: 15pt" id="captioningtext"></div>
        </div>
	<div id="infrontbg" style="position: absolute; bottom: 0px; left:0px; width:500px; background-color: white;">
	  <div id="infront" style="height:335px; width:500px;" align="center"></div>
	</div>
</div>

  </td>
  </tr>
	     <tr>
EOS;

$i = 0;
foreach($slides_array as $slide){
  echo "<td width=\"16%\" class='transON' onmouseover=\"this.className='transOFF'\" onmouseout=\"mOut(" . $i . ");\" onclick=\"clickChange(" . $i . ");\" id=\"pic" . $i . "\"><img src=\"" . $slide[2] . "\" width=\"80px\" border=\"0\" height=\"60px\" title=\"" . $slide[0] . "\" /></td>";
  $i++;
}
while($i<6){
  echo "<td width='16%'><img src='images/blank.jpg'></td>";
  $i++;
}

echo <<<EOS
	     </tr>
	  </table>
	</div>
<script type="text/javascript">
     initialize();
</script>
EOS;

}
?>