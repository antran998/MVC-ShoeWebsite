<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản lý tài khoản </title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="lib/css/CRUD.css">
<link rel="stylesheet" type="text/css" href="lib/css/style.css">

</head>
<body onload="loadEditAcc();">
	
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

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Quản lý  <b>Account</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Account</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <div class="search-container">
			    <form method="POST">
				    <input type="text" placeholder="Tìm kiếm theo tên TK" name="search" id="searchString">
				    <button type="submit"><i class="fa fa-search"></i></button>
			    </form>
		  	</div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							
						</th>
                        <th>ID</th>
                        <th>Họ tên</th>
						<th>Địa chỉ Email</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Thao tác</th>
                        
                    </tr>
                </thead>
                <tbody id="data">
					
                    <?php

	                   if(isset($_SESSION['searchString'])){
	                   $data=$GLOBALS['db']->ReturnListValueWithOption('account_info',$_SESSION['searchString'],'FULL_NAME');
					   }else{
						$data=$GLOBALS['db']->ReturnListValueWithOption('account_info','','');
					   }	                    
	                    while($row=mysqli_fetch_assoc($data)){
	                        echo '<tr>
							<td>
								
							</td>
	                        <td id="ID" name='.$row['ID'].'>'.$row['ID'].'</td>
	                        <td>'.$row['FULL_NAME'].'</td>
							<td>'.$row['EMAIL'].'</td>
	                        <td>'.$row['ADDRESS'].'</td>
	                        <td>'.$row['PHONE'].'</td>
							<td>
							
	                            <a href="#editEmployeeModal"  class="edit getIDeditAcc" data-toggle="modal"  acc-id="'.$row['ID'].'"><i  class="material-icons" data-toggle="tooltip" title="Edit"  >&#xE254;</i></a>
	                            <a href="#deleteEmployeeModal" class="delete getIDdeleteAcc" data-toggle="modal"  acc-id="'.$row['ID'].'"><i class="material-icons" data-toggle="tooltip" title="Delete" >&#xE872;</i></a>
							</td>
	                        </tr>';
						}
						unset($_SESSION['searchString']);
                    ?>
                    
                </tbody>
            </table>
        </div>
    </div>
	<!-- Add Modal HTML -->
	
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
					
				<form action="" method="POST" onSubmit="window.reload()" enctype="multipart/form-data"> 
					<div class="modal-header">						
						<h4 class="modal-title">Thêm tài khoản</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>ID</label>
							<span class="inline-validate" id="check4"></span>
							<input type="text" id="idInsertAcc" class="form-control" placeholder="Nhập ID" name="id" required oninput="validateForm(idInsertAcc,check4,regexCheckout[6]);">
						</div>
						<div class="form-group">
							<label>Tên tài khoản</label>
							<span class="inline-validate" id="check5"></span>
							<input type="text" id="nameInsertAcc" class="form-control" placeholder="7 ký tự trở lên gồm chữ và số" name="name" required oninput="validateForm(nameInsertAcc,check5,regexCheckout[5]);">
						</div>
						<div class="form-group">
							<label>Mật khẩu</label>
							<span class="inline-validate" id="check6"></span>
							<input type="password" id="password" class="form-control"  name="password" required oninput="validateForm(password,check6,regexCheckout[4]);">
							<p style="color:red"><small>Gồm 8 ký tự trở lên gồm ký tự đặc biệt,chữ thường,chữ hoa,số </small></p>

						</div>
						<div class="form-group">
							<label>Nhập lại mật khẩu</label>
							<span class="inline-validate" id="check7"></span>
							<input type="password" id="repeatPassword" class="form-control"  name="repeatPassword" required oninput="checkpass(password, check7, repeatPassword)">
						</div>
						<div class="form-group">
							<label>Họ tên</label>
							<span class="inline-validate" id="check8"></span>
							<input type="text" id="fullnameInsertAcc" class="form-control" placeholder="Nhập Họ tên"  name="fullname" required oninput="validateForm(fullnameInsertAcc,check8,regexCheckout[0]);">
						</div>
						<div class="form-group">
							<label>Địa chỉ</label>
							<span class="inline-validate" id="check9"></span>
							<input type="text" id="addressInsertAcc" class="form-control" placeholder="Nhập địa chỉ" name="address" oninput="validateForm(addressInsertAcc,check9,regexCheckout[1]);">
						</div>
						<div class="form-group">
							<label>Email</label>
							<span class="inline-validate" id="check10"></span>
							<input type="text" id="emailInsertAcc" class="form-control" placeholder="Nhập Email"  name="email" required oninput="validateForm(emailInsertAcc,check10,regexCheckout[2]);">
						</div>	
                        <div class="form-group">
							<label>Số điện thoại</label>
							<span class="inline-validate" id="check11"></span>
							<input type="text" class="form-control" id="phoneInsertAcc" placeholder="Nhập số điện thoại" name="phone" oninput="validateForm(phoneInsertAcc,check11,regexCheckout[3]);">
						</div>							
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success insertAcc" value="Add"  name="insertSubmit">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
    
    <div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">						
						<h4 class="modal-title">Chỉnh sửa thông tin</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						
						<div class="form-group">
							<label>Họ tên</label>
							<span class="inline-validate" id="check0"></span>
							<input type="text" class="form-control" id="fullnameEditAcc" required oninput="validateForm(fullnameEditAcc,check0,regexCheckout[0]);">
						</div>
						<div class="form-group">
							<label>Địa chỉ</label>
							<span class="inline-validate" id="check1"></span>
							<input type="text"  class="form-control" id="addressEditAcc" required oninput="validateForm(addressEditAcc,check1,regexCheckout[1]);">
						</div>
						<div class="form-group">
							<label>Email</label>
							<span class="inline-validate" id="check2"></span>
							<input type="text" class="form-control" id="emailEditAcc" required oninput="validateForm(emailEditAcc,check2,regexCheckout[2]);">
						</div>
						<div class="form-group">
							<label>Số điện thoại</label>
							<span class="inline-validate" id="check3"></span>
							<input type="text" class="form-control" id="phoneEditAcc" required oninput="validateForm(phoneEditAcc,check3,regexCheckout[3]);">
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info Edit" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Delete Modal HTML -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
			
				<form method="POST" onSubmit="window.reload()">
					<div class="modal-header">						
						<h4 class="modal-title">Delete item</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger " value="Delete" name="deleteItem">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="final"></div>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="lib/js/CRUDaccount.js"></script>
	<script type="text/javascript" src="lib/js/validate.js"></script>
	<script type="text/javascript" src="lib/js/logout.js"></script>
</body>
</html>