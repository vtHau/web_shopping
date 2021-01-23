<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include "../classes/category.php"; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../classes/customer.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php

if (!isset($_GET["customerID"]) || $_GET["customerID"] == NULL) {
  echo "<script>window.location = 'inbox.php'</script>";
} else {
  $ID = $_GET["customerID"];
}

$cat = new category();



?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>Edit Category</h2>
    <div class="block copyblock">

      <?php
      $cs = new customer();
      $getCustomer = $cs->getCustomer($ID);
      if ($getCustomer) {
        while ($result = $getCustomer->fetch_assoc()) {
      ?>
          <form action="" method="POST">
            <table class="form">
              <tr>
                <td>Name</td>
                <td>
                  <input type="text" readonly="readonly" value="<?php echo $result["name"]; ?>" placeholder="Edit Category Name Products..." class="medium" name="catName" />
                </td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>
                  <input type="text" readonly="readonly" value="<?php echo $result["phone"]; ?>" placeholder="Edit Category Name Products..." class="medium" name="catName" />
                </td>
              </tr>
              <tr>
                <td>Email</td>
                <td>
                  <input type="text" readonly="readonly" value="<?php echo $result["email"]; ?>" placeholder="Edit Category Name Products..." class="medium" name="catName" />
                </td>
              </tr>
              <tr>
                <td>Address</td>
                <td>
                  <input type="text" readonly="readonly" value="<?php echo $result["address"]; ?>" placeholder="Edit Category Name Products..." class="medium" name="catName" />
                </td>
              </tr>
              <tr>
                <td>City</td>
                <td>
                  <input type="text" readonly="readonly" value="<?php echo $result["city"]; ?>" placeholder="Edit Category Name Products..." class="medium" name="catName" />
                </td>
              </tr>

            </table>
          </form>

      <?php
        }
      }
      ?>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'; ?>