function showChatBox(username,condReset){
  (function(s, u, b, i, z){
    u[i]=u[i]||function(){
      u[i].t=+new Date();
      (u[i].q=u[i].q||[]).push(arguments);
    };
    z=s.createElement('script');
    var zz=s.getElementsByTagName('script')[0];
    z.async=1; z.src=b; z.id='subiz-script';
    zz.parentNode.insertBefore(z,zz);
  })(document, window, 'https://widgetv4.subiz.com/static/js/app.js', 'subiz');
  subiz('setAccount', 'acqjefvcxfaxgfmgmjrk');

  // reset subiz user when log out
  if(username!='Guest'){
    logout.addEventListener("click",function(e){
      // xóa username tại client
      subiz('forgetMe');
    });
  }

  // reset subiz user when sign in
  if(condReset==0){
    // xóa username tại client
    subiz('forgetMe');
  }

  //thêm username mới
  subiz('updateUserAttributes', [{ key:'fullname',   text: username }]);  
}

