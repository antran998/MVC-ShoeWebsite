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
    <link href="lib/css/bootstrap.min.css" type='text/css' rel='stylesheet'>
    
    <!-- Font Awesome -->
    <link href="lib/css/font-awesome.min.css" type='text/css' rel='stylesheet'>

    <!-- Custom CSS -->
    <link href="lib/css/owl.carousel.css" type='text/css' rel='stylesheet'>
    <link href="lib/css/style.css" type='text/css' rel='stylesheet'>
    <link href="lib/css/responsive.css" type='text/css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="lib/css/lucky.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body onload="addCart(); 
    <?php    
        if(isset($_SESSION['username'])){
            if(isset($_SESSION['chat'])){       
                echo "showChatBox('".$_SESSION['username']."',".$_SESSION['chat']."); ";
            }
            else{
                echo "showChatBox('".$_SESSION['username']."',0); ";  
            }
            $_SESSION['chat'] = 1;           
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
    
    <?php  
    if(isset($_SESSION['username'])){
        // firstime spin
        $firstSpin=$GLOBALS['db']->LuckyCircleCondition($_SESSION['id']);
        if($firstSpin==0){
            echo '<div class="lucky-wheel stick-icon" id="blurBack">
            </div>
            <div class="stick-icon adver" id="adver">
                <div class="close" id="xclose" onclick="CloseAd()">X</div>
                <div class="code" id="codeVoucher">';echo $_SESSION['voucher'];echo '</div>
            </div> <!--adver-->
            <div class="stick-icon">
                <img src="lib/img/border-good.png" id="myStop" class="border" onclick="spinCircle();">
                <img src="lib/img/wheel-good.png" id="myDiv">
            </div>';
        }
    }

    ?>

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
                        <li class="active"><a href="home">Trang chủ</a></li>
                        <li><a href="shop">Mặt Hàng</a></li>
                        <li><a href="single-product">Thông Tin Mặt Hàng</a></li>
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
    
    <div class="slider-area">
        	<!-- Slider -->
			<div class="block-slider block-slider4">
				<ul class="" id="bxslider-home4">                    
                    
					<li>
                        <img src="lib/img/slide1.png" alt="slide">            
						<div class="caption-group">
							<h2 class="caption title">
								NewBalance <span class="primary">TN <strong>MCL</strong></span>
							</h2>
							<h4 class="caption subtitle">Size 41.5-44</h4>
							<a class="caption button-radius" href="shop"><span class="icon"></span>Shop now</a>
						</div>
					</li>
					<li>
                        <img src="lib/img/slide3.png" alt="slide">
						<div class="caption-group">
							<h2 class="caption title">
								VANS <span class="primary">M011 <strong><strong></span>
							</h2>
							<h4 class="caption subtitle">Size 41 - 43</h4>
							<a class="caption button-radius" href="shop"><span class="icon"></span>Shop now</a>
						</div>
					</li>
					<li><img src="lib/img/slide2.png" alt="slide">
						<div class="caption-group">
							<h2 class="caption title">
								Nike Free <span class="primary">AQ <strong>003</strong></span>
							</h2>
							<h4 class="caption subtitle">Size 41 - 44</h4> 
							<a class="caption button-radius" href="shop"><span class="icon"></span>Shop now</a>
                        </div>
                    </li>                    
				</ul>
			</div>
    </div> 
    
    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>Đổi Trả 30 Ngày</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Giao Hàng Miễn Phí</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Thanh Toán An Toàn</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>Nhiều Sản Phẩm Mới</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->
    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Sản Phẩm Mới</h2>
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
    
    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="lib/img/bran1.png" alt="">
                            <img src="lib/img/bran2.png" alt="">
                            <img src="lib/img/bran3.png" alt="">
                            <img src="lib/img/bran4.png" alt="">                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->
    
    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Bán Chạy Nhất</h2>

                        <?php  

                            $quantityContainer = Array();

                            $GLOBALS['db']->SumQuantity('QUANTITY','ID_ITEM','buying_history','ID_ITEM',3,$quantityContainer);

                            for($i = 0 ;$i< 3;$i++){
                                
                                $idProduct = $GLOBALS['db']->GetSpecificRow($quantityContainer[$i],'ID_ITEM','items','ID_ITEM');

                                // continue loop when item not exist
                                if($idProduct===NULL){
                                    continue;
                                }

                                $nameProduct = $GLOBALS['db']->GetSpecificRow($quantityContainer[$i],'NAME','items','ID_ITEM');
                                $price = numberWithDots($GLOBALS['db']->GetSpecificRow($quantityContainer[$i],'PRICE','items','ID_ITEM'));
                                $discountPrice = numberWithDots($GLOBALS['db']->GetSpecificRow($quantityContainer[$i],'DISCOUNT_PRICE','items','ID_ITEM'));
                                $imgItem = $GLOBALS['db']->GetSpecificRow($quantityContainer[$i],'IMG_ITEM','items','ID_ITEM');

                                echo "

                                <div class='single-wid-product'>
                                    <a href='single-product?id=".$idProduct."'><img src='lib/".$imgItem."' alt='' class='product-thumb'></a>
                                    <h2><a href='single-product?id=".$idProduct."'>".$nameProduct."</a></h2>
                                    <div class='product-wid-rating'>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                    </div>
                                    <div class='product-wid-price'>
                                        <ins>".$discountPrice."đ</ins> <del>".$price."đ</del>
                                    </div>                            
                                </div>

                                ";
                            }


                        ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Giá tốt nhất</h2>
                        <?php  
                            $sizeItem = $GLOBALS['db']->getSize('ID_ITEM','items');

                            $valueContainer = Array();

                            $GLOBALS['db']->getMultiItemInRank(3,'items','DISCOUNT_PRICE','ASC',$valueContainer,'ID_ITEM');

                            for($i = 0 ;$i< 3;$i++){
                                
                                $idProduct = $GLOBALS['db']->GetSpecificRow($valueContainer[$i],'ID_ITEM','items','ID_ITEM');

                                // continue loop when item not exist
                                if($idProduct==''){
                                    continue;
                                }

                                $nameProduct = $GLOBALS['db']->GetSpecificRow($valueContainer[$i],'NAME','items','ID_ITEM');
                                $price = numberWithDots($GLOBALS['db']->GetSpecificRow($valueContainer[$i],'PRICE','items','ID_ITEM'));
                                $discountPrice = numberWithDots($GLOBALS['db']->GetSpecificRow($valueContainer[$i],'DISCOUNT_PRICE','items','ID_ITEM'));
                                $imgItem = $GLOBALS['db']->GetSpecificRow($valueContainer[$i],'IMG_ITEM','items','ID_ITEM');

                                echo "
                                <div class='single-wid-product'>
                                    <a href='single-product?id=".$idProduct."'><img src='lib/".$imgItem."' alt='' class='product-thumb'></a>
                                    <h2><a href='single-product?id=".$idProduct."'>".$nameProduct."</a></h2>
                                    <div class='product-wid-rating'>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                    </div>
                                    <div class='product-wid-price'>
                                        <ins>".$discountPrice."đ</ins> <del>".$price."đ</del>
                                    </div>                            
                                </div>
                                ";

                            }
                        ?>                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Mới Nhất</h2>
                        <?php  
                            $sizeItem = $GLOBALS['db']->getMaxID('ID_ITEM','items');
                            $tempCount=1;
                            $i=$sizeItem;
                            while($tempCount!=4){
                            
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
                                    <div class='single-wid-product'>
                                        <a href='single-product?id=".$idProduct."'><img src='lib/".$imgItem."' alt='' class='product-thumb'></a>
                                        <h2><a href='single-product?id=".$idProduct."'>".$nameProduct."</a></h2>
                                        <div class='product-wid-rating'>
                                            <i class='fa fa-star'></i>
                                            <i class='fa fa-star'></i>
                                            <i class='fa fa-star'></i>
                                            <i class='fa fa-star'></i>
                                            <i class='fa fa-star'></i>
                                        </div>
                                        <div class='product-wid-price'>
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
            </div>
        </div>
    </div> <!-- End product widget area -->
    
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
                            <li><a href="contact">Liên hệ</a></li>
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
    </div> <!-- End footer top area -->
    
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
    </div> <!-- End footer bottom area -->
   
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
    
    <!-- Slider -->
    <script type="text/javascript" src="lib/js/bxslider.min.js"></script>
	<script type="text/javascript" src="lib/js/script.slider.js"></script>
    
    <script type="text/javascript" src="lib/js/lucky.js"></script>
    <script type="text/javascript" src="lib/js/cart.js"></script>
    <script type="text/javascript" src="lib/js/drag-drop.js"></script>
    <script type="text/javascript" src="lib/js/search-bar.js"></script>
    <script type="text/javascript" src="lib/js/show.js"></script>
    <script type="text/javascript" src="lib/js/chatbox.js"></script>
    <script type="text/javascript" src="lib/js/logout.js"></script>

  </body>
</html>