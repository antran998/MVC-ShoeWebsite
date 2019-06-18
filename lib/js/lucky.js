var countSpin = 0;
var condSpin =0;
var loop;

function spinCircle(){
    if(condSpin==0){
      loop = setInterval(function(){
        countSpin+=10;// speed of lucky circle
              
        myDiv.style.transform = "rotate("+countSpin+"deg)"; // rotate the wheel
        
        if(countSpin>=360){
          countSpin=0;
        }
      },0);
      condSpin=1;
    }
    else{
      clearInterval(loop);
      
      var showPrice = setTimeout(function(){
        myStop.style.display = 'none';
        myDiv.style.display = 'none';
        adver.style.display = 'block';

        // get specific angle and return value voucher
        if (countSpin<=44) {codeVoucher.innerHTML+="50"}
        if (countSpin>44 && countSpin<=90) {codeVoucher.innerHTML+="20"}
        if (countSpin>90 && countSpin<=134) {codeVoucher.innerHTML+="30"}
        if (countSpin>134 && countSpin<=180) {codeVoucher.innerHTML+="10"}
        if (countSpin>180 && countSpin<=225.5) {codeVoucher.innerHTML+="50"}
        if (countSpin>225.5 && countSpin<=269) {codeVoucher.innerHTML+="20"}
        if (countSpin>269 && countSpin<=315.5) {codeVoucher.innerHTML+="30"}
        if (countSpin>315.5 && countSpin<=359.5) {codeVoucher.innerHTML+="10"}
        localStorage.setItem("Voucher",codeVoucher.innerHTML); 
      },1800);
    }     
    
}
