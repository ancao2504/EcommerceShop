<?php 

    include_once("./database.php");

    // lấy thông tin username
    $username = isset($_POST['usernameInput']) ? $_POST['usernameInput'] : false;

    // nếu thông tin username rỗng thì dừng và báo lỗi
    if (!$username)
        die ('{error:"Bad_request"}');

    // khai báo biến lưu lỗi
    $error = array(
        'error' => 'success',
        'username' => ''
    );

    // kiểm tra username
    if($username)
    {
        $query = "SELECT COUNT(*) as count from taikhoan where TenDangNhap = $username";
        $res = DataProvider::ExecuteQuery($query);
        $row = mysqli_fetch_array($res);
        if((int)$row['count'] > 0)
            $error['username'] = 'Tên đăng nhập đã tồn tại';
    }

    // lưu vào csdl
    if (!error['username'])
    {
        $query = "insert into taikhoan(TenDangNhap) value ('$username')";
        DataProvider::ExecuteQuery(query);
    }

    die (json_encode($error));
?>