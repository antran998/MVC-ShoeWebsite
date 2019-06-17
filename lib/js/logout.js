var logoutButtonCheck = document.getElementById('logout');
if(logoutButtonCheck){
	logout.addEventListener("click", function(){ 
		localStorage.clear();
	});
}

