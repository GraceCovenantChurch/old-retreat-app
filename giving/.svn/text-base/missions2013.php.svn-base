<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>

  <style type="text/css">

div.mbox
{
  padding: 10px;
/*  height: 280px;*/
  position: relative;
  width: 100%;
}

div.mBoxCenter
{
  padding-top: 10px;
}

div.mboxLeft
{
  padding: 10px;
  width: 60%;
}

div.mboxLeft img
{
  border: 3px solid black;
}

div.mboxRight
{
  position: absolute;
  top: 120px;
  left: 450px;
  margin: 0;
  padding: 0;
}


</style>

</head>

<?php 
  include('../header.html');
  include('../sidebar.html'); 
  include('../subbox.php');

  $china_team = array(
    "name" => "China",
    "short_name" => "China",
    // "img" => "otr2012.jpg",
    "people" => array("Brian and ChanMi Pyles", "Chris Chen", "Elias Quan", "Liz Young", 
                      "Michael Yang", "Paul Tzen", "SeMi Jung", "Yue Xu")
  );

  $guatemala_team = array(
    "name" => "Guatemala",
    "short_name" => "Guatemala",
    // "img" => "otr2012.jpg",
    "people" => array("Crystal Rodriguez", "Kevin Sin", "Rickie Zheng")
  );
  
  $indonesia_team = array(
    "name" => "Indonesia",
    "short_name" => "Indonesia",
    // "img" => "otr2012.jpg",
    "people" => array("Alex Chae", "Chris Kim", "Joy Lee")
  );
  
  $otr_team = array(
    "name" => "Over the Rhine (OTR)",
    "short_name" => "OTR",
    // "img" => "otr2012.jpg",
    "people" => array("Alisa Wismer", "Chad Moyer", "Christy Chang", 
                      "Justin Chang", "Haewon Kwon", "Hanna Chung", "Jinha Lee", "Karen Rhee", 
                      "Kevin Choi", "Kimberly Chung", "Krystal Eng", "Linda Kang", "Maria Kim", "Pastor Kirt", "Rachel Chung")
  );
  
  $missions_teams = array($china_team, $guatemala_team, $indonesia_team, $otr_team);

  function option_tag($value) {
    return "<option value=\"$value\">$value</option>";
  }

  function missions_box($team) {
    $team_opt = option_tag($team["short_name"] . " Missions Team");
    $people_opts = "";
    foreach($team["people"] as $person) {
      $people_opts .= "   " . option_tag($team["short_name"] . " Missions: " . $person) . "\n";
    }
    $img_str = $team["img"] ? "<div class=\"mboxLeft\"> <img src=\"images/$team[img]\"> </div><div class=\"mboxRight\">" : "<div align=\"center\" class=\"mBoxCenter\">";
    
    start_subbox(700, 'orange', $team["name"] . " Team" ,'center','left','');
    echo <<<EOF
  <div class="mbox">                                                                                            
   $img_str
   <form action="https://www.paypal.com/cgi-bin/webscr" method="post">                                                  
     <input type="hidden" name="cmd" value="_donations">                                                                
     <input type="hidden" name="business" value="paypal@gracecovenant.net">                                             
     <select name="item_name">                                                                                          
       $team_opt
       $people_opts
     </select> 
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="tax" value="0">
    <input type="hidden" name="lc" value="US">
    <input type="hidden" name="bn" value="PP-DonationsBF">

    <br><br>

    <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
 </form>                                                                                                         
    </div>                                                                                                       
   </div>                                                                                                        
EOF;
    end_subbox('orange','');
    echo "<br><br>";
  }
?>
<table width="800" cellspacing="8">
  <tr>
    <td valign="top">

    <p><b>GIVING - SUMMER MISSIONS</b></p>

    <p>Please join us in supporting our missions teams!  You can give to a team or to an individual through PayPal.</p>

    <div align="center">
        <?php 
          foreach($missions_teams as $missions_team) {
            missions_box($missions_team);  
          }
        ?>
    </div>
    </td>
  </tr>
</table>
<?php include('../footer.html'); ?>
