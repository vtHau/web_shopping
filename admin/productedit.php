<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once "../classes/category.php"; ?>
<?php include_once "../classes/brand.php"; ?>
<?php include_once "../classes/product.php"; ?>

<?php
$product = new product();
if (!isset($_GET["productID"]) || $_GET["productID"] == NULL) {
  echo "<script>window.location = 'productlist.php'</script>";
} else {
  $productID = $_GET["productID"];
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
  $updateProduct = $product->update_product($_POST, $_FILES, $productID);
}
?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>Edit Product</h2>
    <div class="block">

      <?php if (isset($updateProduct)) {
        echo $updateProduct;
      } ?>

      <?php
      $get_product_byID = $product->getProductByID($productID);
      if ($get_product_byID) {
        while ($result_product = $get_product_byID->fetch_assoc()) {

      ?>
          <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">

              <tr>
                <td>
                  <label>Name</label>
                </td>
                <td>
                  <input value="<?php echo $result_product["productName"] ?>" name="productName" type="text" placeholder="Enter Product Name..." class="medium" />
                </td>
              </tr>

              <tr>
                <td>
                  <label>Category</label>
                </td>

                <td>
                  <select id="select" name="productCategory">
                    <option>Select Category</option>

                    <?php
                    $cat = new category();
                    $show_cat = $cat->show_category();
                    if (isset($show_cat)) {
                      while ($result = $show_cat->fetch_assoc()) {
                    ?>
                        <option <?php
                                if ($result["catID"] == $result_product["catID"]) {
                                  echo "selected";
                                } ?> value="<?php echo $result["catID"]; ?>">
                          <?php echo $result["catName"]; ?>
                        </option>

                    <?php
                      }
                    }
                    ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td>
                  <label>Brand</label>
                </td>
                <td>
                  <select id="select" name="productBrand">
                    <option>Select Brand</option>

                    <?php
                    $brand = new brand();
                    $brandlist = $brand->show_brand();
                    if ($brandlist) {
                      while ($result = $brandlist->fetch_assoc()) {
                    ?>
                        <option <?php
                                if ($result["brandID"] == $result_product["brandID"]) {
                                  echo "selected";
                                } ?> value=" <?php echo $result['brandID'] ?> ">
                          <?php echo $result['brandName'] ?>
                        </option>

                    <?php
                      }
                    }
                    ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                  <label>Description</label>
                </td>
                <td>
                  <textarea name="productDesc" class="tinymce"><?php echo $result_product["productDesc"] ?></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Price</label>
                </td>
                <td>
                  <input value="<?php echo $result_product["productPrice"] ?>" name="productPrice" type="text" placeholder="Enter Price..." class="medium" />
                </td>
              </tr>

              <tr>
                <td>
                  <label>Upload Image</label>
                </td>
                <td>
                  <img width="80px" src="uploads/<?php echo $result_product["productImage"] ?>" />
                  <input type="file" name="productImage" />
                </td>
              </tr>

              <tr>
                <td>
                  <label>Product Type</label>
                </td>
                <td>
                  <select id="select" name="productType">
                    <option>Select Type</option>
                    <?php
                    if ($result_product['productType'] == 1) {
                    ?>
                      <option selected value="1">Featured</option>
                      <option value="0">Non-Featured</option>
                    <?php
                    } else {
                    ?>
                      <option value="1">Featured</option>
                      <option selected value="0">Non-Featured</option>
                    <?php
                    }
                    ?>

                  </select>
                </td>
              </tr>

              <tr>
                <td></td>
                <td>
                  <input type="submit" name="submit" Value="Update" />
                </td>
              </tr>
            </table>
          </form>


      <?php }
      } ?>
    </div>
  </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
  });
</script>
<!-- Load TinyMCE -->
<?php include_once 'inc/footer.php'; ?>