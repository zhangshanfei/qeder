<div class="main" id="main">
	<div class="container play_ment">
		<div class="col-sm-10 play_ment_title col-sm-offset-1"><i class="icon-credit-card"></i>Payment</div>
		<div class="play_box col-sm-10 col-sm-offset-1">
			<div class="ship_rightBox clearfix">
				<p class="ship_pro_title">Delivery method:Amazon shipping</p>
				<?php $subtotal = 0;?>
				<?php foreach($data as $product):?>
				<div class="play_ment_box clearfix">
					<div class="col-xs-4 col-sm-1 left_ship_pro"><img src="<?php echo $product->productcover?>"></div>
					<div class="col-xs-8 col-sm-11 right_ship_prosm">
						   <p class="p1_title"><?php echo $product->productname?></p>
							<p class="p1"><span class="span2">Quantity:<?php echo $product->productnum?></span></p>
							<p class="p3 text_right">$<?php echo $product->price?></p>								
					</div>
				</div>
				<?php $subtotal = $subtotal + $product->price * $product->productnum;?>
				<?php endforeach;?>
			</div>
			
			
		</div>
	   <div class="play_zj col-sm-4 col-sm-offset-4 clearfix">
	   	<ul class="clearfix">
	   		<li class="col-sm-6 col-xs-6">subtotal</li>
	   		<li class="col-sm-6 col-xs-6 text-right">$<?php echo $subtotal?></li>
	   		<li class="col-sm-6 col-xs-6">Shipping</li>
	   		<li class="col-sm-6 col-xs-6 text-right">$0.00</li>
	   	</ul>
	   	<ul class="clearfix ul2">
	   		<li class="col-sm-6 col-xs-6"><b>ToTal:</b></li>
	   		<li class="col-sm-6 col-xs-6 text-right"><b>$<?php echo $subtotal?></b></li>	   		
	   	</ul>
	   </div>
	   <div class="hr_line col-sm-10 col-sm-offset-1"></div>
	   <div class="col-sm-10 col-sm-offset-1">
	   	<p class="p1_title1">Payment method</p>
	   	<p class="p2_content">all transcheng are Delivery method:Amazon shipping</p>
	   	<div class="img_tubiao">
	   		<span><img src="../images/playment01.jpg" /></span>
	   		<span><img src="../images/playment02.jpg" /></span>
	   		<span><img src="../images/playment03.jpg" /></span>
	   		<span><img src="../images/playment04.jpg" /></span>
	   	</div>
	   	<p class="p3_content">you will retrue to paypad to Delivery method<br/> you etrue to paypad to Delivery</p>
		<form action = "<?php echo yii\helpers\Url::to(['payment/pay'])?>" method = "post">
		 <input type="hidden" name="orderid" value="<?php echo $orderid?>">
	     	 <button class="info_btn play_btn col-sm-4"><span>subtotal: $<?php echo $subtotal?></span><span class="suline">|</span>PLAY WITH PAYPAL</button>
		</form>
	   </div>
	</div>
</div>
