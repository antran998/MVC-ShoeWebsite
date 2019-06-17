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
  <body onload="addCart(); 
    <?php         
        if(isset($_SESSION['username'])){           
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
                        <li class="active"><a href="shop">Mặt Hàng</a></li>
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
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row" id="listItems">
               <!-- draw item here -->
               <?php
                    // $sizeItem = $GLOBALS['db']->getSize('ID_ITEM','items');
                    // for($i = $sizeItem ;$i> 0;$i--){

                    $sizeItem = $GLOBALS['db']->getMaxID('ID_ITEM','items');
                    $i=$sizeItem;
                    while($i!=0){
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
                            <div class='col-md-3 col-sm-6'>
                            <div class='single-shop-product' id='pro-".$idProduct."'>

                            <div class='product-upper' id='test'>
                            <img src='lib/".$imgItem."' alt='' id='img_pro' draggable='true' ondragstart='drag(event)'>
                            </div>
                            <h2 id='productName'><a href='single-product?id=".$idProduct."'>".$nameProduct."</a></h2>
                            <div class='product-carousel-price'>
                            <ins id='price1'>".$discountPrice."đ</ins> <del>".$price."đ</del>
                            </div>  

                            <div class='product-option-shop'>
                            <a class='add_to_cart_button' id='add_cart' data-quantity='1' data-product_sku='' data-product_id='".$idProduct."' rel='nofollow'>Thêm vào giỏ</a>
                            </div>                       
                            </div>
                            </div> 
                        ";
                        $i--;
                    }


               ?>
            </div>           
        </div>
    </div>


    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
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
                        <h2 class="footer-wid-title">Điều Hướng</h2>
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

    <script type="text/javascript" src="lib/js/cart.js"></script>
    <script type="text/javascript" src="lib/js/drag-drop.js"></script>    
    
    <script type="text/javascript" src="lib/js/search-bar.js"></script>
    <script type="text/javascript" src="lib/js/show.js"></script>
    <script type="text/javascript" src="lib/js/chatbox.js"></script>
    <script type="text/javascript" src="lib/js/logout.js"></script>
  </body>
</html>