<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;
?>
<?php
$css = <<<CSS
	.form-horizontal .form-group{margin-left:0px;margin-right:0px};
CSS;
$this->registerCss($css);
$this->registerCssFile(\Yii::$app->homeUrl.'css/lg_style.css');
?>
<div class="lg-bg-image-1">
	<div class="container">
		<div class="col-md-8"></div>
		<div class="col-md-4 lg-margin">			
		<?php
		 if(Yii::$app->session->hasFlash('info')) {
			echo  Alert::widget([
				'options' => [
				'class' => 'alert-success',
				],
                                'body' =>  Yii::$app->session->getFlash('info'),
			]);
               	}
		 $form= ActiveForm::begin([
			'id'=> 'create-form',
			'fieldConfig' => [
				'template' => '{input}{error}',
			],
			'options' => ['class' => 'form-horizontal lg-login-form-2'],
			'action' => ['account/forget'],
		]);?>
				<div class="row" style="text-align:center;">
					<div class="col-md-12" >
						<h3>Password Reset</h3>
					</div>
				</div>
				<div class="row">
					<div class="lg-one-signin col-md-12">
					<div class="form-group">
						<div class="col-md-12">
							Please enter your email address that you registered in our website.
						</div>	
					</div>
				        <div class="form-group">
				           <div class="col-md-12">
				            <div class="lg-input-icon-container">
				            	<i class="fa icon-envelope"></i>
						<?php echo $form->field($model,'useremail')->textInput(['class'=>'form-control','placeholder'=>'Email'])?>
				            </div>
				          </div>
				        </div>
				        <div class="form-group">
				          <div class="col-md-12">
						<?php echo Html::submitButton('Submit',['class'=>'btn btn-warning']);?>
				          </div>
				        </div>
				        <div class="form-group">
				          	<div class="col-md-12">
				        		<a href="<?= yii\helpers\Url::to(['account/login'])?>" class="text-center">login</a>
				       	 	</div>
				    	</div>
					</div>
				</div>				 	
			<?php ActiveForm::end();?>
		</div>
	</div>	
</div>
