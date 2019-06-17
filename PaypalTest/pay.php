<?php  

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require 'PaypalTest/app/start.php';

if(!isset($_GET['success'], $_GET['paymentId'],$_GET['PayerID'])){
	$data = json_decode($e->getData());
		var_dump($data);
}

if ((bool)$_GET['success']===false){
	die();
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$payment = Payment::get($paymentId,$paypal);

$execute = new PayPal\Api\PaymentExecution();
$execute->setPayerId($payerId);

try {
	$result = $payment->execute($execute,$paypal);
} catch (Exception $e) {
	die($e);
}
$_SESSION['paymentSuccess']=1;