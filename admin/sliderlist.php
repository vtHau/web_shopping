<?php include_once 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php

$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/product.php');
?>

<?php
$pd = new product();
if (isset($_GET["sliderID"]) && isset($_GET["type"])) {
	$ID = $_GET["sliderID"];
	$type = $_GET["type"];
	$updateTypeSlider = $pd->updateTypeSlider($ID, $type);
}

if (isset($_GET["del_ID"])) {
	$ID = $_GET["del_ID"];
	$deleteSlider = $pd->deleteSlider($ID);
}
?>

<div class="grid_10">
	<div class="box round first grid">
		<h2>Slider List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Slider Title</th>
						<th>Slider Image</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					<?php
					$getSlider = $pd->getSliderAdmin();

					if ($getSlider) {
						$i = 0;
						while ($result = $getSlider->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result["sliderName"] ?></td>
								<td><img height="50px" src="uploads/<?php echo $result["sliderImage"] ?>" /></td>
								<td>
									<?php
									if ($result['sliderType'] == 1) {
									?>
										<a href="?sliderID=<?php echo $result['sliderID'] ?>&type=0">Off</a>
									<?php
									} else {
									?>
										<a href="?sliderID=<?php echo $result['sliderID'] ?>&type=1">On</a>
									<?php
									}
									?>
								</td>
								<td>
									<a href="">Edit</a> ||
									<a href="?del_ID=<?php echo $result["sliderID"] ?>" onclick="return confirm('Are you sure to Delete!');">Delete</a>
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