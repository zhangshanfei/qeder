<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;

require __DIR__ . '/vendor/autoload.php';

$apiContext = new ApiContext(
        new OAuthTokenCredential(
            'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS',     // ClientID
            'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL'      // ClientSecret
        )
);

$apiContext->setConfig([
	'mode' => 'sandbox',
	'http.ConnectionTimeOut' => 30,
	'log.LogEnabled' => false,
	'log.FileName' => '',
	'log.LogLevel' => 'FINE',
	'validation.level' => 'log'
]);

$payer = new Payer();
$details = new Details();
$amount = new Amount();
$transaction = new Transaction();
$payment = new Payment();
$redirectUrls = new RedirectUrls();

//$payer->setPayment_method('paypal');

$details->setShipping('2.00')
	->setTax('0.00')
	->setSubtotal('20.00');

$amount->setCurrency('USD')
	->setTotal('22.00')
	->setDetails($details);

$transaction->setAmount($amount)
	->setDescription('Membership');

$payment->setIntent('sale')
	->setPayer($payer)
	->setTransactions([$transaction]);

$redirectUrls->setReturnUrl('http://www.baidu.com')
	->setCancelUrl('http://www.baidu.com');

$payment->setRedirectUrls($redirectUrls);

try{
	$payment->create($apiContext);

	
}catch(PPConnectionException $e){

}
//var_dump($payment->getLinks());

