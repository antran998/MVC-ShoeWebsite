var allProduct;
var index=0;
//Biến previousCart Lưu danh sách cartItem đã lưu trước đó
//var previousCart = [];
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

function addCart(){
    $(function(){

        if(list!=null){
            cart=[...list];
        }
        if (totalPrice != null) {
            cartTotalPrice = parseFloat(totalPrice);
        }
        
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

        cart_status.addEventListener("mouseenter", function(){
            if(conditionOnDrag==1){
                proId = indexOnDrag;
            
                productName=$('#pro-'+proId).find('#productName').text();//////// An's Fixed 1
                image=$('#pro-'+proId).find('#img_pro').attr('src');
                priceSale = $('#pro-'+proId).find('#price1').text();

                // productName = allProduct[indexOnDrag].name;
                // image = allProduct[indexOnDrag].imgUrl;
                // priceSale = allProduct[indexOnDrag].price;
                conditionOnDrag=0;
                Processing();                
            }
        });       


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

            //flag dùng để check sản phẩm có trong cart chưa?
            var flag=false;
            
            //check san pham co trong cart???
            for(var i=0;i<cart.length;i++){
                if(cart[i].id==obj.id){
                    flag = true;
                    break;
                }
            }
            //check sản phẩm đã có trong giỏ hàng chưa ??
            if(flag===false){
                //san pham chua co trong gio hang
                obj.quantity=1;
                
                cart.push(obj);               
            }
            else{
                //san pham da co trong gio hang
                cart[i].quantity+=1;
            }             

            console.log(cart);            
            saveCart();
        }
        $('#place_order').on('click',function(){
            clearCart();
        });
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
        alert(coupon_code.value);
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
    //tang quantity san pham sau moi lan nhan vao luu vao localstorage
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


    //giam quantity san pham sau moi lan nhan vao luu vao localstorage
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

    // Áp dụng voucher
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

    // Nút thanh toán
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
            // localStorage.removeItem('shipFee');
            // localStorage.removeItem('voucher');
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

// Nút tính phí ship
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

// Xử lý số tiền đúng định dạng
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


// tạo id cho từng sản phẩm single-product
var url = new URL(window.location.href);

var search_params = new URLSearchParams(url.search); 

// this will be true
if(search_params.has('id')) {
	var id = parseFloat(search_params.get('id'));

    // output : 100
    index=id;
}
function signUpClick() {
    localStorage.setItem('signup',1);
    window.open("addUser","_self");
}

// window.onbeforeunload = function (event) {
//     var message = 'Important: Please click on \'Save\' button to leave this page.';

//     if(voucherPrice>0){
//         event.returnValue = message;
//     }

//     if (typeof event == 'undefined') {
//         event = window.event;
//     }
//     // if (event) {
        
//     // }
//     return message;
// };















