<?php

if(!isset($_POST['pattern'])&& !isset($_POST['regexPatt'])){
	//Load View 
	if($_GET['url']=='index.php'){
		$_GET['url'] = 'home';
	}

	Route::set('home',function(){
		HomeController::CreateView('index');
	});
	Route::set('shop',function(){
		HomeController::CreateView('shop');
	});
	Route::set('single-product',function(){
		HomeController::CreateView('single-product');
	});
	Route::set('cart',function(){
		HomeController::CreateView('cart');
	});
	Route::set('checkout',function(){
		HomeController::CreateView('checkout');
	});
	Route::set('contact',function(){
		HomeController::CreateView('contact');
	});

	//////////////////////load view admin
	Route::set('addUser',function(){		
		adminController::CreateView('addUser');
	});
	Route::set('CRUDItem',function(){
		adminController::CreateView('CRUDItem');
	});
	Route::set('CRUDAccount',function(){
		adminController::CreateView('CRUDAccount');
	});
	Route::set('accountInfo',function(){
		 adminController::CreateView('accountInfo');
	});
}

///////////// Nhận request = Ajax
if(isset($_POST['pattern'])){
	////////Nhận và gửi qua Home
	Route::getRequest(function(){
		HomeController::SendDataAjax($_POST['pattern']);
	});

	////////Nhận và gửi qua admin
	Route::getRequest(function(){
		adminController::SendData($_POST['pattern']);
	});
}

////////////Nhận request từ thanh Search
if(isset($_POST['regexPatt'])){
	Route::getRequest(function(){
		HomeController::SendSearch($_POST['regexPatt']);
	});
}

//////////////////đường dẫn vào adminController xóa item
if(isset($_POST['deleteId'])){
	Route::getRequest(function(){
		adminController::RemoveItem($_POST['deleteId']);
	});
}


?>