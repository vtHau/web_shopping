<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include "../classes/brand.php"; ?>

<?php

if (!isset($_GET["brandID"]) || $_GET["brandID"] == NULL) {
  echo "<script>window.lobrandion = 'brandlist.php'</script>";
} else {
  $brandID = $_GET["brandID"];
}

$brand = new brand();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $brandName =  $_POST["brandName"];
  $updateBrand = $brand->update_brand($brandName, $brandID);
}

?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>Edit brand</h2>
    <div class="block copyblock">
      <?php if (isset($updateBrand)) {
        echo $updateBrand;
      }
      ?>

      <?php
      $get_brand_name = $brand->getBrandByID($brandID);
      if ($get_brand_name) {
        while ($result = $get_brand_name->fetch_assoc()) {
      ?>
          <form action="" method="POST">
            <table class="form">
              <tr>
                <td>
                  <input type="text" value="<?php echo $result["brandName"]; ?>" placeholder="Edit Brand Name Products..." class="medium" name="brandName" />
                </td>
              </tr>
              <tr>
                <td>
                  <input type="submit" name="submit" Value="Edit" />
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