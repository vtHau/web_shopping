<?php
include "inc/header.php";
?>

<div class="main">
  <div class="content">
    <?php
    if (isset($_SERVER["REQUEST_METHOD"])  == "POST") {
      $keyword = $_POST["keyword"];
      $searchProduct = $pd->searchProduct($keyword);
    }
    ?>
    <div class="content_top">
      <div class="heading">
        <h3>Tu khoa tim kiem: <?php echo $keyword ?> </h3>
      </div>
      <div class="clear"></div>
    </div>
    <div class="section group">
      <?php
      if ($searchProduct) {
        while ($result = $searchProduct->fetch_assoc()) {
      ?>
          <div class="grid_1_of_4 images_1_of_4">
            <a href="preview-3.php"> <img height="80px" src="admin/uploads/<?php echo $result["productImage"] ?>" /> </a>
            <h2><?php echo $result["productName"] ?> </h2>
            <p><?php echo $fm->textShorten($result["productDesc"], 25);  ?></p>
            <p><span class="price">$<?php echo $fm->format_currency($result["productPrice"]) ?></span></p>
            <div class="button"><span><a href="details.php?productID=<?php echo $result["productID"] ?>" class="details">Details</a></span></div>
          </div>
      <?php
        }
      } else {
        echo "Khong tim thay san pham nao";
      }
      ?>
    </div>
  </div>
</div>

<?php
include "inc/footer.php";
?>