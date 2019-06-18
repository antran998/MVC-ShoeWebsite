var count=0,sum;
if(list==null){
  count=0;
  sum=0;
}
else{
  for(var i=0;i<list.length;i++){
    count+=list[i].quantity;
  }
  sum=parseFloat(localStorage.getItem('totalPrice'));
}

count_pro.textContent= count.toString(); 
cart_price.textContent=" "+numberWithDots(sum)+"đ";
var indexOnDrag;
var conditionOnDrag=0;

function updateCart(proPrice){
	var currPrice = $(cart_price).html();
	currPrice=currPrice.replace(/\./g,"");// find and replace dot in price string
	currPrice=parseFloat(currPrice.substring(0,currPrice.length-1));

	proPrice=parseFloat(proPrice.replace(/\./g,""));

  if(proPrice>=0){
    count++;
  }
  else{
    count--;
  }	
   	
	sum+= proPrice; // regex
	count_pro.textContent= count.toString(); 
	cart_price.textContent=" "+numberWithDots(sum)+"đ";
}


function drag(ev) {
  ev.dataTransfer.setData("url",ev.target.src);
}


function allowDrop(ev) {
  ev.preventDefault();
}

function drop(ev) {
  ev.preventDefault();
  var data = ev.dataTransfer.getData("url");
  var targetChar2=data.indexOf(".png");
  var targetChar1=data.indexOf("img/");

  data=data.substring(targetChar1+4,targetChar2); // extract string to get index
  indexOnDrag=data;
  conditionOnDrag=1;
}











