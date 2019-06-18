$(document).ready(function(){
	// auto click to show success alert
	$('#alertsuccess').click();
	$('.btn-block').click(function(){   
		window.location.href = 'home';
	});
});

function loadConfirmText(){
	if(confirmText.innerHTML==''){
		confirmText.innerHTML=localStorage.getItem('confirmText');
		localStorage.removeItem('confirmText');
	}
}

