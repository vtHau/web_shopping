<?php
include_once 'inc/header.php';
?>

<?php
if (!isset($_GET["productID"]) || $_GET["productID"] == NULL) {
	echo "<script> window.location = '404.php' </script>";
} else {
	$productID = $_GET["productID"];
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
								<p>Price: <span>$<?php echo $result["productPrice"] . " VND" ?></span></p>
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
								<a class="buysubmit" href="?wlist=<?php echo $result["productID"] ?>">Save to Withlist</a>
								<a class="buysubmit" href="?wlist=<?php echo $result["productID"] ?>">Compare Product</a>
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
<div class="footer">
	<div class="wrapper">
		<div class="section group">
			<div class="col_1_of_4 span_1_of_4">
				<h4>Information</h4>
				<ul>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Customer Service</a></li>
					<li><a href="#"><span>Advanced Search</span></a></li>
					<li><a href="#">Orders and Returns</a></li>
					<li><a href="#"><span>Contact Us</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Why buy from us</h4>
				<ul>
					<li><a href="about.php">About Us</a></li>
					<li><a href="faq.php">Customer Service</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="contact.php"><span>Site Map</span></a></li>
					<li><a href="preview-2.php"><span>Search Terms</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>My account</h4>
				<ul>
					<li><a href="contact.php">Sign In</a></li>
					<li><a href="index.php">View Cart</a></li>
					<li><a href="#">My Wishlist</a></li>
					<li><a href="#">Track My Order</a></li>
					<li><a href="faq.php">Help</a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Contact</h4>
				<ul>
					<li><span>+91-123-456789</span></li>
					<li><span>+00-123-000000</span></li>
				</ul>
				<div class="social-icons">
					<h4>Follow Us</h4>
					<ul>
						<li class="facebook"><a href="#" target="_blank"> </a></li>
						<li class="twitter"><a href="#" target="_blank"> </a></li>
						<li class="googleplus"><a href="#" target="_blank"> </a></li>
						<li class="contact"><a href="#" target="_blank"> </a></li>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
		</div>
		<div class="copy_right">
			<p>Compant Name © All rights Reseverd</a> </p>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/

		$().UItoTop({
			easingType: 'easeOutQuart'
		});

	});
</script>
<a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
</body>

</html>