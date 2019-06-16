$(document).ready(function(){

	$('.getIDdeleteAcc').on('click',function(){
		var id =$(this).attr('acc-id');
		
		$.ajax({
			url:'Routes.php',
			method:'POST',
			data: {deleteIdAcc:id},
			success:function(response){
				
			}
		});
		
	});

	var idGetEdit;
	$('.getIDeditAcc').on('click',function(){
		idGetEdit =$(this).attr('acc-id');
		
	});


	$('.table tbody').on('click','.getIDeditAcc',function(){
		var currow=$(this).closest('tr');
		$('#fullnameEditAcc').val(currow.find('td:eq(2)').text());
		$('#emailEditAcc').val(currow.find('td:eq(3)').text());
		$('#addressEditAcc').val(currow.find('td:eq(4)').text());
		$('#phoneEditAcc').val(currow.find('td:eq(5)').text());
				//$('#imgEdit').val(splitPath(currow.find('td:eq(5)').text()));
			});
	
	$('.Edit').on('click',function(e){

		var countCheck =4;
		for(var i=0;i<4;i++){
			var tempCheck = document.getElementById('check'+i);
			if(tempCheck.innerHTML!='<i class="fa fa-check" aria-hidden="true"></i>'){
				e.preventDefault();
				countCheck--;
				tempCheck.innerHTML= 'X';
				tempCheck.style.color = 'Red';
			}			
		}
		if(countCheck==4){
			var idEditAcc = idGetEdit;
			var fullnameEditAcc=$('#fullnameEditAcc').val();
			var emailEditAcc=$('#emailEditAcc').val();
			var addressEditAcc=$('#addressEditAcc').val();
			var phoneEditAcc = $('#phoneEditAcc').val();

			var pattern={
				idEditAcc:idEditAcc,
				fullnameEditAcc:fullnameEditAcc,
				emailEditAcc:emailEditAcc,
				addressEditAcc:addressEditAcc,
				phoneEditAcc:phoneEditAcc
			}
			
			$.ajax({
				url:'Routes.php',
				method:'POST',
				data: {pattern:JSON.stringify(pattern)},
				success:function(res){
					console.log(res);
				}
			});
		}
		else{
			alert("Bạn nhập sai thông tin");
		}

		
		
	});

	var id,username,fullname,address,email,phone;
	$('.insertAcc').on('click',function(){
		idInsertAcc=$('#idInsertAcc').val();
		username=$('#nameInsertAcc').val();
		fullname=$('#fullnameInsertAcc').val();
		address=$('#addressInsertAcc').val();
		email=$('#emailInsertAcc').val();
		phone=$('#phoneInsertAcc').val();
		console.log(idInsertAcc+username+fullname+address+email+phone);
		var pattern={
			idInsertAcc:idInsertAcc,
			username:username,
			fullname:fullname,
			address:address,
			email:email,
			phone:phone
		}
		$.ajax({
			url:'Routes.php',
			method:'POST',
			data:{pattern:JSON.stringify(pattern)},
			success:function(res){
				console.log(res);
			}
		});
	});


});