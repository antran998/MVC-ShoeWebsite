$(document).ready(function(){
    $('.Registry').on('click',function(e){

        var countCheck=6;
        for(var i=0;i<7;i++){
            var tempCheck = document.getElementById('check'+i);
            if(tempCheck.innerHTML!='<i class="fa fa-check" aria-hidden="true"></i>'){
                e.preventDefault();
                countCheck--;
                tempCheck.innerHTML= 'X';
                tempCheck.style.color = 'Red';
            }           
        }
        if(countCheck==6){
            var usernameRegistry=$('#user_name').val();
            var passwordRegistry=$('#user_pass').val();
            var repeatpassRegistry=$('#user_repeatpass').val();
            var fullnameRegistry=$('#fullname').val();
            var emailRegistry=$('#email').val();
            var addressRegistry=$('#address').val();
            var phoneRegistry=$('#phone').val();
            if(passwordRegistry==repeatpassRegistry){
                var pattern={
                    usernameRegistry:usernameRegistry,
                    passwordRegistry:passwordRegistry,
                    fullnameRegistry:fullnameRegistry,
                    emailRegistry:emailRegistry,
                    addressRegistry:addressRegistry,
                    phoneRegistry:phoneRegistry
                }
            }

            $.ajax({
                url:'Routes.php',
                method:'POST',
                data: {pattern:JSON.stringify(pattern)},
                success:function(response){

                }
            });
        }
        else{
            alert("Bạn nhập sai thông tin");
        }
    
    });

    $('#inputPassword').on('keydown',function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            $('.btn.btn-success.btn-block').click();        
        }
    });

    $('.home').on('click',function(){
        window.location.href="home";
    });

});
