<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include "../classes/category.php"; ?>

<?php

if (!isset($_GET["catID"]) || $_GET["catID"] == NULL) {
  echo "<script>window.location = 'catlist.php'</script>";
} else {
  $catID = $_GET["catID"];
}

$cat = new category();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $catName =  $_POST["catName"];
  $updateCat = $cat->update_category($catName, $catID);
}

?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>Edit Category</h2>
    <div class="block copyblock">
      <?php if (isset($updateCat)) {
        echo $updateCat;
      }
      ?>

      <?php
      $get_cate_name = $cat->getCatByID($catID);
      if ($get_cate_name) {
        while ($result = $get_cate_name->fetch_assoc()) {
      ?>
          <form action="" method="POST">
            <table class="form">
              <tr>
                <td>
                  <input type="text" value="<?php echo $result["catName"]; ?>" placeholder="Edit Category Name Products..." class="medium" name="catName" />
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