<?php
include_once 'inc/header.php';
?>

<?php
$login_check = Session::get('customer_login');
if ($login_check == false) {
  header("Location: login.php");
}

// if (!isset($_GET["productID"]) || $_GET["productID"] == NULL) {
//   echo "<script> window.location = '404.php' </script>";
// } else {
//   $productID = $_GET["productID"];
// }
$ID = session_id();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['save'])) {
  $updateCustomer = $cs->updateCustomer($_POST, $ID);
}
?>

<div class="main">
  <div class="content">
    <div class="section group">
      <div class="content_top">
        <div class="heading">
          <h3>Update Profile Customer</h3>
        </div>
        <div class="clear"></div>
      </div>
      <form action="" method="POST">
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

              <!-- <tr>
                <td>City</td>
                <td>:</td>
                <td><input type="text" name="city" value="<?php echo $result["city"] ?>"></td>
              </tr> -->

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
      </form>

      <?php
      if (isset($updateCustomer)) {
        echo $updateCustomer;
      }
      ?>
    </div>
  </div>
</div>


<?php
include "inc/footer.php";
?>