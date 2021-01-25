<?php
include_once "inc/header.php";
?>

<?php

if (isset($_GET["delID"])) {
	$customer_ID = Session::get("customer_ID");
	$productID = $_GET["delID"];
	$delWishlist = $ct->deleteWishlist($productID, $customer_ID);
}


?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">
				<h2 width="100%">Product Wishlist</h2>
				<table class="tblone">
					<tr>
						<th width="10%">ID Wishlist</th>
						<th width="20%">Product Name</th>
						<th width="20%">Image</th>
						<th width="25%">Price</th>
						<th width="15%">Action</th>
					</tr>

					<?php
					$customer_ID = Session::get("customer_ID");
					$productWishlist = $ct->productWishlist($customer_ID);
					if ($productWishlist) {
						$i = 0;
						while ($result = $productWishlist->fetch_assoc()) {
							$i++;
					?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result["productName"] ?></td>
								<td><img height="80px" src="admin/uploads/<?php echo $result["image"] ?>" /></td>
								<td><?php echo $result["price"] ?></td>
								<td>
									<a href="?delID=<?php echo $result["product_ID"] ?>">Remove </a>|
									<a href="details.php?productID=<?php echo $result["product_ID"] ?>">Buy Now</a>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</table>

				<?php
				if (isset($delWishlist)) {
					echo $delWishlist;
				}
				?>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>

<?php
include "inc/footer.php";
?>