$(document).ready(function(){
	$('.search-bar').keyup(function(){          
		matchTest();
	});
});


function matchTest(){
	var textFromBar = document.getElementById("search-bar").value;
    var spaceIndex;
    if(textFromBar.indexOf(" ")==-1){
        spaceIndex=textFromBar.length;
    }
    else{
        spaceIndex=textFromBar.indexOf(" ");
    }
    var firstPattern="(?=.*"+textFromBar.substring(0,spaceIndex)+")";
    var regexPatt = firstPattern;

    // create regex rule
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
        url: "Routes.php",
        method: "post",
        dataType: "json",
        data: {regexPatt},
        success: function(respone){
            console.log(respone);
            drawItemsWhenSearch(respone);                     
        }
    });    
}

function drawItemsWhenSearch(arrayFoundItem){
    $('#listItems').empty();
    for(var j=arrayFoundItem.length-1;j>=0;j--){
        var ckUnit = `
        <div class="col-md-3 col-sm-6">
            <div class="single-shop-product" id="pro-${arrayFoundItem[j]['idProduct']}">

                <div class="product-upper" id="test">
                    <img src="lib/${arrayFoundItem[j]['imgItem']}" alt="" id="img_pro" draggable="true" ondragstart="drag(event)">
                </div>
                <h2 id="productName"><a href="single-product?id=${arrayFoundItem[j]['idProduct']}">${arrayFoundItem[j]['nameProduct']}</a></h2>
                <div class="product-carousel-price">
                    <ins id="price1">${numberWithDots(arrayFoundItem[j]['discountPrice'])}đ</ins> <del>${numberWithDots(arrayFoundItem[j]['price'])}đ</del>
                </div>  

                <div class="product-option-shop">
                    <a class="add_to_cart_button" id="add_cart" data-quantity="1" data-product_sku="" data-product_id="${arrayFoundItem[j]['idProduct']}" rel="nofollow">Thêm vào giỏ</a>
                </div>                       
            </div>
        </div>
        `;     

        var draw = $("#listItems").append(ckUnit);
                    
    }
    addCart();
}

document.getElementById("search-button").addEventListener("click",function(){
    localStorage.setItem("searchString",JSON.stringify(document.getElementById("search-bar").value));
    document.getElementById("search-bar").value="";    
});

// search outsite of shop page
if(localStorage.getItem('searchString')!= undefined){
    var x = localStorage.getItem('searchString');
    x=x.replace(/"/g,""); // Bỏ ký tự ngoặc
    document.getElementById("search-bar").value=x;
    localStorage.removeItem('searchString');
    var animation = setInterval(function(){
        matchTest();
        clearInterval(animation);
    },80);    
}

// Type of shoe when click in the footer menu
function typeOfShoe(id){
    var getText=id;
    localStorage.setItem("searchString",JSON.stringify(getText));
    document.getElementById("search-bar").value="";    
}




