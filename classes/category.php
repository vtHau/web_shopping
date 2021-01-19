<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class category
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public  function insert_category($catName)
  {
    $catName = $this->fm->validation($catName);

    $catName = mysqli_real_escape_string($this->db->link, $catName);

    if (empty($catName)) {
      $alert = "<span class='error'>Danh muc khong duoc de trong</span>";
      return $alert;
    } else {
      $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
      $result = $this->db->insert($query);

      if ($result) {
        $alert = "<span class='success'> Them thanh cong</span>";
        return $alert;
      } else {
        $alert = "<span class='error'> Them khong thanh cong</span>";
        return $alert;
      }
    }
  }

  public function show_category()
  {
    $query = "SELECT * FROM tbl_category ORDER BY catID DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function show_category_front()
  {
    $query = "SELECT * FROM tbl_category ORDER BY catID DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function getCatByID($ID)
  {
    $query = "SELECT * FROM tbl_category WHERE catID = '$ID' ";
    $result = $this->db->select($query);
    return $result;
  }

  public function update_category($catName, $catID)
  {
    $catName = $this->fm->validation($catName);

    $catName = mysqli_real_escape_string($this->db->link, $catName);
    $catID = mysqli_real_escape_string($this->db->link, $catID);

    if (empty($catName)) {
      $alert = "<span class='error'>Danh muc khong duoc de trong</span>";
      return $alert;
    } else {
      $query = "UPDATE tbl_category SET catName = '$catName' WHERE catID = '$catID'";
      $result = $this->db->update($query);

      if ($result) {
        $alert = "<span class='success'>Cap nhap thanh cong</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Cap nhap khong thanh cong</span>";
        return $alert;
      }
    }
  }

  public function delete_category($catID)
  {
    $query = "DELETE FROM tbl_category WHERE catID = '$catID'";
    $result = $this->db->delete($query);

    if ($result) {
      $alert = "<span class='success'>Xoa thanh cong</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Xoa that bai</span>";
      return $alert;
    }
  }

  public function getProductByCart($catID)
  {
    $query = "SELECT * FROM tbl_product WHERE catID = '$catID' ORDER BY catID DESC LIMIT 8";
    $result = $this->db->select($query);
    return $result;
  }

  public function getNameByCat($catID)
  {
    $query = "SELECT catName FROM tbl_category WHERE catID = '$catID' LIMIT 1";
    $result = $this->db->select($query);
    return $result;
  }
}
