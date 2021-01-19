<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class customer
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function insertCustomer($data)
  {
    $name = mysqli_real_escape_string($this->db->link, $data["name"]);
    $city = mysqli_real_escape_string($this->db->link, $data["city"]);
    $zipcode = mysqli_real_escape_string($this->db->link, $data["zipcode"]);
    $email = mysqli_real_escape_string($this->db->link, $data["email"]);
    $address = mysqli_real_escape_string($this->db->link, $data["address"]);
    $country = mysqli_real_escape_string($this->db->link, $data["country"]);
    $phone = mysqli_real_escape_string($this->db->link, $data["phone"]);
    $password = mysqli_real_escape_string($this->db->link, $data["password"]);

    if ($name == '' || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "") {
      $alert = "<span class='error'>Fiedls must be not empty</span>";
      return $alert;
    } else {
      $checkEmail = "SELECT * FROM  tbl_customer WHERE email = '$email' LIMIT 1";
      $resultCheck = $this->db->select($checkEmail);
      if ($resultCheck) {
        $alert = "<span class='error'>Dia chi Email khong hop le</span>";
        return $alert;
      } else {
        $query = "INSERT INTO tbl_customer(name, address, city, country,zipcode, phone, email, password) VALUES('$name','$address', '$city', '$country', '$zipcode', '$phone', '$email', '$password')";
        $result = $this->db->insert($query);
        if ($result) {
          $alert = "<span class='error'>Them nguoi dung thanh cong</span>";
          return $alert;
        } else {
          $alert = "<span class='error'>Them nguoi dung khong thanh cong</span>";
          return $alert;
        }
      }
    }
  }
}
