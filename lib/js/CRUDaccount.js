$(document).ready(function(){
	// Delete account button
	$('.getIDdeleteAcc').on('click',function(){
		var id =$(this).attr('acc-id');
		
		$.ajax({
			url:'Routes.php',
			method:'POST',
			data: {deleteIdAcc:id},
			success:function(response){
				console.log(response);
			}
		});
		
	});

	// edit account button
	var idGetEdit;
	$('.getIDeditAcc').on('click',function(){
		idGetEdit =$(this).attr('acc-id');
		
	});

	// load info of account
	$('.table tbody').on('click','.getIDeditAcc',function(){
		var currow=$(this).closest('tr');
		$('#fullnameEditAcc').val(currow.find('td:eq(2)').text());
		$('#emailEditAcc').val(currow.find('td:eq(3)').text());
		$('#addressEditAcc').val(currow.find('td:eq(4)').text());
		$('#phoneEditAcc').val(currow.find('td:eq(5)').text());
	});
	
	// check conditions and send data when edit complete
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

	// check conditions when insert account
	var id,username,fullname,address,email,phone,password;
	$('.insertAcc').on('click',function(e){
		e.preventDefault();
		var countCheck =7;
		for(var i=4;i<12;i++){
			var tempCheck = document.getElementById('check'+i);
			if(tempCheck.innerHTML!='<i class="fa fa-check" aria-hidden="true"></i>'){
				e.preventDefault();
				countCheck--;
				tempCheck.innerHTML= 'X';
				tempCheck.style.color = 'Red';
			}			
		}
		if(countCheck==7){
			idInsertAcc=$('#idInsertAcc').val();
			username=$('#nameInsertAcc').val();
			fullname=$('#fullnameInsertAcc').val();
			address=$('#addressInsertAcc').val();
			email=$('#emailInsertAcc').val();
			phone=$('#phoneInsertAcc').val();
			password=$('#password').val();
			
			var pattern={
				idInsertAcc:idInsertAcc,
				username:username,
				fullname:fullname,
				address:address,
				email:email,
				phone:phone,
				password:password
			}
			$.ajax({
				url:'Routes.php',
				method:'POST',
				data:{pattern:JSON.stringify(pattern)},
				success:function(res){
					if(res==1){
						alert("Thêm thành công");
						window.location.reload();
					}
					else{
						if(res==0){
		                    alert("Trùng username");
		                    check5.innerHTML='X';
		                    check5.style.color = 'Red';
		                }
		                if(res==2){
		                    alert("Trùng ID");
		                    check4.innerHTML='X';
		                	check4.style.color = 'Red';
		                }		                						
					}
				}
			});
		}
		else{
			alert("Bạn đã nhập sai thông tin");
		}
	});

	// search bar when enter
	$('#searchString').on('keyup',function(){
		matchTest();
	});
	// search button
	$('.fa-search').on('click',function(){
		matchTest();
	});
	
	function matchTest(){
		var textFromBar = document.getElementById("searchString").value;
	    var spaceIndex;
	    if(textFromBar.indexOf(" ")==-1){
	        spaceIndex=textFromBar.length;
	    }
	    else{
	        spaceIndex=textFromBar.indexOf(" ");
	    }
	    var firstPattern="(?=.*"+textFromBar.substring(0,spaceIndex)+")";
	    var regexPatt = firstPattern;
	    for(var j= spaceIndex+1;j<textFromBar.length;j++){
	        if(textFromBar[j]==" "){
	            firstPattern += "(?=.*"+textFromBar.substring(spaceIndex+1,j)+")";
	            regexPatt = firstPattern;
	            spaceIndex = j;            
	        }
	        else{
	            regexPatt="(?=.*"+textFromBar.substring(spaceIndex+1,textFromBar.length)+")";
	            regexPatt = firstPattern + regexPatt;
	        }
	    }
	    regexPatt +=".*";
	    // (?=.*adidas)(?=.*alpha).*
		
	    $.ajax({        
	        url:'Routes.php',
			method:'POST',
			data: {searchString:regexPatt},
			success:function(res){	
			}
	    });    
	}


});