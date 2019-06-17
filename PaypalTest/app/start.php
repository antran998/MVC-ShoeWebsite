<?php  

require 'PaypalTest/vendor/autoload.php';

if("$_SERVER[HTTP_HOST]"=='localhost'){
	define('SITE_URL', 'http://localhost/WebPHPMvc');
}
else{
	define('SITE_URL', "https://$_SERVER[HTTP_HOST]");
}

$paypal = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential('AemtxqQxHzGm1bMbfvjxufOD9Z4to7h8ux7fGsr5vGqiRTmOyTaboVHG_7G0XEVqGXHLZUi75hekCysM','ED4-02fEsjrOJGw6hSYz-mOcJLXD9XVYkAIpJBLV2XiM8wQ5vJFXDCt1uZ6pqkBQuvbc_3gJeK1X5xAx'
	)
);