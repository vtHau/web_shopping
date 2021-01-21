<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class cart
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function addToCart($productID, $productQuantity)
  {
    $productQuantity = $this->fm->validation($productQuantity);
    $productQuantity = mysqli_real_escape_string($this->db->link, $productQuantity);
    $productID = mysqli_real_escape_string($this->db->link, $productID);
    $SID = session_id();

    $query = "SELECT * FROM tbl_product WHERE productID = '$productID'";
    $result = $this->db->select($query)->fetch_assoc();

    $productName = $result["productName"];
    $productPrice = $result["productPrice"];
    $productImage = $result["productImage"];


    $checkCart = "SELECT * FROM tbl_cart WHERE productID = '$productID' AND SID = '$SID'";
    $result = $this->db->select($checkCart);

    if ($result) {
      $result = "San pham da ton tai trong gio hang";
      return $result;
    } else {
      $query_insert = "INSERT INTO tbl_cart(productID, SID, productName, productPrice, productQuantity, productImage)
      VALUES('$productID', '$SID', '$productName', '$productPrice' , '$productQuantity', '$productImage') ";

      $result_insert = $this->db->insert($query_insert);

      if ($result_insert) {
        header("Location: cart.php");
      } else {
        header("Location: 404.php");
      }
    }
  }

  public function getProductCart()
  {
    $SID = session_id();
    $query = "SELECT * FROM tbl_cart WHERE SID = '$SID'";
    $result = $this->db->select($query);
    return $result;
  }

  public function updateQuantityCart($cartID, $productQuantity)
  {

    $query = "UPDATE tbl_cart SET productQuantity = '$productQuantity' WHERE cartID = '$cartID'";
    $result = $this->db->update($query);
    if ($result) {
      header('Location:cart.php');
    } else {
      $msg = "<span class='erorr'> Product Quantity Update NOT Succesfully</span> ";
      return $msg;
    }
  }

  public function deleteCart($cartID)
  {
    $cartID = $this->fm->validation($cartID);
    $query = "DELETE FROM tbl_cart WHERE cartID = '$cartID'";
    $result = $this->db->delete($query);
    if ($result) {
      header('Location:cart.php');
    } else {
      $msg = "<span class='error'>Sản phẩm đã được xóa</span>";
      return $msg;
    }
  }

  public function check_cart()
  {
    $SID = session_id();
    $query = "SELECT * FROM tbl_cart WHERE SID = '$SID'";
    $result = $this->db->select($query);
    return $result;
  }

  public function deleteAllCart()
  {
    $SID = session_id();
    $query = "DELETE  FROM tbl_cart WHERE SID = '$SID'";
    $result = $this->db->delete($query);
    return $result;
  }
}
