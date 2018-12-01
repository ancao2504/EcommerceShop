<?php

echo ('<div class="container-fluid header">
        <div class="container">
            <div class="row"> 
                <div class="col-xs-12 col-sm-12 col-md-12 menu">
                    <ul>
                        <li><a href="index.php"><img src="img/logo_2.png" alt="" width="50px;"></a></li>
                        <li><a href="category.php?cat=1">ĐIỆN THOẠI</a></li>
                        <li><a href="category.php?cat=3">TABLET</a></li>
                        <li><a href="category.php?cat=2">LAPTOP</a></li>
                        <li><a href="category.php?cat=4">ĐỒNG HỒ</a></li>
                        <li><a href="category.php?cat=5">TV</a></li>
                        <li><a href="#">NHÀ SX</a></li>
                        <li><a href="cart.php"><i class="fa fa-shopping-cart"></i></a></li>
                        <li class="dropdown">
                            <a href="login.php"><i class="fa fa-user-o"></i></a>
                        </li>
                        <li>
                            <form action="search.php" method="GET">
                                <input class="input-search" type="text" name="q" placeholder="Bạn tìm gì . . . ?">
                                <button type="submit" class=" btn-search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </li>
                       
                    </ul>
                </div>
            </div>
            </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-top"></div>
            </div>
        </div>
    </div>
    <a href="#" class="gotopBtn"> <i class="fas fa-arrow-up"></i> </a>');
?>