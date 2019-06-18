var allProduct;
var index=0;

var cart = [];
var list=[];
list = localStorage.getItem('shoppingCart');   
list=JSON.parse(list);

shipFee=localStorage.getItem('shipFee');

var cartTotalPrice = 0;
var totalPrice = localStorage.getItem('totalPrice');
totalPrice = JSON.parse(totalPrice);

var voucherPrice=0;
var voucherPercent=0;

// add to cart when buying stuff
function addCart(){
    $(function(){

        if(list!=null){
            cart=[...list];
        }
        if (totalPrice != null) {
            cartTotalPrice = parseFloat(totalPrice);
        }
        
        // add to cart when click
        var proId,productName,image,priceSale;
        $('.add_to_cart_button, .add-to-cart-link').on('click',function(){
            console.log($(this).attr('data-product_id'));

            proId = $(this).attr('data-product_id');
            
            productName=$('#pro-'+proId).find('#productName').text();//////// An's Fixed 1
            image=$('#pro-'+proId).find('#img_pro').attr('src');
            priceSale = $('#pro-'+proId).find('#price1').text();
            
            priceSale=priceSale.substring(0, priceSale.length-1);//////////////////// An's Fixed substring  
            Processing();
        });

        // add to cart when drag drop
        cart_status.addEventListener("mouseenter", function(){
            if(conditionOnDrag==1){
                proId = indexOnDrag;
            
                productName=$('#pro-'+proId).find('#productName').text();//////// An's Fixed 1
                image=$('#pro-'+proId).find('#img_pro').attr('src');
                priceSale = $('#pro-'+proId).find('#price1').text();

                conditionOnDrag=0;
                Processing();                
            }
        });       

        // proccessing add to cart
        function Processing(){               
            updateCart(priceSale);

            priceSale=parseFloat(priceSale.replace(/\./g,""));
            cartTotalPrice = cartTotalPrice + priceSale;

            var obj ={
                id:proId,
                name:productName,
                imgUrl:image,
                prices:priceSale,      
            };   

            //flag to check if item's already in cart
            var flag=false;
            for(var i=0;i<cart.length;i++){
                if(cart[i].id==obj.id){
                    flag = true;
                    break;
                }
            }

            if(flag===false){
                //item is not in cart
                obj.quantity=1;
                
                cart.push(obj);               
            }
            else{
                //item is in cart
                cart[i].quantity+=1;
            }             

            console.log(cart);            
            saveCart();
        }

    });
    
    function saveCart(){
        localStorage.setItem("shoppingCart",JSON.stringify(cart));
        localStorage.setItem("totalPrice", JSON.stringify(cartTotalPrice));        
    }    

}
function clearCart(){
    localStorage.clear();
}


function drawCart(){
    if(list!=undefined){
        coupon_code.value=localStorage.getItem('Voucher');

        for(var i =0;i<list.length;i++){        
            var ckUnit=`
            
            <tr class="cart_item">
            <td class="product-remove">
            <a title="Remove this item" class="remove" href="#" onclick="removeUnitItem(${i})">×</a> 
            </td>
            <td class="product-thumbnail">
            <a href="single-product.php"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="${list[i].imgUrl}"></a>
            </td>
            <td class="product-name">
            <a href="single-product.php">${list[i].name}</a> 
            </td>
            <td class="product-price">
            <span class="amount" id="proPriceDisplay">${numberWithDots(list[i].prices)}đ</span> 
            </td>
            <td class="product-quantity">
            <div class="quantity buttons_added">
            <input type="button" class="minus" value="-" pro-id="${i}">            
            <input id="qtyDisplay" size="1" disabled class="input-text qty text resize" title="Qty" value="${list[i].quantity}" min="0">
            <input type="button" class="plus" value="+" pro-id="${i}">
            </div>
            </td>
            <td class="product-subtotal">
            <span id="totalDisplay" class="amount">${numberWithDots(list[i].quantity*list[i].prices)}đ</span> 
            </td>
            </tr>
            `;
            if(list[i].quantity==0){
                removeUnitItem(i);
            }

            $("#cartTable").append(ckUnit);
            $(".cart_item").insertBefore("#check");
            $(".cart_totals ").find(".amount#proTotal").text(numberWithDots(totalPrice)+"đ");        
            if(shipFee==null){
                shipFee=0;
            }
            $(".cart_totals ").find("#shipFee").text(numberWithDots(shipFee)+"đ");
            var  lastPrice = parseFloat(totalPrice)+parseFloat(shipFee);
            $(".cart_totals ").find(".amount#totalPrice").text(numberWithDots(lastPrice)+"đ");
        }
    }
    // increase quantity of item on click "plus" button
    $('input.plus').on('click', function () {
        var id = $(this).attr('pro-id');
        list[id].quantity += 1;
        totalPrice+=list[id].prices;
        localStorage.setItem("shoppingCart", JSON.stringify(list));
        localStorage.setItem("totalPrice", JSON.stringify(totalPrice));

        qtyDisplay.value = list[id].quantity;
        totalDisplay.innerHTML=numberWithDots(totalPrice)+"đ";
        updateCart(list[id].prices.toString());

        $(".cart-subtotal ").find(".amount").text(numberWithDots(totalPrice)+"đ");
        var  lastPrice = parseFloat(totalPrice)+parseFloat(shipFee);
        $(".cart_totals ").find(".amount#totalPrice").text(numberWithDots(lastPrice)+"đ");
    });


    // increase quantity of item on click "minus" button
    $('input.minus').on('click', function () {
        var id = $(this).attr('pro-id');
        list[id].quantity -= 1;
        totalPrice-=list[id].prices;
        localStorage.setItem("shoppingCart", JSON.stringify(list));
        localStorage.setItem("totalPrice", JSON.stringify(totalPrice));
        
        qtyDisplay.value = list[id].quantity;
        totalDisplay.innerHTML=numberWithDots(totalPrice)+"đ";
        updateCart("-"+list[id].prices.toString());

        $(".cart-subtotal ").find(".amount").text(numberWithDots(totalPrice)+"đ");
        var  lastPrice = parseFloat(totalPrice)+parseFloat(shipFee);
        $(".cart_totals ").find(".amount#totalPrice").text(numberWithDots(lastPrice)+"đ");

        if(qtyDisplay.value==0){
            removeUnitItem(id)
        }
    });

    // apply voucher
    apply_coupon.addEventListener("click", function(e){
      e.preventDefault();
      if(totalPrice>0){
        if(coupon_code.value==localStorage.getItem('Voucher')){
            voucherPercent=localStorage.getItem('Voucher');
            voucherPercent=parseFloat(voucherPercent.substring(voucherPercent.length-2,voucherPercent.length-1));
            voucherPercent=voucherPercent/10;
            voucherPrice=(totalPrice-voucherPercent*totalPrice);
            $(".cart_totals ").find(".amount#totalPrice").text(numberWithDots(voucherPrice+parseFloat(shipFee))+"đ");
            coupon_code.disabled = true;
            alert("Áp dụng giảm "+voucherPercent*100+"%");
        }
        else{
            alert("Mã khuyến mãi không tồn tại");
        }        
      }
      else{
        alert("Vui lòng mua hàng");
      }
    });

    // check if shipping fee is add
    checkout_button.addEventListener("click", function(e){
        e.preventDefault();
        localStorage.setItem('shipFee',shipFee);
        localStorage.setItem('voucher',voucherPercent);
        if(shipFee==0){
            if(totalPrice>0){
                alert("Vui lòng chọn khu vực giao hàng");
            }     
            else{
                alert("Vui lòng mua hàng");
            }               
        }
        else{
            window.location ="checkout";
        }
    });
}

//display customer order in checkout.php
if(totalPrice!=null){
    $(".cart-subtotal ").find(".amount").text(numberWithDots(totalPrice)+"đ");
}
else{
    totalPrice = 0;
}
if (shipFee == null) {
    shipFee = 0;
}
if(localStorage.getItem('voucher')!=null){
    voucherPercent=localStorage.getItem('voucher');
}

$(".shipping").find("#shipFee").text(numberWithDots(shipFee)+"đ");
$(".voucher").find(".amount").text(numberWithDots(voucherPercent*100)+"%");
var TotalMoney=parseFloat(shipFee)+parseFloat(totalPrice-totalPrice*voucherPercent);
$(".order-total").find(".amount").text(numberWithDots(TotalMoney)+"đ");

// Shipping calculator
$("button[name='calc_shipping']").click(function(e) {
    e.preventDefault();
    if(totalPrice>0){
        var shipArea = document.getElementById('calc_shipping_country');
        switch(shipArea.value){
            case "MN":
                shipFee=50000;
                break;
            case "MT":
                shipFee=100000;
                break;    
            case "MB":
                shipFee=150000;
                break;
        }
        if(shipFee>0){            
            $(".cart_totals ").find("#shipFee").text(numberWithDots(shipFee)+"đ");
            if(voucherPrice>0){
                var lastPrice = parseFloat(voucherPrice)+parseFloat(shipFee);
                $(".cart_totals ").find(".amount#totalPrice").text(numberWithDots(lastPrice)+"đ");
            }
            else{
                var lastPrice = parseFloat(totalPrice)+parseFloat(shipFee);
                $(".cart_totals ").find(".amount#totalPrice").text(numberWithDots(lastPrice)+"đ");
            }            
        }
    }
    else{
        alert("Vui lòng mua hàng");
    }

});

// "X" remove item
function removeUnitItem(id){

    totalPrice-=(list[id].prices*list[id].quantity);
    list.splice(id,1);
    localStorage.setItem("shoppingCart", JSON.stringify(list));
    localStorage.setItem("totalPrice", JSON.stringify(totalPrice));
    if(localStorage.getItem("totalPrice")==0){
        clearCart();
    }
    location.reload();
}

// format money type
function numberWithDots(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."); // \B not boundary \d{3} 3 digit /d 
}

function countProperties (obj) {
    let count1 = 0;

    for (var property in object) {
        if (Object.prototype.hasOwnProperty.call(obj, property)) {
            count1++;
        }
    }
    return count1;
}


// create id to url which is the id of item (on single product page)
var url = new URL(window.location.href);

var search_params = new URLSearchParams(url.search); 

// check if id is exist on url
if(search_params.has('id')) {
	var id = parseFloat(search_params.get('id'));

    // output : 100
    index=id;
}

// click signupaccount
function signUpClick() {
    localStorage.setItem('signup',1);
    window.open("addUser","_self");
}

















