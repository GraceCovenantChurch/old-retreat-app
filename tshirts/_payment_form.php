  <p>Please enter the email that you used in the Google form.</p>

  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="shirt_form">

     <span><b>Email:</b></span> <input type="text" name="email" />
     <input type="hidden" name="cmd" value="_xclick">
     <input type="hidden" name="business" value="paypal@gracecovenant.net">
     <input type="hidden" name="item_name" value="GCC T-shirt">
     <input type="hidden" name="no_shipping" value="0">
     <input type="hidden" name="no_note" value="1">
     <input type="hidden" name="amount" value="12.00">
     <input type="hidden" name="currency_code" value="USD">
     <input type="hidden" name="tax" value="0">
     <input type="hidden" name="lc" value="US">
     <input type="hidden" name="bn" value="PP-DonationsBF">
     <input type="hidden" name="return" value="<?php echo "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] . "?payment=success"; ?>">
     <input type="hidden" name="cancel_return" value="<?php echo "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"] . "?payment=failure"; ?>">
    &nbsp; &nbsp;
    <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynow_SM.gif" border="0" name="submit" alt="Make payment with PayPal" class="paypal_submit">
  </form>

