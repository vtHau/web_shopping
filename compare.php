<?php
include_once "inc/header.php";
// include_once "inc/slider.php";
?>

<?php
// if (isset($_GET["cartID"])) {
// 	$cartID = $_GET["cartID"];
// 	$deleteCart = $ct->deleteCart($cartID);
// }

// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
// 	$productQuantity = $_POST["productQuantity"];
// 	$cartID = $_POST["cartID"];
// 	$updateQuantityCart = $ct->updateQuantityCart($cartID, $productQuantity);
// 	if ($productQuantity <= 0) {
// 		$ct->deleteCart($cartID);
// 	}
// }
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

				<h2 width="100%">Product Compare</h2>
				<table class="tblone">
					<tr>
						<th width="10%">ID Compare</th>
						<th width="20%">Product Name</th>
						<th width="20%">Image</th>
						<th width="25%">Price</th>
						<th width="15%">Action</th>
					</tr>

					<?php
					$customer_ID = Session::get("customer_ID");
					$productCompare = $ct->productCompare($customer_ID);
					if ($productCompare) {
						$i = 0;
						while ($result = $productCompare->fetch_assoc()) {
							$i++;
					?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result["productName"] ?></td>
								<td><img height="80px" src="admin/uploads/<?php echo $result["image"] ?>" /></td>
								<td><?php echo $result["price"] ?></td>
								<td><a href="details.php?productID=<?php echo $result["productID"] ?>">View</a></td>
							</tr>
					<?php
						}
					}
					?>
				</table>
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