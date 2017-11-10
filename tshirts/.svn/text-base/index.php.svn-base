<HTML>
<head>
  <title>Grace Covenant Church - University City, Philadelphia PA</title>
  <link rel="stylesheet" type="text/css" href="/style.css" />
  <style>
    div.payment {background-color: yellow; padding: 10px;}
    #shirt_form {margin-left:10px;}
    iframe {border: 1px solid black;}
  </style>
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
    $("input[name='item_name']").val("GCC T-Shirt: " + $email);
  });
});
  </script>
</head>

<?php include('../header.html'); ?>
<?php include('../sidebar.html'); ?>

<table id="widemaintable">
 <tr>
  <td>

<iframe src="https://docs.google.com/forms/d/19rZemiFEJWSt7VsiqR2J3qnaXFOfUteR7AC-AKB6F9Y/viewform?embedded=true" width="770" height="550" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>

<div class="payment">
  <h4>Payment - $12</h5>
  <?php
    if($_GET['payment']=="success") {
      include('_payment_success.php');
    } elseif($_GET['payment']=="failure") {
      include('_payment_failure.php');
      include('_payment_form.php');
    } else {
      include('_payment_form.php');
    }
  ?>
</div>


</td></tr></table>
<?php include('../footer.html'); ?>
</HTML>

