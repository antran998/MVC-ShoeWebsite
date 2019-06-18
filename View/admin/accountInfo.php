<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SneakBoys</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="lib/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="lib/css/style.css">

</head>
<body onload="loadInfoAccount(); fixInfoButt();">
  <div class="container">
    <div class="row"> 
      <div class="col-md-9" id="info">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <h4>Thông tin của bạn</h4>
                <hr>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <form method="POST" action="">
                  <?php

                  $data=$GLOBALS['db']->ReturnListValue('account_info');
                  while($row=mysqli_fetch_assoc($data)){
                    if(isset($_SESSION['id'])&&$row['ID']== $_SESSION['id']){

                      echo '                                
                      <div class="form-group row">
                        <label for="name" class="col-4 col-form-label">Họ tên
                        
                        </label> 
                        
                        <div class="col-8 float-container">
                          <label id="check0"></label>                          
                          <input id="nameUpdateAcc" value="'.$row['FULL_NAME'].'" name="name" placeholder="Họ tên" class="form-control here" type="text" oninput="validateForm(nameUpdateAcc,check0,regexCheckout[0])">
                        </div>                        
                      </div>                      
                      
                      <div class="form-group row">
                        <label for="text" class="col-4 col-form-label">Địa chỉ</label> 
                        <div class="col-8 float-container">
                        <label id="check1"></label>
                        <input id="addressUpdateAcc" name="text" value="'.$row['ADDRESS'].'" placeholder="Địa chỉ" class="form-control here" required="required" type="text" oninput="validateForm(addressUpdateAcc,check1,regexCheckout[1])">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="text" class="col-4 col-form-label">Email</label> 
                        <div class="col-8 float-container">
                        <label id="check2"></label>
                          <input id="emailUpdateAcc" value="'.$row['EMAIL'].'" name="text" placeholder="Email" class="form-control here" required="required" type="text" oninput="validateForm(emailUpdateAcc,check2,regexCheckout[2])">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="website" class="col-4 col-form-label">Số điện thoại</label> 
                        <div class="col-8 float-container">
                        <label id="check3"></label>
                          <input id="phoneUpdateAcc" value="'.$row['PHONE'].'" name="website" placeholder="Số điện thoại" class="form-control here" type="text" oninput="validateForm(phoneUpdateAcc,check3,regexCheckout[3])">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="publicinfo" class="col-4 col-form-label">Mật khẩu mới</label> 
                        <div class="col-8 float-container">
                        <label id="check4"></label>
                          <input type="password" id="passUpdateAcc" name="publicinfo" placeholder="Mật khẩu mới (gồm ký tự hoa, thường, đặc biệt, số)" cols="40" rows="4" class="form-control" oninput="validateForm(passUpdateAcc,check4,regexCheckout[4])">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="newpass" class="col-4 col-form-label">Nhập lại mật khẩu mới</label> 
                        <div class="col-8 float-container">
                        <label id="check5"></label>
                          <input type="password" id="repassUpdateAcc" name="newpass" placeholder="Nhập lại mật khẩu mới" class="form-control here" type="text" oninput="checkpass(repassUpdateAcc,check5,passUpdateAcc)">
                        </div>
                      </div> 
                      <div class="form-group row">
                        <div class="offset-4 col-8">
                          <button name="submit" type="submit" class="btn btn-primary Update" id-acc='.$row['ID'].'>Cập nhật thông tin</button>
                        </div>
                      </div>';

                    }
                  };

                  ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="lib/js/validate.js"></script>
</body>
</html>

