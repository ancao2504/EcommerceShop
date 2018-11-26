<?php 

function GetProducts($query)
{
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

   <!--sản phẩm bán mới nhất -->
   <div class="container">
      <h3 class="title text-left SPBanChay">SẢN PHẨM MỚI NHẤT</h3>
      <div class="row">
      <?php 
      $query = "SELECT MaSanPham, TenHienThi, Gia, HinhURL FROM sanpham WHERE (MaLoai = 1 or MaLoai = 3 or MaLoai = 4) ORDER BY NgayNhap DESC LIMIT 10";
      GetProducts($query);
      ?>
      </div>
   </div>
   <!-- hết sản phẩm mới nhất -->

   <!--sản phẩm bán chạy nhất -->
   <div class="container">
      <h3 class="title text-left SPBanChay">SẢN PHẨM BÁN CHẠY NHẤT</h3>
      <div class="row">
        <?php 
         $query = "SELECT MaSanPham, TenHienThi, Gia, HinhURL FROM sanpham WHERE (MaLoai = 1 or MaLoai = 3 or MaLoai = 4) ORDER BY SoLuongBan DESC LIMIT 10";
         GetProducts($query);
         ?>
      </div>
   </div>
   <!--hết sản phẩm bán chạy nhất -->
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="header-top"></div>
         </div>
      </div>
   </div>
   

   <!-- footer -->
   <?php include_once("./footer.php"); ?>
</body>
</html>