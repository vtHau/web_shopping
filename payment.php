<?php
include_once 'inc/header.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
  header("Location: login.php");
}
?>

<div class="main">
  <div class="content">
    <div class="section group">
      <div class="content_top">
        <div class="heading">
          <h3>Profile Customer</h3>
        </div>
        <div class="clear"></div>
        <h3>Choose your method Payment</h3>
        <a href="offlinepayment.php">Offline Payment</a>
        <a href="onlinepayment.php">Online Payment</a>
      </div>
    </div>
  </div>
</div>

<?php
include "inc/footer.php";
?>