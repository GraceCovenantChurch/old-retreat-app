<HTML>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="./home/style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
  <script language="JavaScript" src="/menu.js"></script>
  <script type="text/javascript">

function show_details($id) {
    $("#" + $id + "_paypal").slideToggle("fast");
    return false;
}

$(document).ready(function(){
  $("a.paypal_link").click(function(){
    return show_details($(this).attr('id'));
  });
});

  </script>

  <style type="text/css">

#paypal_col { width: 300px; }
.paypal_details { display: none; border: 1px solid gray; padding-top: 5px; width: 290px; }
.paypal_link { font-weight: bold; }

#gccgiving
{
  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
  width:92%;
  border-collapse:collapse;
}

#missionstable {
  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
  width:35%;
  border-collapse:collapse;
  margin-left: 30px;
  margin-top: 5px;
}

#gccgiving th, #gccgiving td
{
  font-size:10pt;
  border:1px solid black;
  padding: 10px;
  text-align: center;
}

#recurring_details td { border: none; padding: 5px; }


#gccgiving th 
{
  font-size:10pt;
  text-align:left;
  padding-top:5px;
  padding-bottom:4px;
  background-color: #A7C942;
  font-weight: bold;
  color:#ffffff;
}

#missionstable th
{
  font-size:10pt;
  text-align:left;
  padding-top:5px;
  padding-bottom:4px;
  background-color: orange;
  font-weight: bold;
  color:#ffffff;
}

p.gccgiving
{
  padding-top: 15px;
  padding-bottom: 15px;
  font-size:10pt;
}
  </style>
</head>

<?php include('./header.html'); ?>
<?php include('./sidebar.html'); ?>
<table width="800" cellspacing="8">
  <tr>
    <td valign="top">
	<div align="center"><img src="images/contributebannerwide.jpg"></div><br>

	<p class="gccgiving">Welcome to GCC's giving resource.  We would love for you to partner with us in the work of raising up kingdom workers who are transformed by Christ to influence the world.  Here are three ways for you to contribute:</p>

<div align="center">
  <table id="gccgiving">
     <tr>
        <th>In Person</th>
	<th>By Mail</th>
	<th id="paypal_col">By PayPal</th>
     </tr>
     <tr>
        <td>During Sunday Service</td>
        <td>
 	    Grace Covenant Church<br>
            19 Ardsley Rd<br>
            Upper Darby, PA 19082
        </td>
	<td>        
	    <div><a href="#" id="onetime" class="paypal_link">One Time Donation</a></div>
	    <div id="onetime_paypal" class="paypal_details">
	      <?php include('giving/paypal_onetime.html'); ?>
	    </div>
	    <div><a href="#" id="recurring" class="paypal_link">Recurring Donations</a></div>
	    <div id="recurring_paypal" class="paypal_details">
	      <?php include('giving/paypal_recurring.html'); ?>
	    </div>
        </td>
     </tr>
  </table>
</div>


<br><br>


	<p class="gccgiving"><b><a href="giving/missions2013.php">Click here</a> to go to the summer missions giving page.</b></p>
	
	
    </td>
  </tr>
</table>
<?php include('./footer.html'); ?>
