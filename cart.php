<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
if (isset($_GET["cartID"])) {
	$cartID = $_GET["cartID"];
	$deleteCart = $ct->deleteCart($cartID);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
	$productQuantity = $_POST["productQuantity"];
	$cartID = $_POST["cartID"];
	$updateQuantityCart = $ct->updateQuantityCart($cartID, $productQuantity);
	if ($productQuantity <= 0) {
		$ct->deleteCart($cartID);
	}
}
?>

<?php
if (!isset($_GET["id"])) {
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>

<div class="main">
	<div class="content">
		<div class="cartoption">
			<div class="cartpage">

				<?php
				if (isset($deleteCart)) {
					echo $deleteCart;
				}
				?>
				<h2>Your Cart</h2>
				<table class="tblone">
					<tr>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>

					<?php

					$productCart = $ct->getProductCart();

					if ($productCart) {
						$total = 0;
						$quantity = 0;
						while ($result = $productCart->fetch_assoc()) {
							$quantity += $result["productQuantity"];
							$total = $total + (($result["productQuantity"]) * ($result["productPrice"]));
					?>
							<tr>
								<td><?php echo $result["productName"] ?></td>
								<td><img height="80px" src="admin/uploads/<?php echo $result["productImage"] ?>" /></td>
								<td><?php echo $fm->format_currency($result["productPrice"]) . " VND"  ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartID" value="<?php echo $result["cartID"] ?>" />
										<input type="number" min="0" name="productQuantity" value="<?php echo $result["productQuantity"] ?>" />
										<input type="submit" name="submit" value="Update" />
									</form>
								</td>
								<td><?php echo $fm->format_currency(($result["productPrice"]  * $result["productQuantity"])) ?></td>
								<td><a href="?cartID=<?php echo $result["cartID"] ?>">X</a></td>
							</tr>
					<?php
						}
					}
					?>

				</table>
				<?php
				$checkCart = $ct->check_cart();
				if ($check_cart) {
				?>
					<table style="float:right;text-align:left;" width="40%">
						<tr>
							<th>Sub Total : </th>
							<td><?php if (isset($total)) echo $fm->format_currency($total); ?></td>
						</tr>
						<tr>
							<th>VAT : </th>
							<td>TK. 10%</td>
						</tr>
						<tr>
							<th>Grand Total :</th>
							<td> TK.
								<?php
								if (isset($total)) {
									$VAT = $total * 0.1;
									$sum = $total + $VAT;
									echo $fm->format_currency($sum);
									Session::set('sum', $sum);
									Session::set('quantity', $quantity);
								}
								?>
							</td>
						</tr>
					</table>
				<?php
				} else {
					echo "<span>Khong co thong tin de hien thi</span>";
				} ?>

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