<?php 
include_once("./database.php");

function GetDetailsProduct()
{
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $maSanPham = $_GET['id'];

        $query = "SELECT * FROM sanpham WHERE MaSanPham = $maSanPham";
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


        if ($maLoai == 1) {
            $query = "SELECT * FROM thongsokythuat WHERE MaSanPham = $maSanPham";
            $resTTKT = DataProvider::ExecuteQuery($query);
            while ($row = mysqli_fetch_array($resTTKT)) {
                $manHinh = $row['ManHinh'];
                $heDieuHanh = $row['HeDieuHanh'];
                $cameraSau = $row['CameraSau'];
                $cameraTruoc = $row['CameraTruoc'];
                $CPU = $row['CPU'];
                $RAM = $row['Ram'];
                $boNhoTrong = $row['BoNhoTrong'];
                $theSim = $row['TheSim'];
                $dungLuongPin = $row['DungLuongPin'];
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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="panel-group" id="accordion" role="tablist">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h2 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Thông Số Kỹ Thuật</a>
                                </h2>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <ul class="parameter">
                                        <li class="g6459_79_77"><span>Màn hình:</span>' . $manHinh . '</li>
                                        <li class="g72"><span>Hệ điều hành:</span>' . $heDieuHanh . '</li>
                                        <li class="g27"><span>Camera sau:</span>' . $cameraSau . '</li>
                                        <li class="g29"><span>Camera trước:</span>' . $cameraTruoc . '</li>
                                        <li class="g6059"><span>CPU:</span>' . $CPU . '</li>
                                        <li class="g50"><span>RAM:</span>' . $RAM . '</li>
                                        <li class="g49"><span>Bộ nhớ trong:</span>' . $boNhoTrong . '</li>
                                        <li class="g6339_6463"><span>Thẻ SIM:</span>' . $theSim . '</li>
                                        <li class="g84_10882"><span>Dung lượng pin:</span>' . $dungLuongPin . '</li>
                                    </ul>
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
        } elseif ($maLoai == 4) {
            $query = "SELECT * FROM tsktdongho WHERE MaSanPham = $maSanPham";
            $resTTKT = DataProvider::ExecuteQuery($query);
            while ($row = mysqli_fetch_array($resTTKT)) {
                $congNgheManHinh = $row['CongNgheManHinh'];
                $kichThuocManHinh = $row['KichThuocManHinh'];
                $thoiGianSuDung = $row['ThoiGianSuDung'];
                $heDieuHanh = $row['HeDieuHanh'];
                $chongNuoc = $row['ChongNuoc'];
                $chatLieuMat = $row['ChatLieuMat'];
                $duongKinhMat = $row['DuongKinhMat'];
                $ketNoi = $row['KetNoi'];
                $ngonNgu = $row['NgonNgu'];
                $tienIch = $row['TienIch'];
            }

            echo ('
                <div class="container">
                <div class="card">
                        <div class="wrapper row">
                            <div class="preview col-md-6">
                                <div class="preview-pic tab-content">
                                    <div class="tab-pane active" id="pic-1"><img src="' . $arr[0] . '" /></div>
                                    <div class="tab-pane" id="pic-2"><img src="' . $arr[1] . '" /></div>
                                    <div class="tab-pane" id="pic-3"><img src="' . $arr[2] . '" /></div>
                                </div>
                                <ul class="preview-thumbnail nav nav-tabs">
                                    <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="' . $arr[0] . '" /></a></li>
                                    <li><a data-target="#pic-2" data-toggle="tab"><img src="' . $arr[1] . '" /></a></li>
                                    <li><a data-target="#pic-3" data-toggle="tab"><img src="' . $arr[2] . '" /></a></li>
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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="panel-group" id="accordion" role="tablist">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h2 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Thông Số Kỹ Thuật</a>
                                </h2>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <ul class="parameter">
                                        <li class="g6459_79_77"><span>Công nghệ màn hình:</span>' . $congNgheManHinh . '</li>
                                        <li class="g72"><span>Kích thước màn hình:</span>' . $kichThuocManHinh . '</li>
                                        <li class="g27"><span>Thời gian sử dụng:</span>' . $thoiGianSuDung . '</li>
                                        <li class="g29"><span>Hệ điều hành:</span>' . $heDieuHanh . '</li>
                                        <li class="g6059"><span>Chống nước:</span>' . $chongNuoc . '</li>
                                        <li class="g50"><span>Chất liệu mặt:</span>' . $chatLieuMat . '</li>
                                        <li class="g49"><span>Đường kính mặt:</span>' . $duongKinhMat . '</li>
                                        <li class="g6339_6463"><span>Kết nối:</span>' . $ketNoi . '</li>
                                        <li class="g84_10882"><span>Ngôn ngữ:</span>' . $ngonNgu . '</li>
                                        <li class="g6339_6463"><span>Tiện ích:</span>' . $tienIch . '</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>');
        } elseif ($maLoai == 3) {
            $query = "SELECT * FROM tskttablet WHERE MaSanPham = $maSanPham";
            $resTTKT = DataProvider::ExecuteQuery($query);
            while ($row = mysqli_fetch_array($resTTKT)) {
                $manHinh = $row['ManHinh'];
                $heDieuHanh = $row['HeDieuHanh'];
                $CPU = $row['CPU'];
                $RAM = $row['RAM'];
                $cameraSau = $row['CameraSau'];
                $cameraTruoc = $row['CameraTruoc'];
                $ketNoiMang = $row['KetNoiMang'];
                $hoTroSim = $row['HoTroSim'];
                $boNhoTrong = $row['BoNhoTrong'];
                $damThoai = $row['DamThoai'];
            }

            echo ('
                <div class="container">
                <div class="card">
                        <div class="wrapper row">
                            <div class="preview col-md-6">
                                <div class="preview-pic tab-content">
                                    <div class="tab-pane active" id="pic-1"><img src="' . $arr[0] . '" /></div>
                                    <div class="tab-pane" id="pic-2"><img src="' . $arr[1] . '" /></div>
                                    <div class="tab-pane" id="pic-3"><img src="' . $arr[2] . '" /></div>
                                    <div class="tab-pane" id="pic-4"><img src="' . $arr[3] . '" /></div>
                                </div>
                                <ul class="preview-thumbnail nav nav-tabs">
                                    <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="' . $arr[0] . '" /></a></li>
                                    <li><a data-target="#pic-2" data-toggle="tab"><img src="' . $arr[1] . '" /></a></li>
                                    <li><a data-target="#pic-3" data-toggle="tab"><img src="' . $arr[2] . '" /></a></li>
                                    <li><a data-target="#pic-4" data-toggle="tab"><img src="' . $arr[3] . '" /></a></li>
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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="panel-group" id="accordion" role="tablist">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h2 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Thông Số Kỹ Thuật</a>
                                </h2>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel">
                                <div class="panel-body">
                                    <ul class="parameter">
                                        <li class="g6459_79_77"><span>Màn hình:</span>' . $manHinh . '</li>
                                        <li class="g72"><span>Hệ điều hành:</span>' . $heDieuHanh . '</li>
                                        <li class="g27"><span>CPU:</span>' . $CPU . '</li>
                                        <li class="g29"><span>RAM:</span>' . $RAM . '</li>
                                        <li class="g6059"><span>Bộ nhớ trong:</span>' . $boNhoTrong . '</li>
                                        <li class="g50"><span>Camera sau:</span>' . $cameraSau . '</li>
                                        <li class="g49"><span>Camera trước:</span>' . $cameraTruoc . '</li>
                                        <li class="g6339_6463"><span>Kết nối mạng:</span>' . $ketNoiMang . '</li>
                                        <li class="g84_10882"><span>Hỗ trợ SIM:</span>' . $hoTroSim . '</li>
                                        <li class="g6339_6463"><span>Đàm thoại:</span>' . $damThoai . '</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>');
        }
    }
}
?>


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