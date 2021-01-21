<?php
include_once 'inc/header.php';
?>

<?php
// if (isset($_GET["orderID"]) || $_GET["productID"] == "order") {
//   $customer_id = Session::get("customer_id");
//   $insertOrder = $ct->insertOrder($customer_id);
//   $delCart = $ct->deleteAllCart();
//   header("Location: success.php");
// }

// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
//   $productQuantity = $_POST["productQuantity"];
//   $addCart = $ct->addToCart($productID, $productQuantity);
// }

?>

<style>
  h2.success-order {
    text-align: center;
    color: red;
  }
</style>

<form action="" method="POST">
  <div class="main">
    <div class="content">
      <div class="section group">
        <h2 class="success-order">Success Order</h2>
        <p>Total price you have brought from my Website: 50000</p>
        <p>We will contact handle....</p>
        <p>Please your order details <a href="orderdetails.php">Click vao day de xem chi tiet</a>....</p>
      </div>
    </div>
  </div>
</form>

<?php include "inc/footer.php" ?>