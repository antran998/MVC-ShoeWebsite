$(document).ready(function(){
    // sign up button for sign up account
    $('.Registry').on('click',function(e){
        e.preventDefault();

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
            hidden_container.style.display='none';
            theLoader.style.display='block';

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
                    if(response==1){
                        setTimeout(function(){
                            localStorage.setItem('confirmText','Chúc mừng bạn đã đăng kí thành công');
                            window.location.href = 'mailcheck';
                        },2000);
                    }
                    else{
                        alert('Username đã được đăng ký!!!');
                        window.location.href = 'addUser';
                    }
                }
            });
        }
        else{
            alert("Bạn nhập sai thông tin");
        }
    
    });

    // allow to press enter in order to signin
    $('#inputPassword').on('keydown',function(e){
        if(e.keyCode == 13){
            e.preventDefault();
            $('.btn.btn-success.btn-block').click();        
        }
    });

    // heading to home page
    $('.home').on('click',function(){
        window.location.href="home";
    });

    // send mail to receive password button
    $('.Reset').on('click',function(e){
        e.preventDefault();
        hidden_container.style.display="none";
        theLoader.style.display="block"
        var resetEmail = $('#resetEmail').val();
        var usernameReset = $('#usernameReset').val();
        var pattern={
            resetEmail:resetEmail,
            usernameReset:usernameReset
        }
        
        $.ajax({
            url:'Routes.php',
            method:'POST',
            data: {pattern:JSON.stringify(pattern)},
            success:function(response){
                 if(response==1){
                    localStorage.setItem('confirmText','Chúng tôi đã gửi email đến bạn, hãy check');
                    window.location.href="mailcheck";
                 }else{
                    alert("Nhập sai thông tin ");
                    window.location.reload();
                 }
            }
        });
        
    });

});
