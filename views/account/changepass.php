<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;
?>

<div class="main" id="main">
	<div class="container">
			<div class="usercenter">
			<div class="row">
			 <div class="col-main col-xs-12 col-sm-9">
	                 <div class="account_box account">
				<div class="a_box">
					<div class="account_title clearfix"><h1>CHANGE PASSWORD</h1></div>
					<?php
					$url = yii\helpers\Url::to(['account/login']);
					 if(Yii::$app->session->hasFlash('info')) {
						echo  Alert::widget([
							'options' => [
							'class' => 'alert-success',
							],
                                    			'body' =>  Yii::$app->session->getFlash('info').'&nbsp&nbsp&nbsp&lt;&lt;<a href="'.$url.'">Back to Login</a>',
						]);
                     			}
					 $form= ActiveForm::begin([
						'id'=> 'create-form',
						'fieldConfig' => [
							'template' => '{input}{error}',
						],
						'action' => ['account/password'],
					]);?>
						            <ul class="form-list">
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right">New password:</label>
						                    <div class="input-box col-sm-9 col-md-10">
									<?php echo $form->field($model,'userpass')->passwordInput(['class' => 'input-text form-control'])?>
						                    </div>
						                </li>
						                <li class="fix_info clearfix">
						                    <label class="col-sm-3 col-md-2 text_right">re- password:</label>
						                    <div class="input-box col-sm-9 col-md-10">
									<?php echo $form->field($model,'repass')->passwordInput(['class' => 'input-text form-control'])?>
						                    </div>
						                </li>
						            </ul>   
						     		   <label class="col-sm-3 col-md-2 text_right"></label>
						                <div class="col-sm-9 col-md-10 ">
									<input type="hidden" value="2323"/>
									 <?php echo $form->field($model, 'useremail')->hiddenInput(); ?>
									<?php echo Html::submitButton('Submit',['class' => 'btn btn-primary'])?>
						            	</div>
						<?php ActiveForm::end()?>
						</div>
					</div>
		        </div>
       			 </div>
			</div>
		</div>
</div>
