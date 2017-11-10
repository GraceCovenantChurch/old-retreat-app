<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="shortcut icon" href="http://uc.gracecovenant.net/images/favicon.ico" type="image/x-icon" />
  <script language="JavaScript" src="/menu.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
  <script type="text/javascript">
  
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};

$(document).ready(function(){
  $("input.paypal_submit").click(function(){
    var $email = $("input[name='email']").val();
    if ( !isValidEmailAddress($email)) {
      alert("Please enter a valid email.");
      return false;
    }
    $("input[name='item_name']").val("Married Couples Seminar: " + $email);
  });
});
  </script>
</head>

<?php include('../header.html'); ?>
<?php include('../sidebar.html'); ?>
<?php
 function make_paypal_button($price, $explanation) {
   echo <<<EOF
  <div class="payment">

  <p>Please enter the email that you used to sign up with.</p>

  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">

     <p><span><b>Email:</b></span> <input type="text" name="email" /></p>
     <input type="hidden" name="cmd" value="_xclick">
     <input type="hidden" name="business" value="paypal@gracecovenant.net">
     <input type="hidden" name="item_name" value="GCC Married Couples Seminar">
     <input type="hidden" name="no_shipping" value="0">
     <input type="hidden" name="no_note" value="1">
     <input type="hidden" name="amount" value="20.00">
     <input type="hidden" name="currency_code" value="USD">
     <input type="hidden" name="tax" value="0">
     <input type="hidden" name="lc" value="US">
     <input type="hidden" name="bn" value="PP-DonationsBF">

     <br><br>

    <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="Make payment with PayPal" class="paypal_submit">
  </form>
  </div>
EOF;
 }
?>

<table id="widemaintable">
 <tr>
   <td>

  <h4>GCC Married Couples Seminar</h4>

<ul class="tab-nav">
  <li><a href="index.php">Sign Up</a></li>
  <li class="selected"><a href="payment.php">Pay</a></li>
</ul>


   <?php make_paypal_button($price, $explanation); ?>

   </td>
 </tr>
</table>
<?php include('../footer.html'); ?>

</body>
</HTML>

