<!DOCTYPE html>
<html lang="en">
<head>	
	<title>SneakBoys</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="lib/css/util.css">
	<link rel="stylesheet" type="text/css" href="lib/css/main.css">
<!--===============================================================================================-->

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="lib/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="lib/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="lib/css/owl.carousel.css">
    <link rel="stylesheet" href="lib/css/style.css">
    <link rel="stylesheet" type="text/css" href="lib/css/loader.css">
    <link rel="stylesheet" href="lib/css/responsive.css">
</head>
<body onload="hideScrollbar(); addSendButt();">
    <!-- loader -->
    <div class="loader" id="theLoader"></div>
    
    <div id="hidden_container">
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>LIÊN HỆ</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="lib/img/img-01.png" alt="IMG">
			</div>

			<form class="contact1-form validate-form">
				<span class="contact1-form-title">
					THÔNG TIN LIÊN LẠC
				</span>

				<div class="wrap-input1 validate-input float-container" data-validate ="Name is required">
                    <label id="check0"></label>
					<input class="input1" type="text" name="name" id="fullname" placeholder="Họ Tên" value="<?php echo $_SESSION['username']; ?>" disabled>
					<span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input float-container" data-validate = "Valid email is required: ex@abc.xyz">
                    <label id="check1"></label>
					<input class="input1" type="text" name="email" id="email" placeholder="Email" value="<?php echo $_SESSION['email']; ?>" disabled>
                    <span class="shadow-input1"></span>
				</div>

				<div class="wrap-input1 validate-input" data-validate = "Message is required">
					<textarea class="input1" name="message" placeholder="Lời nhắn" id="messSend"></textarea>
					<span class="shadow-input1"></span>
				</div>

				<div class="container-contact1-form-btn">
					<button class="contact1-form-btn" id="sendButton">
						<span>
							Gửi
							<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
						</span>
					</button>
				</div>
			</form>
		</div>
	</div>


    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row" style="margin-left: 500px; margin-right: -350px;">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <p style="color: #fff">Cửa Hàng CHUYÊN cung cấp các mặt hàng đẹp của nhãn hàng ADIDAS NIKE VANS NEWBALANCE và Cửa hàng nói không với hàng FAKE</p>
                        <div class="footer-social">
                            <a href="https://www.facebook.com/tienttt?sk=wall&fref=gs&dti=1943693119073870&hc_location=group_dialog" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.facebook.com/tienttt?sk=wall&fref=gs&dti=1943693119073870&hc_location=group_dialog" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.facebook.com/tienttt?sk=wall&fref=gs&dti=1943693119073870&hc_location=group_dialog" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="https://www.facebook.com/tienttt?sk=wall&fref=gs&dti=1943693119073870&hc_location=group_dialog" target="_blank"><i class="fa fa-linkedin"></i></a>
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

<!--===============================================================================================-->
<!-- <script src="lib/js/tilt/tilt.jquery.min.js"></script>
 -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>

<script type="text/javascript" src="lib/js/show.js"></script>
<script type="text/javascript" src="lib/js/validate.js"></script>

<!-- <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script> -->

</body>
</html>
