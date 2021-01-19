<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class brand
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public  function insert_brand($brandName)
  {
    $brandName = $this->fm->validation($brandName);

    $brandName = mysqli_real_escape_string($this->db->link, $brandName);

    if (empty($brandName)) {
      $alert = "<span class='error'>Thuong hieu khong duoc de trong</span>";
      return $alert;
    } else {
      $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
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

  public function show_brand()
  {
    $query = "SELECT * FROM tbl_brand ORDER BY brandID DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function getBrandByID($ID)
  {
    $query = "SELECT * FROM tbl_brand WHERE brandID = '$ID' ";
    $result = $this->db->select($query);
    return $result;
  }

  public function update_brand($brandName, $brandID)
  {
    $brandName = $this->fm->validation($brandName);

    $brandName = mysqli_real_escape_string($this->db->link, $brandName);
    $brandID = mysqli_real_escape_string($this->db->link, $brandID);

    if (empty($brandName)) {
      $alert = "<span class='error'>Thuong hieu khong duoc de trong</span>";
      return $alert;
    } else {
      $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandID = '$brandID'";
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

  public function delete_brand($brandID)
  {
    $query = "DELETE FROM tbl_brand WHERE brandID = '$brandID'";
    $result = $this->db->delete($query);

    if ($result) {
      $alert = "<span class='success'>Xoa thanh cong</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Xoa that bai</span>";
      return $alert;
    }
  }
}
