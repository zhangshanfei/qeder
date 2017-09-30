<?php
$this->title = "Promotion-Qedertek";
$css = <<<CSS
		.pro_display{position: relative;}
		.pos_off{width: 74px; height: 74px; background: url(images/off.png) no-repeat; color: #ffffff; position: absolute; top: -1px; right: -1px; padding-top: 5px;}
	        .pos_off span{display: block; height: 15px; line-height: 15px; text-indent: 25px;}
	        .ptextsm{margin-bottom: 0 !important;}
	        .codetxt{display: inline-block; margin-bottom: 10px; margin-top: 10px; font-size: 14px;}
	         .codetxt em{font-style: normal; font-family: simhei; font-size: 15px; font-weight: bold; letter-spacing: 1px; }
CSS;
$this->registerCss($css);
?>
<div class="main" id="main">
	<div class="product_banner">
		<img src="<?php echo \Yii::$app->homeUrl?>images/banner2.jpg" />
	</div>
	<div class="super"> <div class="super_title">
			<ul class="container clearfix">
				<li class="col-xs-4 col-sm-4 <?php if($page == 0){ echo 'active';}?>" id="giveaway">Free Giveaway</li>
				<li class="col-xs-4 col-sm-4 <?php if($page == 1){ echo 'active';}?>" id="sale">Clearance Sale</li>
				<li class="col-xs-4 col-sm-4 <?php if($page == 2){ echo 'active';}?>" id="deals">Amazon Deals</li>
			</ul>
		</div>
		<div class="container">
			<div class="super_nr nrshow">
				<div class="super_box">
					<p><b>Welcome to Qedertek 100-Round Giveaway!</b></p>
					<p>Qedertek are committed to providing consumers with valuable products. With your suggestions and constructive comments on our products, you can help us learn how to improve and do better in the future. Are you good at testing items and sharing your experience with others? If yes, we are glad to invite you enter our giveaway.</p>
				<a = href="https://www.facebook.com/qedertek" target="_blank"><img src="images/giveaway.jpg"></a>
				</div>

			</div>
			<div class="super_nr">
				<div class="super_box">
				<p>All products here are 70% OFF upon the original price. Offer is subject to availability. Hurry up to place your order.</p>
				</div>
				<div class="product_nr">
		   		 <ul class="clearfix row">
					<?php foreach($recPro as $pro):?>
					<li class="col-sm-6 col-md-3">
						<div class="pro_display">
							<?php if($pro['discount']){?>
							<div class="pos_off">
								<span><?php echo $pro['discount']?>%</span>
								<span>OFF</span>
							</div>
							<?php } ?>
							<a href="<?php echo $pro['amazon_url']?>">
								<div class="pro_imgBox"><img src="<?php echo $pro['cover']?>"></div>
								<p class="ptextsm"><?php echo $pro['title']?></p>
							</a>
							<?php if($pro['promotion_code']){?><span class="codetxt">Code: <em><?php echo $pro['promotion_code']?></em></span><?php } ?>
						</div>
					</li>
					<?php endforeach;?>
			    	</ul>		
				</div>
			</div>
			<div class="super_nr">
				<div class="super_box">
					<p>All deals here are within limited time. Please use the coupon code under each product to apply in your purchase on Amazon.</p>
				</div>
				<div class="product_nr">
		   		 <ul class="clearfix row">
					<?php foreach($salPro as $pro):?>
					<li class="col-sm-6 col-md-3">
						<div class="pro_display">
							<?php if($pro['discount']){?>
							<div class="pos_off">
								<span><?php echo $pro['discount']?>%</span>
								<span>OFF</span>
							</div>
							<?php } ?>
							<a href="<?php echo $pro['amazon_url']?>">
								<div class="pro_imgBox"><img src="<?php echo $pro['cover']?>"></div>
								<p class="ptextsm"><?php echo $pro['title']?></p>
							</a>
							<?php if($pro['promotion_code']){?><span class="codetxt">Code: <em><?php echo $pro['promotion_code']?></em></span><?php } ?>
						</div>
					</li>
					<?php endforeach;?>

				</ul>		
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$js = <<<JS
	$(".super_nr").eq($page).addClass("nrshow").siblings(".super_nr").removeClass("nrshow");
JS;
$this->registerJs($js);
?>

