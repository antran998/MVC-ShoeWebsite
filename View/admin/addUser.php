<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="lib/css/style.css" type='text/css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="lib/css/loader.css">
    <title>Đăng nhập</title>
</head>
<body>
    <!-- loader -->
    <div class="loader" id="theLoader"></div>

    <div id="hidden_container">
        <div id="logreg-forms">
            <form class="form-signin" method="POST" action="home">
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
                <div class="social-login" style="text-align: center">
                    <button class="btn facebook-btn social-btn home" type="button" name="buttonHome"><span>Trang Chủ</span> </button>
                </div>

                <input  id="inputEmail" class="form-control" placeholder="Tên đăng nhập" required="" autofocus="" name="usernameLogin">
                <input type="password" id="inputPassword" class="form-control" placeholder="Mật khẩu" required="" name="passwordLogin">
                
                <button class="btn btn-success btn-block" type="submit" name="login"><i class="fas fa-sign-in-alt"></i> Sign in</button>
                <a href="#" id="forgot_pswd">Forgot password?</a>
                <hr>
                <!-- <p>Don't have an account!</p>  -->
                <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
            </form>
            
            <form class="form-reset">
                <input type="email" id="resetEmail" class="form-control" placeholder="Email address" required="" autofocus="">
                <input type="text" id="usernameReset" class="form-control" placeholder="Username" required="" autofocus="">
                <button class="btn btn-primary btn-block Reset" type="submit" >GỬI PASSWORD QUA EMAIL</button>
                <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            <form action="" class="form-signup" method="POST">                      
                <div class="float-container">
                    <label id="check0"></label>
                    <input type="text" id="fullname" class="form-control" placeholder="Họ tên"  autofocus="" name="fullname" oninput="validateForm(fullname,check0,regexCheckout[0])">
                </div>

                <div class="float-container">
                    <label id="check1"></label>
                    <input type="text" id="address" class="form-control" placeholder="Địa chỉ"  autofocus="" name="address" oninput="validateForm(address,check1,regexCheckout[1])">
                </div>             

                <div class="float-container">
                    <label id="check2"></label>
                    <input type="text" id="email" class="form-control" placeholder="Email"  autofocus="" name="email" oninput="validateForm(email,check2,regexCheckout[2])">
                </div>                       

                <div class="float-container">
                    <label id="check3"></label>
                    <input type="text" id="phone" class="form-control" placeholder="Số điện thoại"  autofocus="" name="phonenum" oninput="validateForm(phone,check3,regexCheckout[3])">
                </div>

                <div class="float-container">
                    <label id="check5"></label>
                    <input type="text" id="user_name" class="form-control" placeholder="Tên tài khoản" required="" autofocus="" name="username" oninput="validateForm(user_name,check5,regexCheckout[5])">
                </div>
                
                <div class="float-container">
                    <label id="check4"></label>
                    <input type="password" id="user_pass" class="form-control" placeholder="Mật khẩu (gồm ký tự in hoa, đặc biệt, số, thường)" required autofocus="" name="pass" oninput="validateForm(user_pass,check4,regexCheckout[4])">
                </div>            

                <div class="float-container">
                    <label id="check6"></label>
                    <input type="password" id="user_repeatpass" class="form-control" placeholder="Nhập lại mật khẩu" required autofocus="" name="pass-repeat" oninput="checkpass(user_pass, check6, user_repeatpass)">
                </div>
                
                <button class="btn btn-primary btn-block Registry" type="submit" name="btn_submit"><i class="fas fa-user-plus"></i> Sign Up</button>
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            <br>
                
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php 
        if(isset($_SESSION['check'])){
            unset($_SESSION['check']);
            echo "<script type='text/javascript'>alert('Sai tên đăng nhập hoặc mật khẩu')</script>";
        }
    ?>
    <script type="text/javascript" src="lib/js/signAccount.js"></script>
    <script type="text/javascript" src="lib/js/addUser.js"></script>
    <script type="text/javascript" src="lib/js/validate.js"></script>
    
</body>
</html>