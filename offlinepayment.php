<?php
include_once 'inc/header.php';
?>

<!-- <?php
      if (!isset($_GET["productID"]) || $_GET["productID"] == NULL) {
        echo "<script> window.location = '404.php' </script>";
      } else {
        $productID = $_GET["productID"];
      }

      if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
        $productQuantity = $_POST["productQuantity"];
        $addCart = $ct->addToCart($productID, $productQuantity);
      }

      ?> -->

<style>
  .box-left {
    width: 50%;
    float: left;
    border: 1px solid #666;
    padding: 4px;
  }

  .box-right {
    width: 46%;
    float: right;
    padding: 4px;
    border: 1px solid #666;
  }

  .submit-order {
    padding: 10px 70px;
    border: none;
    background-color: red;
    font-size: 25px;
    color: #fff;
    margin: 15px;
    cursor: pointer;
  }
</style>

<form action="" method="POST">
  <div class="main">
    <div class="content">
      <div class="section group">
        <div class="content_top">
          <div class="heading">
            <h3>Offline Payment</h3>
          </div>
          <div class="clear"></div>
          <div class="box-left">
            <div class="cartpage">
              <?php
              if (isset($deleteCart)) {
                echo $deleteCart;
              }
              ?>
              <h4>Your Cart</h4>
              <table class="tblone">
                <tr>
                  <th width="5%">ID</th>
                  <th width="5%">Name</th>
                  <th width="15%">Price</th>
                  <th width="25%">Quantity</th>
                  <th width="20%">Total Price</th>
                </tr>

                <?php

                $productCart = $ct->getProductCart();

                if ($productCart) {
                  $total = 0;
                  $quantity = 0;
                  $i = 0;
                  while ($result = $productCart->fetch_assoc()) {
                    $i++;
                    $quantity += $result["productQuantity"];
                    $total = $total + (($result["productQuantity"]) * ($result["productPrice"]));
                ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $result["productName"] ?></td>
                      <td><?php echo $result["productPrice"] ?>
                      <td><?php echo $result["productQuantity"] ?>
                      </td>
                      <td><?php echo ($result["productPrice"]  * $result["productQuantity"]) ?></td>
                    </tr>
                <?php
                  }
                }
                ?>
              </table>
              <?php
              $checkCart = $ct->check_cart();
              if ($check_cart) {
              ?>
                <table style="float:right;text-align:left;" width="40%">
                  <tr>
                    <th>Sub Total : </th>
                    <td><?php if (isset($total)) echo $total . " VND" ?></td>
                  </tr>
                  <tr>
                    <th>VAT : </th>
                    <td>10% <?php echo " (" . $total * 0.1 . ") VND" ?></td>
                  </tr>
                  <tr>
                    <th>Grand Total :</th>
                    <td>
                      <?php
                      if (isset($total)) {
                        $VAT = $total * 0.1;
                        $sum = $total + $VAT;
                        echo $sum . " VND";
                        Session::set('sum', $sum);
                        Session::set('quantity', $quantity);
                      }
                      ?>
                    </td>
                  </tr>
                </table>
              <?php
              } else {
                echo "<span>Khong co thong tin de hien thi</span>";
              } ?>
            </div>
          </div>
          <div class="box-right">
            <table class="tblone">
              <?php
              $ID = Session::get("customer_ID");
              $getCustomer = $cs->getCustomer($ID);
              if ($getCustomer) {
                while ($result = $getCustomer->fetch_assoc()) {
              ?>
                  <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><input type="text" name="name" value="<?php echo $result["name"] ?>"></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="email" name="email" value="<?php echo $result["email"] ?>"></td>
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><input type="text" name="phone" value="<?php echo $result["phone"] ?>" id=""></td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><input type="text" name="address" value="<?php echo $result["address"] ?>"></td>
                  </tr>
                  <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><input type="text" name="zipcode" value="<?php echo $result["zipcode"] ?>"></td>
                  </tr>
                  <tr>
                    <td colspan="3"><input type="submit" name="save" value="Save"></td>
                  </tr>
              <?php
                }
              }
              ?>
            </table>
          </div>
        </div>
      </div>
      <center> <input type="submit" class="submit-order" value="Order Now" name="order" /></center>
    </div>
  </div>
</form>


<?php include "inc/footer.php" ?>