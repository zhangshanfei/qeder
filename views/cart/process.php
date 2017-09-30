<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Alert;
?>
<div class="main" id="main">
	<div class="container">
		<div class="orderInfo clearfix">
			<div class="col-sm-7 address">
				<p class="info_title">
					<i class="icon-file-alt"></i>Shopping Cart
				</p>
				<p class="address_title">Shipping address</p>
				<?php 
					if (Yii::$app->session->hasFlash('address_error_info')) {
								echo  Alert::widget([
									'options' => [
										'class' => 'alert-danger',
									],
									'body' =>  Yii::$app->session->getFlash('address_error_info'),
								]);
					}
					if (Yii::$app->session->hasFlash('address_success_info')) {
								echo  Alert::widget([
									'options' => [
										'class' => 'alert-success',
									],
									'body' =>  Yii::$app->session->getFlash('address_success_info'),
								]);
					}
					$form = ActiveForm::begin([
					'fieldConfig' => [
						'template' => '{input}{error}',
					],	
					'action' => ['cart/address'],
				])?> 
				<div class="address_box clearfix">
					<div class="input_con col-sm-6">
						<div class="input_info">
							<p>First name<span class="colorRed">*</span></p>
							<?php echo $form->field($model, 'firstname')->textInput(['class' => 'input-box']);?>
						</div>	
					</div>
					<div class="input_con col-sm-6">
						<div class="input_info">
							<p>Last name<span class="colorRed">*</span></p>
							<?php echo $form->field($model, 'lastname')->textInput(['class' => 'input-box']);?>
						</div>	
					</div>
					<div class="input_con col-sm-12">
						<div class="input_info">
							<p>Address line 1<span class="colorRed">*</span></p>
							<?php echo $form->field($model, 'address1')->textInput(['class' => 'input-box']);?>
						</div>	
					</div>
					<div class="input_con col-sm-12">
						<div class="input_info">
							<p>Address line 2</p>
							<?php echo $form->field($model, 'address2')->textInput(['class' => 'input-box']);?>
						</div>	
					</div>
					<div class="input_con col-sm-4">
						<div class="input_info">
							<p>Country*<span class="colorRed">*</span></p>
							<?php echo $form->field($model, 'country')->dropDownList(['1'=>'United States'],['class' => 'smll_select']);?>
						</div>	
					</div>
					<div class="input_con col-sm-4">
						<div class="input_info">
							<p>State<span class="colorRed">*</span></p>
							<?php echo $form->field($model, 'province')->textInput(['class' => 'input-box']);?>
						</div>	
					</div>
					<div class="input_con col-sm-4">
						<div class="input_info">
							<p>City<span class="colorRed">*</span></p>
							<?php echo $form->field($model, 'city')->textInput(['class' => 'input-box']);?>
						</div>	
					</div>
					<div class="input_con col-sm-6">
						<div class="input_info">
							<p>Phone number<span class="colorRed">*</span></p>
							<?php echo $form->field($model, 'telephone')->textInput(['class' => 'input-box']);?>
						</div>	
					</div>
					<div class="input_con col-sm-6">
						<div class="input_info">
							<p>Zip code<span class="colorRed">*</span></p>
							<?php echo $form->field($model, 'postalcode')->textInput(['class' => 'input-box']);?>
						</div>	
					</div>
					
				</div>
			    <div class="edit_address"><a href="javascirpt:;" class="colorBlue">EDIT</a></div>
			    <div class="edit_but clearfix col-sm-12 row" style="display:none">
  				    <?php echo Html::submitButton('SAVE', ['class' => 'edit_but1']); ?>
			    	<a id="cancel_edit"href="javascirpt:;" class="edit_but2">CANCEL</a>
			    </div>
				<?php ActiveForm::end()?>
			    <p class="address_title">Promotion Code</p>
			    <div class="apply clearfix">
				    <div class="col-xs-8 col-sm-9">
				    	<input class="form-control col-sm-9" type="text" placeholder="New Code" >
				    </div>
				    <div class="col-xs-4 col-sm-3">
				    	<button type="button" class="btn btn btn-info" >APPLY</button>
				    </div>
			    </div>
			</div>
			<div class="col-sm-5 ship_info">
				
				<div class="right_ship">
						<p class="ship_pro_title">Delivery Method:Amazon Shipping</p>
				<?php $total =0 ;?>
			  	<?php foreach($data as $product):?>	
					<div class="ship_rightBox clearfix">
						<div class="col-xs-4 col-sm-3 left_ship_pro"><a href="<?php echo yii\helpers\Url::to(['products/detail', 'productid' => $product['productid']])?>"><img src="<?php echo $product['cover']?>"></a></div>
						<div class="col-xs-8 col-sm-9 right_ship_prosm">						
								<p class="p1"><?php echo $product['title']?></p>
								<p class="p3">Quantity:<?php echo $product['productnum']?></p>
								<p class="p2 colorRed">$<?php echo $product['price']?></p>
						</div>
					</div>
				<?php $total = $total +  $product['price'] * $product['productnum'];?>
				<?php endforeach;?>
				</div>
				<!--<div class="right_ship2">
					<ul>
						<li><span class="fl">Subtotal:</span><span class="jiage">25.45</span></li>
						<li><span class="fl">Shipping: </span><span class="jiage">49.21</span></li>
						<li><span class="fl">Taxes: </span><span class="jiage">50.14</span></li>
						<li><span class="fl">Free Shipping   </span><span class="jiage">1552.00</span></li>
					</ul>
				</div>-->
				<div class="right_ship3">
					<span class="fl">Total:</span><span class="TotalJg">$<?php echo $total;?></span>
				</div>
			</div>			
		</div>
		<form action = "<?php echo yii\helpers\Url::to(['order/add'])?>" method = "post">
			<input type="hidden" name="subtotal" value="<?php echo $total?>">
			<button class="info_btn fr"><span>Subtotal: $<?php echo $total?></span><span class="suline">|</span>CONTINUE TO PAYMENT</a></button>
		</form>
	</div>
</div>
<?php
$url = yii\helpers\Url::to(['order/']);
$js = <<<JS
	$(function(){
		$(".input_info").click(function(){
			$(this).find(".input_box").focus();
		})
	
		$(".edit_address").click(function(){
			$(".edit_address").css('display','none');
			$(".edit_but").css('display','block');
		})
		$("#cancel_edit").click(function(){
			$(".edit_address").css('display','block');
			$(".edit_but").css('display','none');
		})
	})
JS;
$this->registerJs($js);
?>
