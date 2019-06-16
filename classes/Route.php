<?php  
class Route{
	public static $validRoutes = array(); 

	public static function set($route,$function){
		if($_GET['url']==$route){
			$function->__invoke();
		}	
	}

	public static function getRequest($function){
		$function->__invoke();
	}
}


?>