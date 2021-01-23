<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
  header("Location: login.php");
}
?>

<?php
if (!isset($_GET["id"])) {
  echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>

<div class="main">
  <div class="content">
    <div class="cartoption">
      <div class="cartpage">
        <h2>Details Ordered</h2>
        <table class="tblone">
          <tr>
            <th width="20%">ID</th>
            <th width="20%">Product Name</th>
            <th width="10%">Image</th>
            <th width="15%">Price</th>
            <th width="25%">Quantity</th>
            <th width="25%">Status</th>
            <th width="25%">Date</th>
            <th width="25%">Action</th>
          </tr>

          <?php
          $customer_ID = Session::get("customer_ID");
          $productOrdered = $ct->getCartOrdered($customer_ID);

          if ($productOrdered) {
            $i = 1;
            $quantity = 0;
            while ($result = $productOrdered->fetch_assoc()) {
          ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result["productName"] ?></td>
                <td><img height="200px" src="admin/uploads/<?php echo $result["image"] ?>" /></td>
                <td><?php echo $result["price"] . " VND" ?></td>
                <td><?php echo $result["quantity"] ?></td>
                <td>
                  <?php
                  if ($result["status"] == 0) {
                    echo "Pending";
                  } else {
                    echo "Progress";
                  }

                  ?>
                </td>
                <td><?php echo $fm->formatDate($result["date_order"])  ?></td>
                <td>
                  <?php
                  if ($result["status"] == 0) {
                    echo "N/A";
                  } else {
                  ?>

                <td><a href="?cartID=<?php echo $result["cartID"] ?>">X</a></td>

              <?php } ?>
              </td>
              </tr>
          <?php
            }
          }
          ?>

        </table>
      </div>
      <div class="shopping">
        <div class="shopleft">
          <a href="index.php"> <img src="images/shop.png" alt="" /></a>
        </div>
        <div class="shopright">
          <a href="payment.php"> <img src="images/check.png" alt="" /></a>
        </div>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<?php
include "inc/footer.php";
?>