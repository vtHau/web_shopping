<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
			$getLastedDell = $pd->getLastedDell();
			if ($getLastedDell) {
				while ($resultDell = $getLastedDell->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img height="80px" src="admin/uploads/<?php echo $resultDell["productImage"] ?>" /> </a>
						</div>
						<div class="text list_2_of_1">
							<h2>dell</h2>
							<p><?php echo $resultDell["productName"] ?></p>
							<div class="button"><span><a href="details.php?productID=<?php echo $resultDell["productID"] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
			<?php
			$getLastedApple = $pd->getLastedApple();
			if ($getLastedApple) {
				while ($resultApple = $getLastedApple->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img height="80px" src="admin/uploads/<?php echo $resultApple["productImage"] ?>" /> </a>
						</div>
						<div class="text list_2_of_1">
							<h2>apple</h2>
							<p><?php echo $resultApple["productName"] ?></p>
							<div class="button"><span><a href="details.php?productID=<?php echo $resultApple["productID"] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="section group">
			<?php
			$getLastedSamsung = $pd->getLastedSamsung();
			if ($getLastedSamsung) {
				while ($resultSamsung = $getLastedSamsung->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img height="80px" src="admin/uploads/<?php echo $resultSamsung["productImage"] ?>" /> </a>
						</div>
						<div class="text list_2_of_1">
							<h2>samsung</h2>
							<p><?php echo $resultSamsung["productName"] ?></p>
							<div class="button"><span><a href="details.php?productID=<?php echo $resultSamsung["productID"] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>

			<?php
			$getLastedXiaomi = $pd->getLastedXiaomi();
			if ($getLastedXiaomi) {
				while ($resultXiaomi = $getLastedXiaomi->fetch_assoc()) {
			?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="details.php"> <img height="80px" src="admin/uploads/<?php echo $resultXiaomi["productImage"] ?>" /> </a>
						</div>
						<div class="text list_2_of_1">
							<h2>xiaomi</h2>
							<p><?php echo $resultXiaomi["productName"] ?></p>
							<div class="button"><span><a href="details.php?productID=<?php echo $resultXiaomi["productID"] ?>">Add to cart</a></span></div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="header_bottom_right_images">
		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<li><img src="images/1.jpg" alt="" /></li>
					<li><img src="images/2.jpg" alt="" /></li>
					<li><img src="images/3.jpg" alt="" /></li>
					<li><img src="images/4.jpg" alt="" /></li>
				</ul>
			</div>
		</section>
	</div>

	<div class="clear"></div>
</div>