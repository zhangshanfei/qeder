<?php
 use yii\bootstrap\ActiveForm;
 use yii\helpers\Html;
 use yii\bootstrap\Alert;
?>

<div class="main" id="main">
	<div class="container">
			<ol class="breadcrumb xs-margin0">
			    <li><a href="<?php echo yii\helpers\Url::home()?>"><i class="icon-home"></i></a></li>
			    <li>User Center</li>
			</ol>	
			<div class="usercenter">
				<div class="row">
					<?php echo $this->render("_left")?>	
			        <div class="col-main col-xs-12 col-sm-9">
	                <div class="account_box account">
						<div class="a_box">
							<div class="account_title">Edit/Add A New Consignee.</div>
						<?php 
						if (Yii::$app->session->hasFlash('addressinfo')) {
							echo  Alert::widget([
								'options' => [
									'class' => 'alert-success',
								],
								'body' =>  Yii::$app->session->getFlash('addressinfo'),
							]);
						}
						$form = ActiveForm::begin([
							'fieldConfig' => [
								'template' => '{input}{error}',
							],
						]);?>
						            <ul class="form-list">						               
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp">*</span>First name:</label>
						                    <div class="input-box col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'firstname')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>
								<li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp">*</span>Last name:</label>
						                    <div class="input-box col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'lastname')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>
						                 <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp"></span>Phone:</label>
						                    <div class="input-box col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'telephone')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>
						                 <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp">*</span>Address:</label>
						                    <div class="input-box col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'address1')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>
								 <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"></label>
						                    <div class="input-box col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'address2')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>

						                 <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp">*</span>City:</label>
						                    <div class="input-box col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'city')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>	
						                 <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp">*</span>Postalcode:</label>
						                    <div class="input-box col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'postalcode')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>							
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp">*</span>Country:</label>
						                    <div class="input-box  col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'country')->dropDownList(['United States']);?>
						                </li>
								 <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp">*</span>State/Province:</label>
						                    <div class="input-box col-sm-9 col-sm-10">
									<?php echo $form->field($model, 'province')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>							
						                
						            </ul>
						                  <label class="col-sm-3 col-md-2 text_right"></label>
						                   <div class="col-sm-9 col-sm-10 ">
  					                                        <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?>
	
						            	   </div>
							<?php ActiveForm::end()?>
						</div>
						<?php if(!empty($model->firstname)){?>
						<h3>Address Book</h3>
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
							  <tbody>
							  <tr>
							    <td class="text-left"><?php echo $model->firstname." ".$model->lastname?><br><?php echo $model->address1; if($model->address2){ echo "<br>".$model->address2;}?><br><?php echo $model->city." , ".$model->province." , ".$model->postalcode?><br><?php echo \Yii::$app->params['country'][$model->country]?><br><?php echo $model->telephone?></td>
							  </tr>
							   </tbody>
							</table>
					      </div>
					      <?php } ?>
					</div>
			        </div>
       			 </div>
			</div>
		</div>
</div>
