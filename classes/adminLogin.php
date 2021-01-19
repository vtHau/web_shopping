<?php
include "./../lib/session.php";
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');

Session::checkLogin();
?>

<?php
class adminLogin
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public  function login_admin($adminUser, $adminPass)
  {
    $adminUser = $this->fm->validation($adminUser);
    $adminPass = $this->fm->validation($adminPass);

    $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
    $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

    if (empty($adminUser) || empty($adminPass)) {
      $alert = "Khong duoc de trong tai khoan va mat khau";
      return $alert;
    } else {
      $query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' LIMIT 1 ";
      $result = $this->db->select($query);

      if ($result != false) {
        $value = $result->fetch_assoc();
        Session::set("adminLogin", true);
        Session::set("adminID", $value["adminID"]);
        Session::set("adminUser", $value["adminUser"]);
        Session::set("adminName", $value["adminName"]);
        header("Location: index.php");
      } else {
        $alert = "Mat khau hoac tai khoan khong dung";
        return $alert;
      }
    }
  }
}
