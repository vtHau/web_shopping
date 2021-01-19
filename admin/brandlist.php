<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include "../classes/brand.php"; ?>

<?php
$brand = new brand();
if (isset($_GET["delID"])) {
  $brandID = $_GET["delID"];
  $delBrand = $brand->delete_brand($brandID);
}
?>

<div class="grid_10">
  <div class="box round first grid">
    <h2>brandegory List</h2>
    <div class="block">
      <?php
      if (isset($delBrand)) {
        echo $delBrand;
      }
      ?>

      <table class="data display datatable" id="example">
        <thead>
          <tr>
            <th>Serial No.</th>
            <th>Brand Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $show_brand = $brand->show_brand();
          if (isset($show_brand)) {
            $i = 0;
            while ($result = $show_brand->fetch_assoc()) {
              $i++;

          ?>
              <tr class="odd gradeX">
                <td><?php echo $i; ?></td>
                <td><?php echo $result["brandName"]; ?></td>
                <td><a href="brandedit.php?brandID=<?php echo $result["brandID"] ?> ">Edit</a> || <a onclick="return confirm('Ban co muon xoa san pham nay ?')" href="?delID=<?php echo $result["brandID"]; ?>">Delete</a></td>
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