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
    $password = md5($password);

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

  public function loginCustomer($data)
  {
    $email = mysqli_real_escape_string($this->db->link, $data["email"]);
    $password = mysqli_real_escape_string($this->db->link, $data["password"]);

    if ($email == "" || $password == "") {
      $alert = "<span class='error'>Vui long hoan thanh cac truong</span>";
      return $alert;
    } else {
      $password = md5($password);
      $checkLogin = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password'";
      $resultCheck = $this->db->select($checkLogin);;

      if ($resultCheck) {
        $value = $resultCheck->fetch_assoc();
        Session::set("customer_login", true);
        Session::set("customer_ID",  $value["ID"]);
        Session::set("customer_name",  $value["name"]);
        header("Location: order.php");
      } else {
        $alert = "<span class='error'>Email hoac mat khau khong hop le</span>";
        return $alert;
      }
    }
  }

  public function getCustomer($ID)
  {
    $query = "SELECT * FROM tbl_customer WHERE ID = '$ID'";
    $result = $this->db->select($query);
    return $result;
  }

  public function updateCustomer($data, $ID)
  {
    $name = mysqli_real_escape_string($this->db->link, $data["name"]);
    // $city = mysqli_real_escape_string($this->db->link, $data["city"]);
    $zipcode = mysqli_real_escape_string($this->db->link, $data["zipcode"]);
    $email = mysqli_real_escape_string($this->db->link, $data["email"]);
    $address = mysqli_real_escape_string($this->db->link, $data["address"]);
    $phone = mysqli_real_escape_string($this->db->link, $data["phone"]);
    // $password = mysqli_real_escape_string($this->db->link, $data["password"]);
    // $password = md5($password);

    if ($name == ''  || $zipcode == "" || $email == "" || $address == "" || $phone == "") {
      $alert = "<span class='error'>Fiedls must be not empty</span>";
      return $alert;
    } else {
      $query = "UPDATE tbl_customer SET name = '$name', address = '$address', zipcode = '$zipcode', phone = '$phone', email = '$email'";
      $result = $this->db->update($query);
      if ($result) {
        $alert = "<span class='error'>Cap nhap thong tin thanh cong</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Cap nhap thong tin khong thanh cong</span>";
        return $alert;
      }
    }
  }
}
