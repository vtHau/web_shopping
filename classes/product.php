<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class product
{
  private $db;
  private $fm;

  public function __construct()
  {
    $this->db = new Database();
    $this->fm = new Format();
  }

  public  function insert_product($data,  $files)
  {
    $productName = mysqli_real_escape_string($this->db->link, $data["productName"]);
    $productCategory = mysqli_real_escape_string($this->db->link, $data["productCategory"]);
    $productBrand = mysqli_real_escape_string($this->db->link, $data["productBrand"]);
    $productDesc = mysqli_real_escape_string($this->db->link, $data["productDesc"]);
    $productPrice = mysqli_real_escape_string($this->db->link, $data["productPrice"]);
    $productType = mysqli_real_escape_string($this->db->link, $data["productType"]);

    // kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
    $permited = ['jpg', 'jpeg', 'png', 'gif'];
    $file_name = $files['productImage']['name'];
    $file_size = $files['productImage']['size'];
    $file_temp = $files['productImage']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if ($productName == '' || $productCategory == "" || $productBrand == "" || $productDesc == "" || $productPrice == "" || $productType == "" || $file_name == "") {
      $alert = "<span class='error'>Fiedls must be not empty</span>";
      return $alert;
    } else {
      move_uploaded_file($file_temp, $uploaded_image);

      $query = "INSERT INTO tbl_product(productName , catID , brandID , productDesc , productType , productPrice , productImage) VALUES('$productName','$productCategory','$productBrand','$productDesc','$productType' , '$productPrice' , '$unique_image') ";

      $result = $this->db->insert($query);
      if ($result) {
        $alert = "<span class='success'>Insert Product Successfully</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Insert Prodcut NOT Success</span>";
        return $alert;
      }
    }
  }

  public function show_product() #9696FF"
  {
    // $query = "SELECT * FROM tbl_product ORDER BY productID DESC";
    $query = "SELECT tbl_product.* , tbl_category.catName , tbl_brand.brandName 
              FROM tbl_product , tbl_category , tbl_brand 
              WHERE tbl_product.catID = tbl_category.catID AND tbl_product.brandID = tbl_brand.brandID 
              ORDER BY tbl_product.productID DESC";

    $result = $this->db->select($query);
    return $result;
  }

  public function getProductByID($ID)
  {
    $query = "SELECT * FROM tbl_product WHERE productID = '$ID' ";
    $result = $this->db->select($query);
    return $result;
  }

  public function update_product($data,  $files, $productID)
  {
    $productName = mysqli_real_escape_string($this->db->link, $data["productName"]);
    $productCategory = mysqli_real_escape_string($this->db->link, $data["productCategory"]);
    $productBrand = mysqli_real_escape_string($this->db->link, $data["productBrand"]);
    $productDesc = mysqli_real_escape_string($this->db->link, $data["productDesc"]);
    $productPrice = mysqli_real_escape_string($this->db->link, $data["productPrice"]);
    $productType = mysqli_real_escape_string($this->db->link, $data["productType"]);

    // kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
    $permited = ['jpg', 'jpeg', 'png', 'gif'];
    $file_name = $files['productImage']['name'];
    $file_size = $files['productImage']['size'];
    $file_temp = $files['productImage']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if ($productName == '' || $productCategory == "" || $productBrand == "" || $productDesc == "" || $productPrice == "" || $productType == "") {
      $alert = "<span class='error'>Fiedls must be not empty</span>";
      return $alert;
    } elseif (!empty($file_name)) {
      //Nếu người dùng chọn ảnh
      if ($file_size > 20480) {

        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
        return $alert;
      } elseif (in_array($file_ext, $permited) === false) {
        // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
        $alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
        return $alert;
      }
      move_uploaded_file($file_temp, $uploaded_image);
      $query = "UPDATE tbl_product SET
                productName = '$productName',
                brandID = '$productBrand',
                catID = '$productCategory', 
                productType = '$productType', 
                productPrice = '$productPrice', 
                productImage = '$unique_image',
                productDesc = '$productDesc'
                WHERE productID = '$productID'";
    } else {
      //Nếu người dùng không chọn ảnh
      $query = "UPDATE tbl_product SET
                productName = '$productName',
                brandID = '$productBrand',
                catID = '$productCategory', 
                productType = '$productType', 
                productPrice = '$productPrice', 
                productDesc = '$productDesc'
                WHERE productID = '$productID'";
    }
    $result = $this->db->update($query);
    if ($result) {
      $alert = "<span class='success'>Sản phẩm Updated thành công</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Sản phẩm Updated không thành công</span>";
      return $alert;
    }
  }

  public function delete_product($productID)
  {
    $query = "DELETE FROM tbl_product WHERE productID = '$productID'";
    $result = $this->db->delete($query);

    if ($result) {
      $alert = "<span class='success'>Xoa thanh cong</span>";
      return $alert;
    } else {
      $alert = "<span class='error'>Xoa that bai</span>";
      return $alert;
    }
  }

  public function getProductFeathered()
  {
    $query = "SELECT * FROM tbl_product WHERE productType = 1 ";
    $result = $this->db->select($query);
    return $result;
  }

  public function getProductNew()
  {
    $query = "SELECT * FROM tbl_product ORDER BY productID DESC LIMIT 4 ";
    $result = $this->db->select($query);
    return $result;
  }

  public function getProductDetail($productID)
  {
    $query = "SELECT tbl_product.* , tbl_category.catName , tbl_brand.brandName 
              FROM tbl_product , tbl_category , tbl_brand 
              WHERE tbl_product.catID = tbl_category.catID AND tbl_product.brandID = tbl_brand.brandID 
              AND tbl_product.productID = '$productID'
              ORDER BY tbl_product.productID DESC";

    $result = $this->db->select($query);
    return $result;
  }

  public function getLastedDell()
  {
    $query = "SELECT * FROM tbl_product WHERE brandID = 1 ORDER BY productID DESC LIMIT 1 ";
    $result = $this->db->select($query);
    return $result;
  }

  public function getLastedApple()
  {
    $query = "SELECT * FROM tbl_product WHERE brandID = 3 ORDER BY productID DESC LIMIT 1 ";
    $result = $this->db->select($query);
    return $result;
  }

  public function getLastedXiaomi()
  {
    $query = "SELECT * FROM tbl_product WHERE brandID = 5 ORDER BY productID DESC LIMIT 1 ";
    $result = $this->db->select($query);
    return $result;
  }

  public function getLastedSamsung()
  {
    $query = "SELECT * FROM tbl_product WHERE brandID = 6 ORDER BY productID DESC LIMIT 1 ";
    $result = $this->db->select($query);
    return $result;
  }

  public function insertSlider($data, $files)
  {
    $sliderName = mysqli_real_escape_string($this->db->link, $data["sliderName"]);
    $type = mysqli_real_escape_string($this->db->link, $data["type"]);

    // kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
    $permited = ['jpg', 'jpeg', 'png', 'gif'];
    $file_name = $files['image']['name'];
    $file_size = $files['image']['size'];
    $file_temp = $files['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;

    if ($sliderName == '' || $type == ""  || $file_name == "") {
      $alert = "<span class='error'>Fiedls must be not empty</span>";
      return $alert;
    } elseif (!empty($file_name)) {
      //Nếu người dùng chọn ảnh
      if ($file_size > 2048000) {
        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
        return $alert;
      } elseif (in_array($file_ext, $permited) === false) {
        // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
        $alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
        return $alert;
      }

      move_uploaded_file($file_temp, $uploaded_image);
      $query = "INSERT INTO tbl_slider(sliderName , sliderImage , sliderType ) VALUES('$sliderName','$unique_image','$type') ";
      $result = $this->db->insert($query);

      if ($result) {
        $alert = "<span class='success'>Thêm sản slider thành công</span>";
        return $alert;
      } else {
        $alert = "<span class='error'>Thêm slider không thành công</span>";
        return $alert;
      }
    }
  }

  public function getSlider()
  {
    $query = "SELECT * FROM tbl_slider WHERE sliderType = 1 ORDER BY sliderID DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function getSliderAdmin()
  {
    $query = "SELECT * FROM tbl_slider ORDER BY sliderID DESC";
    $result = $this->db->select($query);
    return $result;
  }

  public function updateTypeSlider($ID, $type)
  {
    $type = mysqli_real_escape_string($this->db->link, $type);
    $query = "UPDATE tbl_slider SET sliderType = '$type' WHERE sliderID = '$ID'";
    $result = $this->db->update($query);
  }

  public function deleteSlider($ID)
  {
    $query = "DELETE FROM tbl_slider WHERE sliderID = '$ID'";
    $result = $this->db->delete($query);
  }

  public function searchProduct($keyword)
  {
    $keyword = $this->fm->validation($keyword);
    $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$keyword%'";
    $result = $this->db->select($query);
    return $result;
  }
}
