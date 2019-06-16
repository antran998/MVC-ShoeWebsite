var regexCheckout= [
	/^(\p{Lu}){1}(\p{Ll}){0,7}(?: (\p{Lu}){1}(\p{Ll}){0,7})*$/u, // check name
	/^\d+(?:\/|( [\p{L},.]{1,7}))*$/u, // check address
	/^[a-z][^0][a-z0-9_\.\-]{3,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/, // check email
	/^(\+\d{2}|[0])[1-9]{9}$/, // check phone number
	/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/, //check password
	/^([a-z][a-z0-9]{6,})$/, // check username
];

function validateForm(inputValue, check, regex){
	if(inputValue.value != ''){
		check.style.display = 'block';
		if(regex.test(inputValue.value) == true){
			check.innerHTML = '<i class="fa fa-check" aria-hidden="true"></i>';
			check.style.color = 'Green';
			
		}
		else{		
			check.innerHTML= 'X';
			check.style.color = 'Red';
		}
	}
	else{
		check.style.display = 'none';
	}
}

/////////////////////////////////////////

function loadInfoCheckout(){
	if(billing_first_name.value!=""){
		for (var i = 0; i < 4; i++) {
			document.getElementById("check"+i).innerHTML='<i class="fa fa-check" aria-hidden="true"></i>';
			document.getElementById("check"+i).style.color='Green';
		}
		billing_first_name.disabled = true;
		billing_email.disabled = true;
		billing_address_1.disabled = true;
		billing_phone.disabled = true;

	}
}

function checkPhoneExist(inputValue,check){
	if(check.innerHTML == '<i class="fa fa-check" aria-hidden="true"></i>'){
		var pattern = {
			phoneExist:inputValue.value
		};
		$.ajax({
	        url: "Routes.php",
	        method: "post",
	        data: {pattern:JSON.stringify(pattern)},
	        success: function(respone){
	            console.log(respone);
	            var regexUsername = /\d/;
	            if(respone!=""){
	            	if(regexUsername.test(respone) != true){
		            	alert("Chúng tôi nhớ bạn "+respone);	
		            }
		            else{
		            	alert("Bạn đã có tài khoản vui lòng đăng nhập \nTài khoản của bạn là "+respone);
		            	window.location.href = "http://localhost/WebPHPMvc/addUser";
		            }
	            }			            
	        }
	    });
	}
}

function addValidateButt(){
	validateClickButt.addEventListener("click",function(e){
		e.preventDefault();
		var countCheck =3;
		for(var i=0;i<4;i++){
			var tempCheck = document.getElementById('check'+i);
			if(tempCheck.innerHTML!='<i class="fa fa-check" aria-hidden="true"></i>'){
				e.preventDefault();
				countCheck--;
				tempCheck.innerHTML= 'X';
				tempCheck.style.color = 'Red';
			}
		}
		if(countCheck==3){
			if(shipFee>0){
				var fullname=billing_first_name.value;
				var email = billing_email.value;
				var address = billing_address_1.value;
				var phone = billing_phone.value;
				// voucherCode=JSON.stringify(voucherCode);

				var pattern = {
					list:list,
					totalPrice:totalPrice,
					shipFee:shipFee,
					voucherPercent:voucherPercent,
					fullname: fullname,
					email:email,
					address:address,
					phone:phone
				}

				$.ajax({        
			        url: "Routes.php",
			        method: "post",
			        data: {pattern:JSON.stringify(pattern)},
			        success: function(respone){

			            console.log(respone);
			                                 
			        }
			    });
			    alert("Thanh toán thành công");
				clearCart();
				location.reload();
			}
			else{
				alert("Vui lòng bổ sung phí ship");
				window.location.href = "http://localhost/WebPHPMvc/cart"
			}
			
		}
		else{
			alert("Bạn nhập sai hoặc thiếu thông tin !");
		}
		
	});
}

////////////////////////////////////////////////

function loadInfoAccount(){
	for (var i = 0; i < 6; i++) {
		document.getElementById("check"+i).innerHTML='<i class="fa fa-check" aria-hidden="true"></i>';
		document.getElementById("check"+i).style.color='Green';
	}
}

function checkpass(inputValue, check, repass){
    if(inputValue.value != ''){
		check.style.display = 'block';
		if(repass.value==inputValue.value){
			check.innerHTML = '<i class="fa fa-check" aria-hidden="true"></i>';
			check.style.color = 'Green';			
		}
		else{		
			check.innerHTML= 'X';
			check.style.color = 'Red';
		}
	}
	else{
		check.style.display = 'none';
	}
}

function fixInfoButt(){
	$('.Update').on('click',function(e){
		var countCheck =5;
		for(var i=0;i<6;i++){
			var tempCheck = document.getElementById('check'+i);
			if(tempCheck.innerHTML!='<i class="fa fa-check" aria-hidden="true"></i>'){
				e.preventDefault();
				countCheck--;
				tempCheck.innerHTML= 'X';
				tempCheck.style.color = 'Red';
			}			
		}
		if(countCheck==5){
			var id= $(this).attr('id-acc');
			var idUpdateAcc = id;
			var nameUpdateAcc=$('#nameUpdateAcc').val();
			var emailUpdateAcc=$('#emailUpdateAcc').val();
			var addressUpdateAcc=$('#addressUpdateAcc').val();
			var phoneUpdateAcc = $('#phoneUpdateAcc').val();
			var passwordUpdateAcc=$('#passUpdateAcc').val();
			var repassUpdateAcc=$('#repassUpdateAcc').val();
			alert(id+nameUpdateAcc);
			if(passwordUpdateAcc==repassUpdateAcc){
				var pattern={
					idUpdateAcc:idUpdateAcc,
					nameUpdateAcc:nameUpdateAcc,
					emailUpdateAcc:emailUpdateAcc,
					addressUpdateAcc:addressUpdateAcc,
					phoneUpdateAcc:phoneUpdateAcc,
					passwordUpdateAcc:passwordUpdateAcc
				}
			}else{
				alert('Mật khẩu không khớp');
			}
			$.ajax({
				url:'Routes.php',
				method:'POST',
				data: {pattern:JSON.stringify(pattern)},
				success:function(res){
					alert('Update thành công');
				}
			});
		}
		else{
			alert("Bạn nhập sai thông tin");
		}
	});		
}

//////////////////////////////////////////////////////

function loadEditAcc(){
	for (var i = 0; i < 4; i++) {
		document.getElementById("check"+i).innerHTML='<i class="fa fa-check" aria-hidden="true"></i>';
		document.getElementById("check"+i).style.color='Green';
	}
}

//////////////////////////////////////////////////////


function mySend(e){
	e.preventDefault();
	for(var i=1; i<9; i++){
		if(document.getElementById('check'+i).innerHTML == 'OK'){
			alert('Bạn đã gửi thành công');
		}
		else {
			alert('Xin vui lòng nhập lại');
		}
	}
}

function addSendButt(){
	sendButton.addEventListener("click",function(e){
		e.preventDefault();
		var countCondition = 2;

		if(messSend.value==""){
			countCondition--;
		}

		if(countCondition!=2){
			alert("Hãy điền tin nhắn");
		}
		else{

			var pattern = {
				mess:messSend.value
			} 

			$.ajax({        
			    url: "Routes.php",
			    method: "post",
			    data: {pattern:JSON.stringify(pattern)},
			    success: function(respone){
			   		console.log(respone);
			        location.reload();
			    }
			});

		}
	});
}



////////////////////////////////////
function hideScrollbar(){
	document.documentElement.style.overflowX = 'hidden';
}
