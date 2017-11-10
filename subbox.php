<?php

function start_subbox($wid,$col,$text,$align,$align_td,$extra) {
  $dir = $col . 'bar';
  $tr_extra = ($extra=='_fill' ? ' bgcolor="#fea000"' : '');
  $extra .= ".gif";
  echo <<<EOS
      <table width="$wid" height="100%" cellspacing="0" cellpadding="0">
	<tr>
	  <td background="/$dir/topleft.gif" height="10" width="10"></td>
	  <td background="/$dir/topmid.gif" height="10"></td>
	  <td background="/$dir/topright.gif" height="10" width="10"></td>
	</tr><tr>
          <td background="/$dir/topmid.gif" width="10"></td>
	  <td background="/$dir/topmid.gif" height="18"><h4 class="white" align="$align" style="margin-top: -4px; margin-left: 13px; margin-right: 13px">$text</h4></td>
	  <td background="/$dir/topmid.gif" width="10"></td>
	</tr>
<tr$tr_extra>
	  <td background="/$dir/midleft$extra" width="10"></td>
	  <td valign="top" align="$align_td">

EOS;
}

function end_subbox($color,$extra) {
  $dir = $color . 'bar';
  $extra .= ".gif";
  echo <<<EOS
	  </td><td background="/$dir/midright$extra" width="10"></td>
	</tr><tr>
	  <td background="/$dir/botleft$extra" height="10" width="10"></td>  
	  <td background="/$dir/botmid$extra" height="10"></td>
	  <td background="/$dir/botright$extra" height="10" width="10"></td>
	</tr>
      </table>
EOS;
}

