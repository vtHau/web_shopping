﻿<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include "../classes/category.php"; ?>

<?php
$cat = new category();
if (isset($_GET["delID"])) {
	$catID = $_GET["delID"];
	$delCat = $cat->delete_category($catID);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block">
			<?php
			if (isset($delCat)) {
				echo $delCat;
			}
			?>

			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$show_cate = $cat->show_category();
					if (isset($show_cate)) {
						$i = 0;
						while ($result = $show_cate->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result["catName"]; ?></td>
								<td><a href="catedit.php?catID=<?php echo $result["catID"] ?> ">Edit</a> || <a onclick="return confirm('Ban co muon xoa san pham nay ?')" href="?delID=<?php echo $result["catID"]; ?>">Delete</a></td>
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