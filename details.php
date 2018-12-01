<?php 
session_start();
include_once("./database.php");

function GetDetailsProduct()
{
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $maSanPham = $_GET['id'];

        $query = "SELECT TenSanPham, Gia, LuotXem, SoLuongBan, MoTa, XuatXu, MaHangSanXuat, MaLoai FROM sanpham WHERE MaSanPham = $maSanPham";
        $res = DataProvider::ExecuteQuery($query);

        while ($row = mysqli_fetch_array($res)) {
            $tenSanPham = $row['TenSanPham'];
            $gia = number_format($row['Gia'], 0, ".", ".");
            $luotXem = $row['LuotXem'];
            $soLuongBan = $row['SoLuongBan'];
            $moTa = $row['MoTa'];
            $xuatXu = $row['XuatXu'];
            $nhaSanXuat = $row['MaHangSanXuat'];
            $maLoai = $row['MaLoai'];
        }

        $queryHangSX = "SELECT TenHangSanXuat FROM hangsanxuat WHERE MaHangSanXuat = $nhaSanXuat";
        $resHangSX = DataProvider::ExecuteQuery($queryHangSX);
        while ($row = mysqli_fetch_array($resHangSX)) {
            $nhaSanXuat = $row['TenHangSanXuat'];
        }

        $queryHinh = "SELECT HinhURL FROM hinhanh WHERE MaSanPham = $maSanPham";
        $resHinh = DataProvider::ExecuteQuery($queryHinh);
        $arr = array();
        while ($row = mysqli_fetch_array($resHinh)) {
            $myURL = $row['HinhURL'];
            array_push($arr, $myURL);
        }

        $querySPCungLoai = "SELECT MaSanPham, TenHienThi, HinhURL, concat(FORMAT(Gia, 0, 'de_DE'), 'Đ') as Gia  FROM sanpham where MaLoai = $maLoai and MaSanPham <> $maSanPham ORDER BY LuotXem DESC LIMIT 5";
        $resSPCungLoai = DataProvider::ExecuteQuery($querySPCungLoai);
        $arrSP = array();
        while ($row = mysqli_fetch_array($resSPCungLoai)) {
            $arrSP[] = $row;
        }

        echo ('
            <div class="container">
                <div class="card">
                        <div class="wrapper row">
                            <div class="preview col-md-6">
                                <div class="preview-pic tab-content">
                                    <div class="tab-pane active" id="pic-1"><img src="' . $arr[0] . '" /></div>
                                    <div class="tab-pane" id="pic-3"><img src="' . $arr[1] . '" /></div>
                                    <div class="tab-pane" id="pic-4"><img src="' . $arr[2] . '" /></div>
                                    <div class="tab-pane" id="pic-5"><img src="' . $arr[3] . '" /></div>
                                </div>
                                <ul class="preview-thumbnail nav nav-tabs">
                                    <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="' . $arr[0] . '" /></a></li>
                                    <li><a data-target="#pic-3" data-toggle="tab"><img src="' . $arr[1] . '" /></a></li>
                                    <li><a data-target="#pic-4" data-toggle="tab"><img src="' . $arr[2] . '" /></a></li>
                                    <li><a data-target="#pic-5" data-toggle="tab"><img src="' . $arr[3] . '" /></a></li>
                                </ul>  
                            </div>
                            <div class="details col-md-6">
                                <h3 class="product-title">' . $tenSanPham . '</h3>
                                <div class="rating">
                                    <div class="stars">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </div>
                                    <span class="review-no">' . $luotXem . ' lượt xem</span>
                                </div>
                                <p class="product-description">' . $moTa . '</p>
                                <h4 class="price">Giá bán: <span style="color: red;">' . $gia . 'đ</span></h4>
                                <p class="vote"><strong>' . $soLuongBan . '</strong> sản phẩm đã được bán! </p>
                                <p class="vote">Xuất xứ: ' . $xuatXu . '</p>
                                <p class="vote">Hãng sản xuất: ' . $nhaSanXuat . '</p>
                                <div class="action">
                                    <button class="add-to-cart btn btn-default" type="button">Mua Ngay <i class="fa fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="recommend-product-item">
                                <a href="details.php?id=' . $arrSP[0]['MaSanPham'] . '">
                                    <div class="thumbnail effect">
                                    <img class="img-proc" src="' . $arrSP[0]['HinhURL'] . '" width="100%">
                                    <div class="productname">' . $arrSP[0]['TenHienThi'] . '</div>
                                    <h4 class="price">' . $arrSP[0]['Gia'] . '</h4></div>
                                </a>
                            </div>
                            <div class="recommend-product-item">
                                <a href="details.php?id=' . $arrSP[1]['MaSanPham'] . '">
                                    <div class="thumbnail effect">
                                    <img class="img-proc" src="' . $arrSP[1]['HinhURL'] . '" width="100%">
                                    <div class="productname">' . $arrSP[1]['TenHienThi'] . '</div>
                                    <h4 class="price">' . $arrSP[1]['Gia'] . '</h4></div>
                                </a>
                            </div>
                            <div class="recommend-product-item">
                                <a href="details.php?id=' . $arrSP[2]['MaSanPham'] . '">
                                    <div class="thumbnail effect">
                                    <img class="img-proc" src="' . $arrSP[2]['HinhURL'] . '" width="100%">
                                    <div class="productname">' . $arrSP[2]['TenHienThi'] . '</div>
                                    <h4 class="price">' . $arrSP[2]['Gia'] . '</h4></div>
                                </a>
                            </div>
                            <div class="recommend-product-item">
                                <a href="details.php?id=' . $arrSP[3]['MaSanPham'] . '">
                                    <div class="thumbnail effect">
                                    <img class="img-proc" src="' . $arrSP[3]['HinhURL'] . '" width="100%">
                                    <div class="productname">' . $arrSP[3]['TenHienThi'] . '</div>
                                    <h4 class="price">' . $arrSP[3]['Gia'] . '</h4></div>
                                </a>
                            </div>
                            <div class="recommend-product-item">
                                <a href="details.php?id=' . $arrSP[4]['MaSanPham'] . '">
                                    <div class="thumbnail effect">
                                    <img class="img-proc" src="' . $arrSP[4]['HinhURL'] . '" width="100%">
                                    <div class="productname">' . $arrSP[4]['TenHienThi'] . '</div>
                                    <h4 class="price">' . $arrSP[4]['Gia'] . '</h4></div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>');
        }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./header.php"); ?>
    <title>Thông Tin Sản Phẩm</title>
</head>
<body>
    <!-- thanh menu -->
    <?php include_once("./menu.php"); ?>

    <!-- thông tin sản phẩm -->
    
    <?php GetDetailsProduct(); ?>
    
    <!--  hết phần thông tin chi tiết -->   

    <?php include_once("./footer.php"); ?>
</body>
</html>