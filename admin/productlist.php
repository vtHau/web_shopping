<?php include_once 'inc/header.php'; ?>
<?php include_once 'inc/sidebar.php'; ?>
<?php include_once "../classes/category.php"; ?>
<?php include_once "../classes/brand.php"; ?>
<?php include_once "../classes/product.php"; ?>
<?php include_once "../helpers/format.php"; ?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Product Image</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$pd = new product();
					$fm = new Format();
					$pdList = $pd->show_product();

					if ($pdList) {
						$i = 0;
						while ($result = $pdList->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result["productName"] ?></td>
								<td><?php echo $result["productPrice"] ?></td>
								<td><img width="80px" src="uploads/<?php echo $result["productImage"] ?>" /></td>
								<td><?php echo $result["catName"] ?></td>
								<td><?php echo $result["brandName"] ?></td>
								<td><?php echo $fm->textShorten($result["productDesc"], 50); ?></td>
								<td>
									<?php
									if ($result["productType"] == 1) {
										echo "Feathered";
									} else {
										echo "Non-Feathered";
									}
									?>
								</td>
								<td><a href="productedit.php?productID=<?php echo $result["productID"]; ?>">Edit</a> || <a href="?productID=<?php echo $result["productID"]; ?>">Delete</a></td>
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