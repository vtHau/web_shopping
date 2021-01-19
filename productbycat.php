<?php
include "inc/header.php";
?>

<?php
if (!isset($_GET["catID"]) || $_GET["catID"] == NULL) {
	echo "<script>window.location = '404.php'</script>";
} else {
	$catID = $_GET["catID"];
}

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
// 	$catName =  $_POST["catName"];
// 	$updateCat = $cat->update_category($catName, $catID);
// }

?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>
					Category:
					<?php
					$nameCat = $cat->getNameByCat($catID);
					if ($nameCat) {
						while ($resultName = $nameCat->fetch_assoc()) {
							$nameResult = $resultName["catName"];
						}
					}

					if (isset($nameResult)) {
						echo $nameResult;
					}
					?>
				</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php
			$productByCat = $cat->getProductByCart($catID);
			if ($productByCat) {
				while ($result = $productByCat->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.php"> <img height="80px" src="admin/uploads/<?php echo $result["productImage"] ?>" /> </a>
						<h2><?php echo $result["productName"] ?> </h2>
						<p><?php echo $fm->textShorten($result["productDesc"], 25);  ?></p>
						<p><span class="price">$<?php echo $result["productPrice"] ?></span></p>
						<div class="button"><span><a href="details.php?productID=<?php echo $result["productID"] ?>" class="details">Details</a></span></div>
					</div>

			<?php
				}
			} else {
				echo "Khong co san pham nao trong danh muc nay";
			}
			?>
		</div>
	</div>
</div>

<?php
include "inc/footer.php";
?>