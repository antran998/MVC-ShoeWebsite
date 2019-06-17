<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SneakBoys</title>
    
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="lib/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="lib/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="lib/css/owl.carousel.css">
    <link rel="stylesheet" href="lib/css/style.css">
    <link rel="stylesheet" href="lib/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="addCart(); creatStarHover(); 
    <?php         
        if(isset($_SESSION['username'])){
            echo "loadCmtButt(); ";           
            echo "showChatBox('".$_SESSION['username']."',".$_SESSION['chat']."); ";
        }
        else{
            echo "showChatBox('Guest',1); ";
        }
    ?>
  ">

    <div class="header-area">
        <div class="container align-user">            
            <ul class="list-unstyled list-inline">
                <?php
                if(!isset($_SESSION['username'])){
                    echo 
                    '<li><a href="addUser"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                    <li><a onclick="signUpClick();"><i class="fa fa-pencil"></i> Đăng ký</a></li>';              
                }
                else{
                    echo 
                    '<li><a href="home"><i class="fa fa-home"></i> Trang chủ</a></li>
                    ';
                    if(strpos($_SESSION['id'], 'AD') !== false){
                        echo
                        '<li><a href="CRUDAccount"><i class="fa fa-user"></i> Thành viên</a></li>
                        <li><a href="CRUDItem"><i class="fa fa-archive"></i> Kho hàng</a></li>
                        <li><a target="_blank" href="https://app.subiz.com/activities/usqjeywtdruzvhfgvnjpt/convo/csqjeywujpojwcdifh"><i class="fa fa-comments"></i> Tin nhắn</a></li>
                        ';
                    }                         
                    echo 
                    '<li><a href="accountInfo" target="_blank"><i class="fa fa-info-circle"></i> '.$_SESSION['username'].'</a></li>
                    <li><form action="" class="form-signup" method="POST">
                        <button type="submit" name="logout" id="logout">LogOut</button>
                    </form></li>';
                }
                ?>
            </ul>                    
        </div>
    </div> <!-- End header area -->

    <div class="shopping-item stick-icon" id="cart_status" ondrop="drop(event)" ondragover="allowDrop(event)">
        <a href="cart"><span class="textArea">Giỏ Hàng -</span><span class="cart-amunt" id="cart_price">0đ</span> <i class="fa fa-shopping-cart"></i> <span class="product-count" id="count_pro">0</span></a>
    </div>

    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="home"><img src="lib/img/logo.png"></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">                    
                    <div class="search-area">
                        <form action="shop">
                            <input type="text" placeholder="Nhập Tên Sản Phẩm" class="search-bar" id="search-bar">
                            <button type="submit" id="search-button"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="home">Trang chủ</a></li>
                        <li><a href="shop">Mặt Hàng</a></li>
                        <li class="active"><a href="single-product">Thông Tin Mặt Hàng</a></li>
                        <li><a href="cart">Giỏ Hàng</a></li>
                        <li><a href="checkout">Thanh Toán</a></li>
                        <?php
                            if(strpos($_SESSION['id'], 'A') !== false){  
                                echo '<li><a href="contact" target="_blank">Liên Hệ</a></li>';
                            }
                        ?>
                    </ul>
                </div>   
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Single Product</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">                    
                    
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Sản phẩm mới nhất</h2>

                        <?php  

                            $sizeItem = $GLOBALS['db']->getMaxID('ID_ITEM','items');
                            $tempCount=1;
                            $i=$sizeItem;
                            while($tempCount!=4){
                                $idProduct = $GLOBALS['db']->GetSpecificRow($i,'ID_ITEM','items','ID_ITEM');
                                if($idProduct===NULL){
                                    $i--;
                                    continue;
                                }
                                $nameProduct = $GLOBALS['db']->GetSpecificRow($i,'NAME','items','ID_ITEM');
                                $price = numberWithDots($GLOBALS['db']->GetSpecificRow($i,'PRICE','items','ID_ITEM'));
                                $discountPrice = numberWithDots($GLOBALS['db']->GetSpecificRow($i,'DISCOUNT_PRICE','items','ID_ITEM'));
                                $imgItem = $GLOBALS['db']->GetSpecificRow($i,'IMG_ITEM','items','ID_ITEM');

                                echo "
                                    <div class='thubmnail-recent'>
                                        <img src='lib/".$imgItem."' class='recent-thumb' alt=''>
                                        <h2><a href='single-product?id=".$idProduct."'>".$nameProduct."</a></h2>
                                        <div class='product-sidebar-price'>
                                            <ins>".$discountPrice."đ</ins> <del>".$price."đ</del>
                                        </div>                             
                                    </div>
                                ";
                                $tempCount++;
                                $i--;
                            }

                        ?>                        
                    </div>
                </div>
                
                <div class="col-md-8">
                    <?php

                        if(!isset($_GET['id'])){
                            $i = 1;
                        }
                        else{
                            $i = $_GET['id'];
                        }
                        $idProduct = $GLOBALS['db']->GetSpecificRow($i,'ID_ITEM','items','ID_ITEM');
                        $nameProduct = $GLOBALS['db']->GetSpecificRow($i,'NAME','items','ID_ITEM');
                        $price = numberWithDots($GLOBALS['db']->GetSpecificRow($i,'PRICE','items','ID_ITEM'));
                        $discountPrice = numberWithDots($GLOBALS['db']->GetSpecificRow($i,'DISCOUNT_PRICE','items','ID_ITEM'));
                        $imgItem = $GLOBALS['db']->GetSpecificRow($i,'IMG_ITEM','items','ID_ITEM');  
                        
                    
                        echo "
                        <div class='row temp' id='pro-".$idProduct."'>
                            <div class='col-sm-6' id='img'>
                                <div class='product-images'>
                                    <div class='product-main-img'>
                                        <img src='lib/".$imgItem."' alt='' id='img_pro'>
                                    </div>
                                </div>
                                <hr>
                                <div class='comment-box'>";

                                $commentContainer = array();
                                $GLOBALS['db']->GetComment($idProduct,$commentContainer);
                                if(sizeof($commentContainer)<1){
                                    echo "<p class='no-comment'>🤔 Hãy là người đầu tiên đánh giá ... 🤔</p>";
                                }
                                for($i = 0;$i<sizeof($commentContainer);$i++){
                                    $usernameComment = $GLOBALS['db']->GetSpecificRow("'".$commentContainer[$i]['id']."'",'FULL_NAME','account_info','ID');
                                    echo "<div class='single-comment'>
                                    <h5 class='text-header'>";

                                    echo $usernameComment;
                                    for($j=1;$j<=$commentContainer[$i]['star'];$j++){
                                        echo " <i class='fa fa-star rating-wrap-post checked'></i>";   
                                    }
                                    
                                    echo "</h5>

                                    <span class='text-field'>".$commentContainer[$i]['content']."</span>

                                    <h5 class='text-bottom'>".$commentContainer[$i]['datePost']."</h5>
                                    </div>";
                                }
                                echo "</div>
                            </div>
                            
                            <div class='col-sm-6' id='content'>
                                <div class='product-inner'>
                                    <h2 class='product-name' id='productName'>".$nameProduct."</h2>
                                    <div class='product-inner-price'>
                                        <ins id='price1'>".$discountPrice."đ</ins> <del>".$price."đ</del>
                                    </div>    
                                    
                                    <div  class='cart'>                
                                        <button class='add_to_cart_button' data-product_id='".$idProduct."'>Thêm Vào Giỏ</button>
                                    </div>   
                                    
                                    <div class='product-inner-category'>
                                    </div> 
                                    
                                    <div role='tabpanel'>
                                        <ul class='product-tab' role='tablist'>
                                            <li role='presentation' class='active'><a href='#home' aria-controls='home' role='tab' data-toggle='tab'>Mô tả</a></li>
                                            <li role='presentation'><a href='#profile' aria-controls='profile' role='tab' data-toggle='tab'>Đánh giá</a></li>
                                        </ul>
                                        <div class='tab-content'>
                                            <div role='tabpanel' class='tab-pane fade in active' id='home'>
                                                <h2>Mô tả sản phẩm</h2>
                                                <p>- Size: 39 - 43<br>- Sản phẩm chính hãng<br>- Chất lượng cao<br>- Vải mềm, êm và đẹp<br>- Bảo hành 3 tháng<br>- Phù hợp với mọi quãng đường
                                                </p>  
                                            </div>
                                            <div role='tabpanel' class='tab-pane fade' id='profile'>";
                                                if(strpos($_SESSION['id'], 'A') !== false){
                                                echo "<div class='submit-review'>
                                                    
                                                    <p><label for='review'>Đánh giá của bạn: ";
                                                    for($k=1;$k<6;$k++){
                                                        echo "<i class='fa fa-star star$k rating-wrap-post' onclick='rateStar($k)'></i>";
                                                    }
                                                    echo "</label>
                                                        <textarea name='review' id='yourComment' cols='30' rows='10'></textarea></p>
                                                    <p><input type='submit' value='Gửi' id='cmtButton'></p>
                                                </div>";
                                                }
                                                else{
                                                    echo '<form action="addUser">
                                                    <input type="submit" value="Đăng nhập">
                                                    </form>
                                                    ';
                                                }
                                                echo "</div>
                                        </div>
                                    </div>            
                                </div>
                            </div>
                        </div>
                        ";                    

                    ?>
                    
                </div> 
            </div>
            <hr>
        </div>
    </div><!--End Display Item Area-->
                

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sản Phẩm Liên Quan</h2>
                        <div class="product-carousel">

                            <?php
                                $sizeItem = $GLOBALS['db']->getMaxID('ID_ITEM','items');

                                $tempCount=1;
                                $i=$sizeItem;
                                while($tempCount!=7){
                                    $idProduct = $GLOBALS['db']->GetSpecificRow($i,'ID_ITEM','items','ID_ITEM');

                                    // continue loop when item not exist
                                    if($idProduct===NULL){
                                        $i--;
                                        continue;
                                    }

                                    $nameProduct = $GLOBALS['db']->GetSpecificRow($i,'NAME','items','ID_ITEM');
                                    $price = numberWithDots($GLOBALS['db']->GetSpecificRow($i,'PRICE','items','ID_ITEM'));
                                $discountPrice = numberWithDots($GLOBALS['db']->GetSpecificRow($i,'DISCOUNT_PRICE','items','ID_ITEM'));
                                    $imgItem = $GLOBALS['db']->GetSpecificRow($i,'IMG_ITEM','items','ID_ITEM');

                                    echo "
                                    <div class='single-product' id='pro-".$idProduct."'>
                                        <div class='product-f-image'>
                                            <img src='lib/".$imgItem."' alt='' id='img_pro'>
                                            <div class='product-hover'>
                                                <a class='add-to-cart-link' data-product_id='".$idProduct."'><i class='fa fa-shopping-cart'></i> Giỏ</a>
                                                <a href='single-product?id=".$idProduct."' class='view-details-link'><i class='fa fa-link'></i> Xem Hàng</a>
                                            </div>
                                        </div>
                                        
                                        <h2><a href='single-product?id=".$idProduct."' id='productName'>".$nameProduct." </a></h2>
                                        
                                        <div class='product-carousel-price'>
                                            <ins id='price1'>".$discountPrice."đ</ins> <del>".$price."đ</del>
                                        </div> 
                                    </div>
                                    ";
                                    $tempCount++;
                                    $i--;
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->


    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2><span>Sneak</span>Boys</h2>
                        <p>Cửa Hàng CHUYÊN cung cấp các mặt hàng đẹp của nhãn hàng ADIDAS NIKE VANS NEWBALANCE và Cửa hàng nói không với hàng FAKE</p>  
                        <div class="footer-social">
                            <a href="https://www.facebook.com/tienttt?sk=wall&fref=gs&dti=1943693119073870&hc_location=group_dialog" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.facebook.com/tienttt?sk=wall&fref=gs&dti=1943693119073870&hc_location=group_dialog" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.facebook.com/tienttt?sk=wall&fref=gs&dti=1943693119073870&hc_location=group_dialog" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="https://www.facebook.com/tienttt?sk=wall&fref=gs&dti=1943693119073870&hc_location=group_dialog" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Điều Hướng </h2>
                        <ul>
                            <li><a href="cart">Giỏ hàng</a></li>
                            <li><a href="contact" target="_blank">Liên hệ</a></li>
                            <li><a href="shop">Tất cả mặt hàng</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Thể Loại</h2>
                        <ul>
                            <li><a href="shop" onclick="typeOfShoe('adidas')">Giày Adidas</a></li>
                            <li><a href="shop" onclick="typeOfShoe('nike')">Giày Nike</a></li>
                            <li><a href="shop" onclick="typeOfShoe('vans')">Giày Vans</a></li>
                            <li><a href="shop" onclick="typeOfShoe('newbalance')">Giày NewBalance</a></li>
                        </ul>                        
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Khuyến khích</h2>
                        <p>Đăng nhập giúp đánh giá sản phẩm của SneakBoys, giúp SneakBoys phát triển và nhận những ưu đãi bất ngờ từ SneakBoys</p>
                        <div class="newsletter-form">
                            <form action="addUser">
                                <input type="submit" value="Đăng nhập">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                       <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com" target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="lib/js/owl.carousel.min.js"></script>
    <script src="lib/js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="lib/js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="lib/js/main.js"></script>

    <script src="lib/js/cart.js"></script>
    <script type="text/javascript" src="lib/js/drag-drop.js"></script>
    
    <script type="text/javascript" src="lib/js/single.js"></script>   
    <script type="text/javascript" src="lib/js/search-bar.js"></script>
    <script type="text/javascript" src="lib/js/show.js"></script>
    <script type="text/javascript" src="lib/js/chatbox.js"></script>
    <script type="text/javascript" src="lib/js/logout.js"></script>
  </body>
</html>