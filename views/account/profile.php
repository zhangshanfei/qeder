<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Alert;

$this->registerCssFile('lib/Bootstrap/css/bootstrap-datetimepicker.min.css');
$css = <<<CSS
	.datetimepicker{width: 235px !important;}
CSS;
$this->registerCss($css);
?>
<div id="top_bar" style="height:0px">&nbsp;</div>
<div class="main" id="main">
	<div class="container">
			<ol class="breadcrumb xs-margin0">
			    <li><a href="<?php echo \yii\helpers\Url::home()?>"><i class="icon-home"></i></a></li>
			    <li>User Center</li>
			</ol>	
			<div class="usercenter">
				<div class="row">
					<?php echo $this->render('_left')?>
			        <div class="col-main col-xs-12 col-sm-9">
	                <div class="account_box account">
						<div class="a_box">
							<div class="account_title">Your Person Deatil</div>
						<?php
							if (Yii::$app->session->hasFlash('accountinfo')) {
								echo  Alert::widget([
									'options' => [
										'class' => 'alert-success',
									],
									'body' =>  Yii::$app->session->getFlash('accountinfo'),
								]);
							}
							$form = ActiveForm::begin([
								'fieldConfig' => [
									'template' => '{error}{input}',
								],
								'action' => ['account/profile'],
							]);
						?>
						            <ul class="form-list">
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right">Email:</label>
						                    <div class="input-box  col-sm-9 col-md-10"> <?php echo Yii::$app->user->identity->useremail;?></div>
						                </li>
						
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right"><span class="imp">*</span>Username:</label>
						                    <div class="input-box col-sm-9 col-md-10">
									<?php echo $form->field($model,'username')->textInput(['class' => 'input-text form-control']);?>
						                    </div>
						                </li>
						
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right">Sex:</label>
						                    <div class="input-box  col-sm-9 col-md-10">
								     <?php echo $form->field($model,'sex')->radioList([0 => 'Secrecy',1 => 'Male', 2 => 'Femal'])?>
						                    </div>
						                </li>
						
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right">Birthday:</label>
						                 <div class="input-box  col-sm-9 col-md-10">
						                    <div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
												<!--<input class="form-control" size="16" type="text" value="" readonly>-->
												<?php echo $form->field($model,'birthday',['template'=>'{input}'])->textInput(['class'=>'form-control','readonly'=>'readonly'])?>
												<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
												<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
											</div>
											<input type="hidden" id="dtp_input2" value="" />
										</div>
						                </li>
						            </ul>
						                  <label class="col-sm-3 col-md-2 text_right"></label>
						                   <div class="col-sm-9 col-md-10 ">
										<?php echo Html::submitButton('submit',['class' => 'btn btn-primary']);?>
						            	   </div>
							<?php ActiveForm::end();?>
							<div class="account_title clearfix">Password</div>
							<?php $form = ActiveForm::begin([
								'fieldConfig' => [
									'template' => '{error}{input}',
								],
								'action' => ['account/profile'],
							]);?>
						    <form name="formPassword">
						            <ul class="form-list">
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right">Old password:</label>
						                    <div class="input-box col-sm-9 col-md-10">
									<?php echo $form->field($user,'oldpass')->passwordInput(['class'=>'intput-text form-control'])?>
						                    </div>
						                </li>
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right">New password:</label>
						                    <div class="input-box col-sm-9 col-md-10">
									<?php echo $form->field($user,'userpass')->passwordInput(['class'=>'intput-text form-control'])?>
						                    </div>
						                </li>
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right">re- password:</label>
						                    <div class="input-box col-sm-9 col-md-10">
									<?php echo $form->field($user,'repass')->passwordInput(['class'=>'intput-text form-control'])?>
						                    </div>
						                </li>
						            </ul>   
						     		   <label class="col-sm-3 col-md-2 text_right"></label>
						                <div class="col-sm-9 col-md-10 ">
									<?php echo Html::submitButton('submit',['class' => 'btn btn-primary'])?>
						            	</div>
							<?php ActiveForm::end();?>
						</div>
					</div>
		        </div>
       			 </div>
			</div>
		</div>
</div>
<?php
$js = <<<JS
	$('.form_date').datetimepicker({
			weekStart: 1,
			todayBtn:  1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			minView: 2,
			forceParse: 0,
			pickerPosition: 'bottom-left',
			format: 'yyyy-mm-dd'
		});
JS;

$this->registerJs($js);
//$this->registerJsFile('lib/Bootstrap/js/bootstrap-datetimepicker.min.js', ['position' => \yii\web\View::POS_END]);
?>
