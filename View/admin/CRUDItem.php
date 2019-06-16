<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="lib/css/CRUD.css">
<link rel="stylesheet" type="text/css" href="lib/css/style.css">

</head>
<body >

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
						<h2>Manage <b>Product</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Item</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>
							
						</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
						<th>Discount Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody id="data">
                    <?php
                   $sizeItem = $GLOBALS['db']->getSize('ID_ITEM','items');
                   for($i = 1;$i<=$sizeItem ;$i++){
                       $idProduct = $GLOBALS['db']->GetSpecificRow($i,'ID_ITEM','items','ID_ITEM');
                       $nameProduct = $GLOBALS['db']->GetSpecificRow($i,'NAME','items','ID_ITEM');
                       $price = numberWithDots($GLOBALS['db']->GetSpecificRow($i,'PRICE','items','ID_ITEM'));
                       $discountPrice = numberWithDots($GLOBALS['db']->GetSpecificRow($i,'DISCOUNT_PRICE','items','ID_ITEM'));
                       $imgItem = $GLOBALS['db']->GetSpecificRow($i,'IMG_ITEM','items','ID_ITEM'); 
                    
                    
                        echo '<tr>
						<td>
							
						</td>
                        <td id="ID" name='.$idProduct.'>'.$idProduct.'</td>
                        <td>'.$nameProduct.'</td>
						<td>'.$price.'</td>
                        <td>'.$discountPrice.'</td>
                        <td><img src="lib/'.$imgItem.'"></td>
						<td>
						
                            <a href="#editEmployeeModal"  class="edit getIDedit" data-toggle="modal"  pro-id="'.$idProduct.'"><i  class="material-icons" data-toggle="tooltip" title="Edit"  >&#xE254;</i></a>
                            <a href="#deleteEmployeeModal" class="delete getIDdelete" data-toggle="modal"  pro-id="'.$idProduct.'"><i class="material-icons" data-toggle="tooltip" title="Delete" >&#xE872;</i></a>
						</td>
                        </tr>';
                    }
                    ?>
                    
                </tbody>
            </table>
			<div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
	<!-- Add Modal HTML -->
	<?php
	if(isset($_POST['insertSubmit'])){
		$filename=$_FILES['imageInsert']['name'];
		$tempName=$_FILES['imageInsert']['tmp_name'];
		if(isset($filename)){
			if(!empty($filename)){
				$location="lib/img/";
				if(move_uploaded_file($tempName,$location.$filename)){
					echo "File uploaded";
				}
			}
		}
	}
	?>
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<?php
				
				
				?>	
				<form action="" method="POST" onSubmit="window.reload()" enctype="multipart/form-data"> 
					<div class="modal-header">						
						<h4 class="modal-title">Add Item</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>ID</label>
							<input type="text" id="idInsert" class="form-control" name="id" required>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" id="nameInsert" class="form-control"  name="name" required>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="text" id="priceInsert" class="form-control"  name="price" required>
						</div>
						<div class="form-group">
							<label>Discount Price</label>
							<input type="text" id="discountpriceInsert" class="form-control"  name="disprice" required>
						</div>
						<div class="form-group">
							<label>Image</label>
							<input type="file" class="form-control" id="imgInsert" name="imageInsert" >
						</div>							
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success insert" value="Add"  name="insertSubmit">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
    
    <div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="" method="POST" onSubmit="window.reload();" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Edit item</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>ID</label>
							<input type="text" class="form-control" id="idEdit" required>
						</div>
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" id="nameEdit" required>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="text" class="form-control" id="priceEdit" required>
						</div>
						<div class="form-group">
							<label>Discount Price</label>
							<input type="text" class="form-control" id="discountPriceEdit" required>
						</div>
						<div class="form-group">
							<label>Image</label>
							<input type="file" id="imgEdit" class="form-control">
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
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="lib/js/CRUDitem.js"></script>
</html>