<?php
  
 $js_files = array("united.js");

 // calculate price
 date_default_timezone_set("America/New_York");
 $early_deadline = 20121231;
 $regular_deadline = 20130131;
 $my_date = date("Ymd");
 if ($my_date <= $early_deadline) {
   $explanation = "Early Registration";
   $price = 40;
 } else if ($my_date <= $regular_deadline) {
   $explanation = "Regular Registration";
   $price = 55;
 } else {
   $explanation = "Late Registration";
   $price = 60;
 }

 function make_paypal_button($price, $explanation) {
   echo <<<EOF
  <div class="payment">

  <h2>$explanation: \$$price</h2>


  <p>Please enter the email that you used to sign up with.</p>

  <form action="https://www.paypal.com/cgi-bin/webscr" method="post">

     <span><b>Email:</b></span> <input type="text" name="email" />
     <input type="hidden" name="cmd" value="_xclick">
     <input type="hidden" name="business" value="paypal@gracecovenant.net">
     <input type="hidden" name="item_name" value="United in Christ Retreat">
     <input type="hidden" name="no_shipping" value="0">
     <input type="hidden" name="no_note" value="1">
     <input type="hidden" name="amount" value="$price.00">
     <input type="hidden" name="currency_code" value="USD">
     <input type="hidden" name="tax" value="0">
     <input type="hidden" name="lc" value="US">
     <input type="hidden" name="bn" value="PP-DonationsBF">

     <br><br>

    <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="Make payment with PayPal" class="paypal_submit">
  </form>

    <p style="margin-top: 20px">* You can also pay in person to Joshua Changhyun Bahn using cash or check (written to Grace Covenant Church).</p>

  </div>
EOF;
 }

// actual page
  include_once("united_header.php");
?>

<ul class="tab-nav">
  <li><a href="/unitedretreat">Sign Up</a></li>
  <li class="selected"><a href="payment.php">Pay</a></li>
  <li><a href="info.php">Info</a></li>
</ul>

<?php 
 make_paypal_button($price, $explanation); 
?>
<?php
 include_once("united_footer.php");
?>
