﻿<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Order Time</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Customer ID</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$ct = new cart();
					$fm = new Format();
					$getInboxCart = $ct->getInboxCart();
					if ($getInboxCart) {
						$i = 0;
						while ($result = $getInboxCart->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $fm->formatDate($result["date_order"]);  ?></td>
								<td><?php echo $result["productName"] ?></td>
								<td><?php echo $result["quantity"] ?></td>
								<td><?php echo $result["price"] . " VND" ?></td>
								<td><?php echo $result["customer_ID"] ?></td>
								<td><a href="customer.php?customerID=<?php echo $result["customer_ID"] ?>">View Customer</a></td>
								<td>
									<?php
									if ($result["status"] == 0) {
									?>
										<a href="?shiftID=<?php echo $result["ID"] ?>&price=<?php echo $result["price"] ?>&time=<?php echo $result["date_order"] ?>">Pending</a>
									<?php
									} else {
									?>
										<a href="?shiftID=<?php echo $result["ID"] ?>&price=<?php echo $result["price"] ?>&time=<?php echo $result["data_order"] ?>">Remove</a>

									<?php } ?>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>