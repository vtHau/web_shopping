<?php
include 'inc/header.php';
// include 'inc/slider.php';
?>
<?php

$login_check = Session::get('customer_login');
if ($login_check == false) {
  header('Location:login.php');
}
?>

<div class="main">
  <div class="content">
    <div class="cartoption">
      <div class="cartpage">
        <h2>Your Cart</h2>
        <div class="order-page">
          <h3>Day la trang order</h3>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<?php include_once "./inc/footer.php"; ?>