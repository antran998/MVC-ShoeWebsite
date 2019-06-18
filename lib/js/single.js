var condColorChange = [];

// star shine when hover in comment area
function creatStarHover(){
    for(var j = 1;j<6;j++){
        condColorChange[j]=0;
    }
    $( document ).ready(function() {
        $(".star1").hover(function(){
            $(".star1").css("color", "yellow");
        }, function(){
            if(condColorChange[1]==0){
                $(".star1").css("color", "");
            }
        });

        $(".star2").hover(function(){
            for(var k=1;k<=2;k++){  
                $(".star"+k).css("color", "yellow");
            }
        }, function(){
            for(var k=1;k<=2;k++){
                if(condColorChange[k]==0){
                $(".star"+k).css("color", "");
                }
            }
        });

        $(".star3").hover(function(){
            for(var k=1;k<=3;k++){  
                $(".star"+k).css("color", "yellow");
            }
        }, function(){
            for(var k=1;k<=3;k++){
                if(condColorChange[k]==0){
                $(".star"+k).css("color", "");
                }
            }
        });

        $(".star4").hover(function(){
            for(var k=1;k<=4;k++){  
                $(".star"+k).css("color", "yellow");
            }
        }, function(){
            for(var k=1;k<=4;k++){
                if(condColorChange[k]==0){
                $(".star"+k).css("color", "");
                }
            }
        });

        $(".star5").hover(function(){
            for(var k=1;k<=5;k++){  
                $(".star"+k).css("color", "yellow");
            }
        }, function(){
            for(var k=1;k<=5;k++){
                if(condColorChange[k]==0){
                $(".star"+k).css("color", "");
                }
            }
        });

        
    });
}
function rateStar(index){
    for(var k=1;k<=index;k++){
        condColorChange[k]=1;
    }
    for(var k=index+1;k<6;k++){
        $(".star"+k).css("color", "");
        condColorChange[k]=0;
    }
}

function loadCmtButt(){
    cmtButton.addEventListener("click",function(e){
        e.preventDefault();

        var countStar=0;
        var idItem = $(".add_to_cart_button").attr("data-product_id");
        for(var i=1;i<6;i++){
            if(condColorChange[i]==1){
                countStar++;
            }
        }

        if(countStar==0){
            alert("Vui lòng đánh giá số sao");
            return ;
        }

        var pattern = {
            star:countStar,
            mess:yourComment.value,
            idItem: idItem
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
    })
}