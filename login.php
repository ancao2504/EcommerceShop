<?php
session_start();
include_once("./database.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./header.php"); ?>
    <title>Đăng Nhập</title>
</head>
<body>
    <?php
        if(isset($_POST["btnSubmit"]))
        {
            $username = $_POST["username"];
            $password = $_POST["password"];

            // xoá bỏ các tag html, kí tự đặc biệt nhằm tránh sql injection
            $username = strip_tags($username);
            $username = addslashes($username);
            $password = strip_tags($password);
            $password = addslashes($password);

            $query = "SELECT TenDangNhap, MatKhau from taikhoan WHERE TenDangNhap = '$username' AND MatKhau = '$password' ";
            $res = DataProvider::ExecuteQuery($query);
            if($res == 0)
            {
                echo "Tên đăng nhập hoặc mật khẩu không đúng !";
            } else 
            {
                // lưu tên đăng nhập vào sesion
                $_SESSION['username'] = $username;
                echo "Đăng nhập thành công";
                header('Location:index.php');
            }
        }
    ?>

    <!-- thanh menu -->
    <?php include_once("./menu.php"); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-top"></div>
            </div>
        </div>
    </div>

    <!-- đăng nhập -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-5 sign_in">
                <h5>Đăng Nhập</h5>

                <form action="login.php" class="needs-validation" method="POST" novalidate>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Tên Đăng Nhập" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập tên đăng nhập.
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mật Khẩu" required>
                        <div class="invalid-feedback">
                            Vui lòng nhập mật khẩu.
                        </div>
                    </div>
                    <button type="submit" name="btnSubmit" class="btn btn-lg btn-dangnhap">Đăng Nhập</button>
                </form>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7">

            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
                <div class="row quenmatkhau">
                    <i class="fa fa-chevron-circle-right"><a href="#"> Quên tên đăng nhập hoặc mật khẩu?</a></i>
                    <i class="fa fa-chevron-circle-right"><a href="./signup.php"> Chưa có tài khoản? Đăng ký ngay bây giờ.</a></i>
                </div>
            </div>
        </div>
    </div>
    <!-- hết phần đăng nhập -->

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