<?php include('./fundraiser_header.php'); ?>


<h3>Payment</h3>

<br><p>The registration price is currently $25.</p>

<div style="padding: 5px">
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="business" value="paypal@gracecovenant.net">
        <input type="hidden" name="item_name" value="GCC Basketball Fundraiser for Missions 2012">
        <input type="hidden" name="amount" value="25.00">
        <input type="hidden" name="no_shipping" value="1">
        <input type="hidden" name="return" value="http://uc.gracecovenant.net/fundraiser/payment_success.php">
        <input type="hidden" name="cancel_return" value="http://uc.gracecovenant.net/fundraiser/payment_failure.php">
        <input type="hidden" name="no_note" value="1">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="lc" value="US">
        <input type="hidden" name="bn" value="PP-BuyNowBF">
        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" border="0" name="submit" alt="Make payment with PayPal">
        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>


<div style='height: 100px'>&nbsp;</div>


<?php include('./fundraiser_footer.php'); ?>

