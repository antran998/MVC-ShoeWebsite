<?php  

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'PaypalTest/app/start.php';

if(!isset($_SESSION['pattern'])){
	die();
}

$moneyConvert = 0.86/20000;

for ($j=0; $j < count($_SESSION['pattern']->list); $j++) {
	$product[$j] = $_SESSION['pattern']->list[$j]->name;
	$price[$j] = $_SESSION['pattern']->list[$j]->prices*$moneyConvert;	
}


$shipping = $_SESSION['pattern']->shipFee*$moneyConvert;

$total=0;
$subtotal=0;

for ($j=0; $j < count($_SESSION['pattern']->list); $j++) {
	$total += $price[$j];
	$subtotal += $price[$j];
}

// voucher setting
$voucher = (string)($_SESSION['pattern']->voucherPercent*100);
$voucherTotal = ($_SESSION['pattern']->voucherPercent*$subtotal);

$subtotal -=$voucherTotal;
$total +=$shipping-$voucherTotal;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

for ($j=0; $j < count($_SESSION['pattern']->list); $j++) {
	$item[$j] = new Item();
	$item[$j]->setName($product[$j])->setCurrency('USD')->setQuantity($_SESSION['pattern']->list[$j]->quantity)->setPrice($price[$j]);

	//Set voucher
	if($j==count($_SESSION['pattern']->list)-1){
		$item[$j+1] = new Item();
		$item[$j+1]->setName('Discount: -'.$voucher.'%')->setCurrency('USD')->setQuantity(1)->setPrice("-".(string)$voucherTotal);
	}
}


$itemList = new ItemList();
$itemList->setItems($item);

$details = new Details();
$details->setShipping($shipping)->setSubtotal($subtotal);

$amount = new Amount();
$amount->setCurrency('USD')->setTotal($total)->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)->setItemList($itemList)->setDescription('Đơn hàng của bạn')->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . '/pay?success=true')->setCancelUrl(SITE_URL . '/pay?success=false');

$payment = new Payment();
$payment->setIntent('sale')->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions([$transaction]);

try {
	$payment->create($paypal);
} catch(Exception $e){
	die($e);
}

echo $approvalUrl = $payment->getApprovalLink();
header("Location:{$approvalUrl}");

