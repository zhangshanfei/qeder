<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;
?>
<div class="main" id="main" style="background:#fe9dcd">
        <div class="product_banner">
                <img src="<?php echo \Yii::$app->homeUrl?>/mothersday/images/lg-s.png" />
        </div>

                <div class="container">
                        <div class="product_nr row">
				<ul class="clearfix" style="padding:20px;">
					<li><h1>Congratulations,you have won free prize,</h1></li>
					<li>we will ship one of the follow products randomly to you. Please fill in your correct address to make sure you can receive the prize successfully.</li>
				</ul>
	
				<ul class="clearfix">
					<li class="col-sm-6 col-sm-4">
						<div class="pro_display">
								<div class="pro_imgBox"><img src="https://images-na.ssl-images-amazon.com/images/I/71KoN2vTPcL._SL1000_.jpg" /></div>
								<p class="ptextsm">Blossom Festival Decoration Solar String Lights (Multi-color)</p>
						</div>
					</li>
					<li class="col-sm-6 col-sm-4">
						<div class="pro_display">
								<div class="pro_imgBox"><img src="https://images-na.ssl-images-amazon.com/images/I/71CCdYubRzL._SL1000_.jpg" /></div>
								<p class="ptextsm">Battery Powered String Lights (Blue) </p>
						</div>
					</li>

				</ul>
				  <div class="orderInfo clearfix">
                                <div class="col-sm-7 address">
                                <p class="address_title">Shipping address</p>
                                <?php
				if (\Yii::$app->session->hasFlash('success')) {
					echo  Alert::widget([
						'options' => [
							'class' => 'alert-success',
						],
                                    		'body' =>  \Yii::$app->session->getFlash('success'),
					]);
                		 }
				 $form = ActiveForm::begin([
                                        'fieldConfig' => [
                                                'template' => '{input}{error}',
                                        ],
                                        'action' => ['md/prize'],
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
                            <div class="edit_but clearfix col-sm-12 row" >
                                    <?php echo Html::submitButton('SAVE', ['class' => 'edit_but1']); ?>
                            </div>
                                <?php ActiveForm::end()?>
                           </div>
                        </div>
                </div>
        </div>
                                                                                              

