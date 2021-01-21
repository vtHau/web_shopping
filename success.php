<?php
include_once 'inc/header.php';
?>

<?php
if (isset($_GET["orderID"]) and $_GET["orderID"] == "order") {
  $customer_ID = Session::get("customer_ID");
  $delCart = $ct->deleteAllCart();
  header('Location:success.php');
  // $insertOrder = $ct->insertOrder($customer_id);
  // $delCart = $ct->deleteAllCart();
  // header("Location: success.php");
}

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
        <h2>Đặt hàng thành công</h2>
        <?php
        $customer_id = Session::get('customer_ID');
        $get_amount = $ct->getAmountPrice($customer_id);
        if ($get_amount) {
          $amount = 0;
          while ($result = $get_amount->fetch_assoc()) {
            $price = $result['price'];
            $amount += $price;
          }
        }
        ?>
        <p class="success_note">Tổng giá trị bạn đã mua: <?php
                                                          $vat = $amount * 0.1;
                                                          $total = $vat + $amount;
                                                          echo $total . ' VNĐ';
                                                          ?></p>
        <p class="success_note">Chúng tôi sẽ liên hệ với bạn sớm nhất có thể, xem chi tiết đặt hàng tại <a href="orderdetails.php">Bấm vào đây</a></p>
      </div>
    </div>
  </div>
</form>

<?php include "inc/footer.php" ?>