<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if(isset($_SESSION['username']))
    header('location: index.php');
else {
    include_once("./database.php"); 

    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $error = 'Tên đăng nhập hoặc mật khẩu không đúng ! <br />';
        // xoá bỏ các tag html, kí tự đặc biệt nhằm tránh sql injection
        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        $query = "SELECT TenDangNhap, MatKhau, LoaiTaiKhoan from taikhoan WHERE TenDangNhap = '$username' AND MatKhau = '$password' ";
        $res = DataProvider::ExecuteQuery($query);
        if(mysqli_num_rows($res) == 0)
        {
            $_SESSION['error'] = $error;
            header('location: login.php');
            exit();

        } else {
            $_SESSION['username'] = $username;
            unset($_SESSION['error']);
            $data = mysqli_fetch_assoc($res);
            $_SESSION['LoaiTaiKhoan'] = $data['LoaiTaiKhoan'];
            if($_SESSION['LoaiTaiKhoan'] == admin)
            {
                header('location:admin.php');
                exit();
            }
            else {
                echo "Đăng nhập thành công";
                header('location:index.php');
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("./header.php"); ?>
    <title>Đăng Nhập</title>
</head>
<body>
    <!-- thanh menu -->
    <?php include_once("./menu.php"); ?>
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
                        <div>
                            <?php   
                                if (!empty($_SESSION['error']))
                                    echo $_SESSION['error'];
                            ?>
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

<?php } ?>