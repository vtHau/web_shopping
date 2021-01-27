<?php
include "inc/header.php";
include "inc/slider.php";
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$productFeathered = $pd->getProductFeathered();

			if ($productFeathered) {
				while ($result = $productFeathered->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img height="80px" src="admin/uploads/<?php echo $result["productImage"] ?>" /></a>
						<h2><?php echo $result["productName"] ?> </h2>
						<p><?php echo $fm->textShorten($result["productDesc"], 25) ?></p>
						<p><span class="price"><?php echo $fm->format_currency($result["productPrice"]) . " VND"  ?></span></p>
						<div class="button"><span><a href="details.php?productID=<?php echo $result["productID"] ?>" class="details">Details</a></span></div>
					</div>

			<?php
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			$productNew = $pd->getProductNew();

			if ($productNew) {
				while ($result = $productNew->fetch_assoc()) {
			?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img height="80px" src="admin/uploads/<?php echo $result["productImage"] ?>" /></a>
						<h2><?php echo $result["productName"] ?> </h2>
						<p><?php echo $fm->textShorten($result["productDesc"], 25) ?></p>
						<p><span class="price"><?php echo $fm->format_currency($result["productPrice"]) . " VND"  ?></span></p>
						<div class="button"><span><a href="details.php?productID=<?php echo $result["productID"] ?>" class="details">Details</a></span></div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div>
			<?php
			$productAll = $pd->getAllProdut();
			$productCount = mysqli_num_rows($productAll);
			$productButton = ceil($productCount / 4);
			$i = 1;
			echo '<p>Page: </p>';
			for ($i = 1; $i <= $productButton; $i++) {
				echo '<a style="margin: 0 50px;" href="index.php?page=' . $i . '">' . $i . '</a>';
			}
			?>

		</div>
	</div>
</div>

<?php
include "inc/footer.php";
?>