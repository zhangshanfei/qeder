<?php
namespace app\controllers;

require __DIR__.'/../vendor/autoload.php';
use app\controllers\BaseController;
use app\models\OrderDetail;
use app\models\Order;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Exception\PayPalConnectionException;
use Yii;

class PaymentController extends BaseController
{
	public $enableCsrfValidation = false;
	protected $except = ['index'];
	public function actionPay()
	{


		$apiContext = new ApiContext(
			new OAuthTokenCredential(
			    'AdS5m2z2uhgrV1MnX1gguJ2VWTPq0zESrJYwZlAtAGk1b0MT-DYTnSg_WiVLQG4XSphnRl4VhFZdnre_',     // ClientID
			    'EBXrAxnt1o8Ul2EeqIwUuT56-A74YvJpYWYUwpAlFOCYrnoR2C5D1c4bEDgPWG3owmtcuVdQ6UwOCVyV'      // ClientSecret
			)
		);

		$apiContext->setConfig([
			'mode' => 'live',
			'log.LogEnabled' => false,
			'log.FileName' => '../PayPal.log',
			'log.LogLevel' => 'INFO',
			'cache.enabled' => false,
		]);

		$payer = new Payer();
		$details = new Details();
		$amount = new Amount();
		$transaction = new Transaction();
		$payment = new Payment();
		$redirectUrls = new RedirectUrls();
		$payinfo = new Payment();

		$payer->setPaymentMethod('paypal');
		$orderid = null;	
		if(\Yii::$app->request->isPost){
			$orderid = \Yii::$app->request->post("orderid");
		}	
		if(\Yii::$app->request->isGet){
			$orderid = \Yii::$app->request->get("orderid");
		}
		$products = OrderDetail::find()->where('orderid = :id',[':id' => $orderid])->asArray()->all();
		$item  = array();
		$items = array();
		$index = 0;
		$total = 0;
		foreach($products as $k=>$pro){
			$index++;
			$item[$index] = new Item();
			$item[$index]->setName($pro['productname'])
				->setCurrency('USD')
				->setQuantity($pro['productnum'])
				->setPrice($pro['price']);
			$items[] = $item[$index];
			$total = $total + $pro['productnum'] * $pro['price'];
		}
		$itemList = new ItemList();
		$itemList->setItems($items);

		$details->setShipping('0')
			->setTax('0')
			->setSubtotal($total);

		$amount->setCurrency('USD')
			->setTotal($total)
			->setDetails($details);

		$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription('Payment description')
			->setInvoiceNumber(uniqid());
			
		$payment->setIntent('sale')
			->setPayer($payer)
			->setTransactions([$transaction]);

		$redirectUrls->setReturnUrl(Yii::$app->urlManager->createAbsoluteUrl(['payment/success']))
			->setCancelUrl(Yii::$app->urlManager->createAbsoluteUrl(['cart/']));

		$payment->setRedirectUrls($redirectUrls);

		try{
			$payment->create($apiContext);
			
		}catch(PayPalConnectionException $e){
			 echo $e->getCode(); // Prints the Error Code
			 echo $e->getData(); // Prints the detailed error message 
			 die($ex);
		}
		$approvalUrl = $payment->getApprovalLink();
		$this->redirect($approvalUrl);
	}

	public function actionSuccess()
	{
		$paymentid = Yii::$app->request->get("paymentId");
		$orderid = Yii::$app->session['orderid'];	
		if(!empty($orderid)){
			Order::updateAll(['status' => Order::PAYSUCCESS,'tradeno' => $paymentid],'orderid = :id',[':id' => $orderid]);
		}
		return $this->render("success");
	}

}
