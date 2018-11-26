<?php
function ShowProducts()
{
   if (isset($_GET['cat'])) {
      $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
      $query = "SELECT MaSanPham, TenHienThi, Gia, HinhURL from SANPHAM where MaLoai = $cat";
      $res = DataProvider::ExecuteQuery($query);
      while ($row = mysqli_fetch_array($res)) {
         $maSanPham = $row['MaSanPham'];
         $tenHienThi = $row['TenHienThi'];
         $gia = number_format($row['Gia'], 0, ".", ".");
         $urlHinh = $row['HinhURL'];
         echo ('
                        <div class="col-xs-12 col-sm-6 col-md-3">
                        <a href="details.php?id=' . $maSanPham . '">
                        <div class="thumbnail effect">
                            <img class="img-proc" src="' . $urlHinh . '" alt="" width="100%">
                            <div class="productname">' . $tenHienThi . '</div>
                            <h4 class="price">' . $gia . 'đ</h4>
                        </div>
                        </a>
                    </div>');
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php include_once("./header.php"); ?>
   <title>HTN STORE</title>
</head>
<body>
   <!-- thanh menu -->
   <?php include_once("./menu.php"); ?>
   
   <!-- slide -->
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
               </ol>
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <img class="d-block w-100" src="img/slide_1.jpg" alt="First slide">
                  </div>
                  <div class="carousel-item">
                     <img class="d-block w-100" src="img/slide_2.jpg" alt="First slide">
                  </div>
                  <div class="carousel-item">
                     <img class="d-block w-100" src="img/slide_3.jpg" alt="First slide">
                  </div>
                  <div class="carousel-item">
                     <img class="d-block w-100" src="img/slide_4.jpg" alt="First slide">
                  </div>
                  <div class="carousel-item">
                     <img class="d-block w-100" src="img/slide_5.jpg" alt="First slide">
                  </div>
               </div>
               <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
               </a>
            </div>
         </div>
      </div>
   </div>
   <!-- hết slide -->
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="header-top"></div>
         </div>
      </div>
   </div>

    <div class="container">
    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8">
                <div class="manunew mobile-img">
                    <?php 
                     if (isset($_GET['cat'])) {
                        $cat = $_GET['cat'];
                        $query = "SELECT DISTINCT (hsx.MaHangSanXuat), hsx.LogoURL FROM sanpham sp join hangsanxuat hsx on sp.MaHangSanXuat = hsx.MaHangSanXuat where sp.MaLoai = $cat";
                        $res = DataProvider::ExecuteQuery($query);
                        while ($row = mysqli_fetch_array($res)) {
                           $MaHangSanXuat = $row['MaHangSanXuat'];
                           $Logo = $row['LogoURL'];
                           echo ('<a href="brand.php?id=' . $cat . '&br=' . $MaHangSanXuat . '"><img src="' . $Logo . '"/></a>');
                        }
                     }
                     ?>
                </div>
            </div>
        </div>
    </div>
    <!-- hết logo cửa hãng sx -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="header-top mobile"></div>
            </div>
        </div>
   </div>

   <!--Kết quả -->
   <div class="container">
      <?php 
      $cat = isset($_GET['cat']) ? $_GET['cat'] : '';
      $query = "SELECT TenLoai FROM loaisanpham where MaLoai = $cat";
      $res = DataProvider::ExecuteQuery($query);
      while ($row = mysqli_fetch_array($res))
         $name = $row['TenLoai'];
      echo '<h3 class="title text-left SPBanChay">' . $name . ' nổi bật</h3><div class="row">';
      ShowProducts();
      ?>
      </div>
   </div>
   <!-- footer -->
   <?php include_once("./footer.php"); ?>
</body>
</html>