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
    <link rel="stylesheet" type="text/css" href="lib/css/loader.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body onload="loadInfoCheckout(); addValidateButt(); 
    <?php         
        if(isset($_SESSION['username'])){           
            echo "showChatBox('".$_SESSION['username']."',".$_SESSION['chat']."); ";
        }
        else{
            echo "showChatBox('Guest',1); ";
        }
    ?>
   ">
   <!-- loader -->
    <div class="loader" id="theLoader"></div>

    <div id="hidden_container">
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
                            <button type="submit" name="logout" id="logout"><i>LogOut</button>
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
                            <li><a href="single-product">Thông Tin Mặt Hàng</a></li>
                            <li><a href="cart">Giỏ Hàng</a></li>
                            <li class="active"><a href="checkout">Thanh Toán</a></li>
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
                            <h2>Shopping Cart</h2>
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
                                while($tempCount!=9){
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
                        <div class="product-content-right">
                            <div class="woocommerce">
                                

                                <form id="login-form-wrap" class="login collapse" method="post">


                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>

                                    <p class="form-row form-row-first">
                                        <label for="username">Username or email <span class="required">*</span>
                                        </label>
                                        <input type="text" id="username" name="username" class="input-text">
                                    </p>
                                    <p class="form-row form-row-last">
                                        <label for="password">Password <span class="required">*</span>
                                        </label>
                                        <input type="password" id="password" name="password" class="input-text">
                                    </p>
                                    <div class="clear"></div>


                                    <p class="form-row">
                                        <input type="submit" value="Login" name="login" class="button">
                                        <label class="inline" for="rememberme"><input type="checkbox" value="forever" id="rememberme" name="rememberme"> Remember me </label>
                                    </p>
                                    <p class="lost_password">
                                        <a href="#">Quên mật khẩu?</a>
                                    </p>

                                    <div class="clear"></div>
                                </form>
                                
                                <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

                                    <p class="form-row form-row-first">
                                        <input type="text" value="" id="coupon_code" placeholder="Coupon code" class="input-text" name="coupon_code">
                                    </p>

                                    <p class="form-row form-row-last">
                                        <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                    </p>

                                    <div class="clear"></div>
                                </form>

                                <form enctype="multipart/form-data" action="" class="checkout" method="post" name="checkout">

                                    <div id="customer_details" class="col2-set">
                                        <div class="col-1">
                                            <div class="woocommerce-billing-fields">
                                                <h3>Thông tin khách hàng</h3>                                         
                                                
                                                <?php if(strpos($_SESSION['id'], 'A') !== false){ 
                                                    
                                                    $data=$GLOBALS['db']->ReturnListValueWithOption('account_info','','');
                                                    while($row=mysqli_fetch_assoc($data)){
                                                    if($row['ID']== $_SESSION['id']){

                                                echo '<p id="infoContainer0" class="form-row form-row-first validate-required">
                                                    <label class="" for="billing_first_name">Họ tên<abbr title="required" class="required">*</abbr>
                                                    <span class="inline-validate" id="check0"></span>
                                                    </label>
                                                    <input type="text" value="'.$row['FULL_NAME'].'" placeholder="" id="billing_first_name" name="billing_first_name"
                                                    class="input-text " oninput="validateForm(billing_first_name,check0,regexCheckout[0])">
                                                </p>
                                                
                                                <div class="clear"></div>                                         
                                                <p id="infoContainer1" class="form-row form-row-wide address-field validate-required">
                                                    <label class="" for="billing_address_1">Địa chỉ <abbr title="required" class="required">*</abbr>
                                                    <span class="inline-validate" id="check1"></span>
                                                    </label>
                                                    <input type="text" value="'.$row['ADDRESS'].'" id="billing_address_1" name="billing_address_1" id="billing_address_1" class="input-text" oninput="validateForm(billing_address_1,check1,regexCheckout[1])">
                                                </p>                                          
                                                
                                                <div class="clear"></div>

                                                <p id="infoContainer2" class="form-row form-row-first validate-required validate-email">
                                                    <label class="" for="billing_email">Email <abbr title="required" class="required">*</abbr>
                                                    <span class="inline-validate" id="check2"></span>
                                                    </label>
                                                    <input type="text" value="'.$row['EMAIL'].'" placeholder="" id="billing_email" name="billing_email" class="input-text inline-validate"  oninput="validateForm(billing_email,check2,regexCheckout[2])">

                                                </p>

                                                <p id="infoContainer3" class="form-row form-row-last validate-required validate-phone">
                                                    <label class="" for="billing_phone">Số điện thoại <abbr title="required" class="required">*</abbr>
                                                    <span class="inline-validate" id="check3"></span>
                                                    </label>
                                                    <input type="text" value="'.$row['PHONE'].'" placeholder="" id="billing_phone" name="billing_phone" class="input-text" oninput="validateForm(billing_phone,check3,regexCheckout[3])">
                                                </p> ';

                                                        }
                                                    }
                                                }else 
                                                if(strpos($_SESSION['id'], 'G') !== false){                                                    
                                                echo '<p id="infoContainer0" class="form-row form-row-first validate-required">
                                                    <label class="" for="billing_first_name">Họ tên<abbr title="required" class="required">*</abbr>
                                                    <span class="inline-validate" id="check0"></span>
                                                    </label>
                                                    <input type="text"  placeholder="" id="billing_first_name" name="billing_first_name"
                                                    class="input-text " oninput="validateForm(billing_first_name,check0,regexCheckout[0])">
                                                </p>
                                                
                                                <div class="clear"></div>                                         
                                                <p id="infoContainer1" class="form-row form-row-wide address-field validate-required">
                                                    <label class="" for="billing_address_1">Địa chỉ <abbr title="required" class="required">*</abbr>
                                                    <span class="inline-validate" id="check1"></span>
                                                    </label>
                                                    <input type="text" value="" id="billing_address_1" name="billing_address_1" id="billing_address_1" class="input-text" oninput="validateForm(billing_address_1,check1,regexCheckout[1])">
                                                </p>                                          
                                                
                                                <div class="clear"></div>

                                                <p id="infoContainer2" class="form-row form-row-first validate-required validate-email">
                                                    <label class="" for="billing_email">Email <abbr title="required" class="required">*</abbr>
                                                    <span class="inline-validate" id="check2"></span>
                                                    </label>
                                                    <input type="text" value="" placeholder="" id="billing_email" name="billing_email" class="input-text inline-validate" class="input-text" oninput="validateForm(billing_email,check2,regexCheckout[2])">

                                                </p>

                                                <p id="infoContainer3" class="form-row form-row-last validate-required validate-phone">
                                                    <label class="" for="billing_phone">Số điện thoại <abbr title="required" class="required">*</abbr>
                                                    <span class="inline-validate" id="check3"></span>
                                                    </label>
                                                    <input type="text" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text" oninput="validateForm(billing_phone,check3,regexCheckout[3]); checkPhoneExist(billing_phone,check3);">
                                                </p> ';
                                                }
                                                ?>                                           

                                                <div class="clear"></div>

                                            </div>
                                        </div>                                    

                                    </div>                               

                                    <h3 id="order_review_heading">Đơn hàng của bạn</h3>

                                    <div id="order_review">
                                        <table class="shop_table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Sản phẩm</th>
                                                    <th class="product-total">Giá</th>
                                                </tr>
                                            </thead>                                        
                                            <tfoot>

                                                <tr class="cart-subtotal">
                                                    <th>Giỏ hàng</th>
                                                    <td><span class="amount">0đ</span>
                                                    </td>
                                                </tr>

                                                <tr class="voucher">
                                                    <th>Giảm giá</th>
                                                    <td><span class="amount">0%</span> </td>
                                                </tr>

                                                <tr class="shipping">
                                                    <th>Phí ship</th>
                                                    <td id="shipFee">0đ
                                                        <input type="hidden" class="shipping_method" value="free_shipping" id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                                    </td>
                                                </tr>


                                                <tr class="order-total">
                                                    <th>Tổng cộng</th>
                                                    <td><strong><span class="amount">0đ</span></strong> </td>
                                                </tr>

                                            </tfoot>
                                        </table>


                                        <div id="payment">
                                            <ul class="payment_methods methods">
                                                <li class="payment_method_bacs">
                                                    <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                                    <label for="payment_method_bacs">Chuyển tiền trực tiếp qua ngân hàng </label>
                                                    <div class="payment_box payment_method_bacs">
                                                        <p>Thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng ID đơn hàng của bạn làm tài liệu tham khảo thanh toán. Đơn hàng của bạn đã thắng được vận chuyển cho đến khi tiền được xóa trong tài khoản của chúng tôi.</p>
                                                    </div>
                                                </li>
                                                
                                                <li class="payment_method_paypal">
                                                    <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                                    <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png"><a title="PayPal là gì?" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal.com/gb/webapps/mpp/paypal-popup">What is PayPal?</a>
                                                    </label>
                                                    <div style="display:none;" class="payment_box payment_method_paypal">
                                                        <p>Thanh toán qua PayPal; bạn có thể thanh toán bằng thẻ tín dụng nếu bạn không có tài khoản PayPal.</p>
                                                    </div>
                                                </li>
                                                
                                            </ul>                                        
                                            
                                            <div class="form-row place-order margin-button">

                                                <input type="submit" data-value="Place order" value="Đặt hàng" id="validateClickButt" name="woocommerce_checkout_place_order" class="button alt">


                                            </div>

                                            <div class="clear"></div>

                                        </div>
                                    </div>
                                </form>                                     

                            </div>                       
                        </div>                    
                    </div>
                </div>
            </div>
        </div>   

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
    <script type="text/javascript" src="lib/js/validate.js"></script>
    <script type="text/javascript" src="lib/js/chatbox.js"></script>
    <script type="text/javascript" src="lib/js/logout.js"></script>
  </body>
</html>