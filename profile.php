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

// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
//   $productQuantity = $_POST["productQuantity"];
//   $addCart = $ct->addToCart($productID, $productQuantity);
// }
?>

<div class="main">
  <div class="content">
    <div class="section group">
      <div class="content_top">
        <div class="heading">
          <h3>Profile Customer</h3>
        </div>
        <div class="clear"></div>
      </div>

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
              <td><?php echo $result["name"] ?></td>
            </tr>
            <tr>
              <td>Email</td>
              <td>:</td>
              <td><?php echo $result["email"] ?></td>
            </tr>
            <tr>
              <td>Phone</td>
              <td>:</td>
              <td><?php echo $result["phone"] ?></td>
            </tr>
            <tr>
              <td>Address</td>
              <td>:</td>
              <td><?php echo $result["address"] ?></td>
            </tr>
            <tr>
              <td>City</td>
              <td>:</td>
              <td><?php echo $result["city"] ?></td>
            </tr>
            <tr>
              <td>Zipcode</td>
              <td>:</td>
              <td><?php echo $result["zipcode"] ?></td>
            </tr>
            <tr>
              <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
            </tr>
        <?php
          }
        }
        ?>
      </table>

    </div>
  </div>
</div>


<?php
include "inc/footer.php";
?>