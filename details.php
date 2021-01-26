<?php
include_once 'inc/header.php';
?>

<?php
if (!isset($_GET["productID"]) || $_GET["productID"] == NULL) {
	echo "<script> window.location = '404.php' </script>";
} else {
	$productID = $_GET["productID"];
}

$customer_ID = Session::get("customer_ID");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['compare'])) {
	$productID = $_POST["productID"];
	$insertCompare = $ct->insertCompare($productID, $customer_ID);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['wishlist'])) {
	$productID = $_POST["productID"];
	$insertWishlist = $ct->insertWishlist($productID, $customer_ID);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
	$productQuantity = $_POST["productQuantity"];
	$addCart = $ct->addToCart($productID, $productQuantity);
}

?>

<div class="main">
	<div class="content">
		<div class="section group">

			<?php
			$productDetail = $pd->getProductDetail($productID);

			if ($productID) {
				while ($result = $productDetail->fetch_assoc()) {
			?>
					<div class="cont-desc span_1_of_2">
						<div class="grid images_3_of_2">
							<img height="80px" src="admin/uploads/<?php echo $result["productImage"] ?>" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result["productName"] ?></h2>
							<p><?php echo $fm->textShorten($result["productDesc"], 200) ?></p>
							<div class="price">
								<p>Price: <span>$<?php echo $fm->format_currency($result["productPrice"]) ?></span></p>
								<p>Category: <span><?php echo $result["catName"] ?></span></p>
								<p>Brand:<span><?php echo $result["brandName"] ?></span></p>
							</div>


							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="productQuantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>

								<?php
								if (isset($addCart)) {
									echo "<span > San pham da ton tai trong gio hang</span>";
								}
								?>
							</div>

							<div class="add-cart">
								<form action="" method="POST">
									<input type="hidden" name="productID" value="<?php echo $result['productID'] ?>" />
									<?php
									$login_check = Session::get('customer_login');
									if ($login_check) {
										echo '<input type="submit" class="buysubmit" name="compare" value="So sánh sản phẩm" />';
									}
									?>

									<?php
									if (isset($insertCompare)) {
										echo $insertCompare;
									}
									?>
								</form>
								<!-- save to wishlist -->
								<form action="" method="POST">
									<input type="hidden" name="productID" value="<?php echo $result['productID'] ?>" />
									<?php
									$login_check = Session::get('customer_login');
									if ($login_check) {
										echo '<input type="submit" class="buysubmit" name="wishlist" value="Sản phẩm yêu thích" />';
									}
									?>

									<?php
									if (isset($insertWishlist)) {
										echo $insertWishlist;
									}
									?>
								</form>
							</div>


						</div>
						<div class="product-desc">
							<h2>Product Details</h2>
							<p><?php echo $result["productDesc"] ?></p>
							<p><?php echo $result["productDesc"] ?></p>
						</div>
					</div>
			<?php
				}
			}
			?>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>

					<?php
					$getAllCategory = $cat->show_category_front();
					if ($getAllCategory) {
						while ($result = $getAllCategory->fetch_assoc()) {
					?>
							<li><a href="productbycat.php?catID=<?php echo $result["catID"] ?>"><?php echo $result["catName"] ?></a></li>
					<?php
						}
					}
					?>
				</ul>

			</div>
		</div>
	</div>
</div>


<?php
include "inc/footer.php";
?>