<?php  
class Route{
	// match route and call route
	public static function set($route,$function){
		if($_GET['url']==$route){
			$function->__invoke();
		}	
	}

	// call function in function
	public static function getRequest($function){
		$function->__invoke();
	}
}


?>