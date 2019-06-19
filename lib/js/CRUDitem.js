var splitPath = function(path) {
	var result = path.replace(/\\/g, "/").match(/(.*\/)?(\..*?|.*?)(\.[^.]*?)?(#.*$|\?.*$|$)/);
	return {
		dirname: result[1] || "",
		filename: result[2] || "",
		extension: result[3] || "",
		params: result[4] || ""
	};
};
$(document).ready(function(){
	$('.getIDdelete').on('click',function(){
		var id =$(this).attr('pro-id');
		
		$.ajax({
			url:'Routes.php',
			method:'POST',
			data: {deleteId:id},
			success:function(response){
						//DisplayData();
					}
				});
		
	});

	// get id when click edit
	var idGetEdit
	$('.getIDedit').on('click',function(){
		idGetEdit =$(this).attr('pro-id');
	});

	//binding data to form Edit
	$('.table tbody').on('click','.getIDedit',function(){
		var currow=$(this).closest('tr');
		$('#idEdit').val(currow.find('td:eq(1)').text());
		$('#nameEdit').val(currow.find('td:eq(2)').text());
		$('#priceEdit').val(currow.find('td:eq(3)').text().split('.').join(""));
		$('#discountPriceEdit').val(currow.find('td:eq(4)').text().split('.').join(""));
	});

	// send data of item when edit
	var idRemmemberEdit,idEdit,nameEdit,priceEdit,dispriceEdit,imgUrlEdit;
	$('.Edit').on('click',function(){
		
		idEdit=$('#idEdit').val();
		nameEdit=$('#nameEdit').val();
		priceEdit=$('#priceEdit').val();
		dispriceEdit=$('#discountPriceEdit').val();
		imgUrlEdit=$('#imgEdit').val();				
		imgUrlEdit=splitPath(imgUrlEdit);
		imgUrlEdit="img/"+imgUrlEdit.filename+imgUrlEdit.extension;			
		idRemmemberEdit=idGetEdit;
		if(imgUrlEdit=="img/"){
			imgUrlEdit+=idRemmemberEdit+".png";
		}
		var pattern={
			idRemmemberEdit:idRemmemberEdit,
			idEdit:idEdit,
			nameEdit:nameEdit,
			priceEdit:priceEdit,
			dispriceEdit:dispriceEdit,
			imgUrlEdit:imgUrlEdit
		}
		$.ajax({
			url:'Routes.php',
			method:'POST',
			data: {pattern:JSON.stringify(pattern)},
			success:function(res){
				console.log(res);
			}
		});
		
	});

	//send data when add new item
	var idInsert,nameInsert,priceInsert,dispriceInsert,imgUrl
	$('.insert').on('click',function(e){
		e.preventDefault();
		idInsert=$('#idInsert').val();
		nameInsert=$('#nameInsert').val();
		priceInsert=$('#priceInsert').val();
		dispriceInsert=$('#discountpriceInsert').val();
		imgUrl=$('#imgInsert').val();
		imgUrl=splitPath(imgUrl);
		imgUrl="img/"+imgUrl.filename+imgUrl.extension;
		alert(imgUrl);
		var pattern={
			idInsert:idInsert,
			nameInsert:nameInsert,
			priceInsert:priceInsert,
			dispriceInsert:dispriceInsert,
			imgUrl:imgUrl
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
					alert("Trùng ID");
				}				
			}
		});
	});
	$('#searchString').on('keyup',function(){
		matchTest();
	});
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

