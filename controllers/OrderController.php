<?php
namespace app\controllers;
require __DIR__.'/../vendor/autoload.php';
use app\controllers\BaseController;
use app\models\Order;
use app\models\Cart;
use app\models\Address;
use app\models\Product;
use app\models\OrderDetail;
use Yii;
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


class OrderController extends BaseController
{
	public $enableCsrfValidation = false;
	
	public function actionAdd()
	{
		try{
			if(Yii::$app->request->isPost){
				$transaction = Yii::$app->db->beginTransaction();
				$userid = Yii::$app->user->id;
				$data = [];
				$orderid = '';

				$cart = Cart::find()->where('userid = :id ',[':id' => $userid])->asArray()->all();
				$amount = Yii::$app->request->post("subtotal");
				$address = Address::find()->where('userid = :id ',[':id' => $userid])->one();
				if(!$address){
					Yii::$app->session->setFlash('address_error_info','Please enter your shipping address!');
					return $this->redirect('../cart/process');
				}
				//$paymentid = Yii::$app->request->get("paymentId");
				$ordermodel = new Order();
				//$ordermodel->scenario = 'add';
				$ordermodel->userid = $userid;
				$ordermodel->amount = $amount;
				//$ordermodel->tradeno = $paymentid;
				$ordermodel->status = Order::CHECKORDER;
				$ordermodel->addressid = $address->addressid;
				$ordermodel->createtime = time();
				//var_dump($ordermodel->save());exit;
				if(!$ordermodel->save()){
					throw new \Exception();
				}
				$orderid = $ordermodel->getPrimaryKey();
			//	var_dump($cart);exit;
				foreach($cart as $product){
					$model = new OrderDetail;
					$model->orderid = $orderid;
					$model->productid = $product['productid'];
					$model->productname = $product['productname'];
					$model->productcover = $product['productcover'];
					$model->price = $product['price'];
					$model->productnum = $product['productnum'];
					$model->createtime = time();
					$data[] = $model;
					//var_dump($model);exit;
					//var_dump($model->save());exit;
					if(!$model->save()){
						throw new \Exception();
					}
					Cart::deleteAll('productid = :pid',[':pid' => $product['productid']]);
					Product::updateAll(['num' => -$product['productnum']],'productid = :pid',[':pid' => $product['productid']]);

				}
				
				$transaction->commit();
			}else{
				return $this->redirect(['account/order']);
			}
		}catch(\Exception $e){
			$transaction->rollback();
		}
		Yii::$app->session['orderid'] = $orderid;
		return $this->render("payment",['data' => $data,'orderid' => $orderid]);
	}


	public function actionPay()
	{
		 $apiContext = new ApiContext(
                        new OAuthTokenCredential(
                            'AepxeWbBQqMDJ_M0GlOreED3TOftHIpC8kjMSRa8mNErC8K4AeZEjzQRZ8TxV0XP52-sodzmE_tUq8O-',     // ClientID
                            'ENgQY_tNeZjFniZ0nv65nbwz_FCo9LYB70CM8O4DDgk9lX3EXbWUsHgjdCKlfbT-EfIQehVZsO072Iir'      // ClientSecret
                        )
                );

                $apiContext->setConfig([
                        'mode' => 'sandbox',
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

                $item1 = new Item();
                $item1->setName('Ground Coffee 40 oz')
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice(7.5);
                $item2 = new Item();
                $item2->setName('Granola bars')
                    ->setCurrency('USD')
                    ->setQuantity(5)
                    ->setPrice(2);

                $itemList = new ItemList();
                $itemList->setItems(array($item1, $item2));

                $details->setShipping('2.00')
                        ->setTax('0.00')
                        ->setSubtotal('17.5');

                $amount->setCurrency('USD')
                        ->setTotal('19.5')
                        ->setDetails($details);

                $transaction->setAmount($amount)
                        ->setItemList($itemList)
                        ->setDescription('Payment description');
		
		$payment->setIntent('sale')
                        ->setPayer($payer)
                        ->setTransactions([$transaction]);

                $redirectUrls->setReturnUrl(Yii::$app->urlManager->createAbsoluteUrl(['pay/success']))
                        ->setCancelUrl(Yii::$app->urlManager->createAbsoluteUrl(['pay/cancel']));

                $payment->setRedirectUrls($redirectUrls);

                try{
                        $payment->create($apiContext);


                }catch(PPConnectionException $e){

                }
                $approvalUrl = $payment->getApprovalLink();
                $this->redirect($approvalUrl);
	} 

}
