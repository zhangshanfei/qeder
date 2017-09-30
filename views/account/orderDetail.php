<div class="main" id="main">
	<div class="container">
			<ol class="breadcrumb xs-margin0">
			   <li><a href="<?php echo \yii\helpers\Url::home()?>"><i class="icon-home"></i></a></li>
			    <li>User Center</li>
			</ol>	
			<div class="usercenter">
				<div class="row">
					<?php echo $this->render("_left");?>
			         <div class="col-main col-xs-12 col-sm-9">
	                <div class="account_box account">
						<div class="a_box">
							<div class="account_title">My Order.</div>
								<table class="table table-bordered table-hover">
									<thead>
									  <tr>
										<td class="text-left" colspan="2">Order Details</td>
									  </tr>
									</thead>
									<tbody>
									  <tr>
										<td class="text-left" style="width: 50%;">              <b>Order No:</b> <?php echo $order->orderid?><br>
										  <b>Date Added:</b> <?php echo date('Y-m-d',$order->createtime)?></td>
										<td class="text-left" style="width: 50%;">   <b>Payment Method:</b> PayPal Account pay<br>
													 <b>Shipping Method:</b> Free  Shipping           </td>
									  </tr>
									</tbody>
								</table>
								
								<table class="table table-bordered table-hover">
									<thead>
									    <tr>
											<td class="text-left" style="width: 50%; vertical-align: top;">Shipping Address</td>
									    </tr>
									</thead>
									<tbody>
									    <tr>
											<td class="text-left"><?php echo $address->firstname.' '. $address->lastname; ?><br><?php echo $address->address1?><br><?php echo $address->address2?><br><?php echo $address->city?><br><?php echo $address->province?><br><?php echo $address->country?></td>
										</tr>
									</tbody>
								 </table>
								 
								 <div class="table-responsive">
									<table class="table table-bordered table-hover">
									  <thead>
										<tr>
										  <td class="text-left">Product Name</td>
										  <td class="text-right">Quantity</td>
										  <td class="text-right">Price</td>
										  <td class="text-right">Total</td>
										 </tr>
									  </thead>
									  <tbody>
										<?php foreach($orderdetail as $pro):?>
										<tr>
										  <td class="text-left"><?php echo $pro->productname?></td>
										  <td class="text-right"><?php echo $pro->productnum?></td>
										  <td class="text-right">$<?php echo $pro->price?></td>
										  <td class="text-right">$<?php echo $pro->price * $pro->productnum?></td>
										</tr>
										<?php endforeach;?>
									  </tbody>
									  <tfoot>
										<tr>
										  <td colspan="2"></td>
										  <td class="text-right"><b>Sub-Total</b></td>
										  <td class="text-right">$<?php echo $order->amount?></td>
										</tr>
										<!--<tr>
										  <td colspan="2"></td>
										  <td class="text-right"><b>Flat Shipping Rate</b></td>
										  <td class="text-right">$0.00</td>
										 </tr>
										<tr>
										  <td colspan="2"></td>
										  <td class="text-right"><b>Total</b></td>
										  <td class="text-right">$106.00</td>
										</tr>-->
										<?php if(empty($order->tradeno)){?>
										<tr>
										  <td  colspan="5"  class="text-right"><a href="<?php echo \yii\helpers\Url::to(['payment/pay','orderid' => $order->orderid])?>" data-toggle="tooltip" title="" class="btn btn-primary " data-original-title="Reorder">COMPLETE PURCHASE</a</td>
										 </tr>
										<?php }?>
										</tfoot>
									</table>
								 </div>
						 </div>
					</div>
		        </div>
       			 </div>
			</div>
		</div>
</div>
