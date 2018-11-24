<?php 
    class DataProvider
    {
        public static function ExecuteQuery($query){
            $connecionString = mysqli_connect("localhost", "root", "", "1660214_1660359_1660656_quanlysanpham") or die("Cannot connect Database");
            mysqli_set_charset($connecionString, "utf8");
            $res = mysqli_query($connecionString, $query);
            mysqli_close($connecionString);
            return $res;
        }
    }
?>