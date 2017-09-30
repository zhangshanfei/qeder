<?php
use yii\bootstrap\ActiveForm;
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
		<div class="col-md-4"></div>
		<div class="col-md-8 lg-margin">			
		<?php $form = ActiveForm::begin([
			'id' => 'login-form',
			'fieldConfig' => [
				'template' => '{input}{error}',
			],
			'options'=> [
				'class' => 'form-horizontal lg-login-form-2',
			],
			'action' => ['account/login'],
		])?>
				<div class="row">
					<div class="col-md-12">
						<h1>Sign in to your account</h1>
					</div>
				</div>
				<div class="row">
					<div class="lg-one-signin col-md-6">
				        <div class="form-group">
				          <div class="col-md-12">		          	
				            <label for="username" class="control-label">Email</label>
				            <div class="lg-input-icon-container">
				            	<i class="fa icon-envelope"></i>
						<?php echo $form->field($model,'useremail')->textInput(['class' => 'form-control','placeholder' => 'Email']);?>
				            </div>		            		            		            
				          </div>              
				        </div>
				        <div class="form-group">
				          <div class="col-md-12">
				            <label for="password" class="control-label">Password</label>
				            <div class="lg-input-icon-container">
				            	<i class="fa icon-lock"></i>
						<?php echo $form->field($model,'userpass')->passwordInput(['class' => 'form-control','placeholder' => 'Password'])?>
				            </div>
				          </div>
				        </div>
				        <div class="form-group">
				          <div class="col-md-12">
				            <div class="checkbox">
				                <label>
						  <?php echo $form->field($model,'rememberMe')->checkbox()?>
				                </label>
				            </div>
				          </div>
				        </div>
				        <div class="form-group">
				          <div class="col-md-12">
					    <?php echo Html::submitButton('LOG IN',['class' => 'btn btn-warning'])?>
				          </div>
				        </div>
				        <div class="form-group">
				          	<div class="col-md-6">
				        		<a href="<?= yii\helpers\Url::to(['account/forget'])?>" class="text-center">Cannot login?</a>
				       	 	</div>
						<div class="col-md-6">
				        		<a href="<?= yii\helpers\Url::to(['account/create'])?>" class="text-center">Create Account</a>
				       	 	</div>

				    	</div>
					</div>
					<div class="lg-other-signin col-md-6">
						<label class="margin-bottom-15">
							Welcome Back
						</label>
						<a onclick="flogin()" class="btn btn-block btn-social btn-facebook margin-bottom-15">
						    <i class="icon-facebook"></i> Sign in with Facebook
						</a>
						<a onclick="glogin()" class="btn btn-block btn-social btn-google-plus">
						    <i class="icon-google-plus"></i> Sign in with Google
						</a>
					</div>   
				</div>				 	
			<?php ActiveForm::end();?>
		</div>
	</div>
</div>
<script>
	var newwindow;
        var intid;
	function flogin()
	{
		 var  screenx    = typeof window.screenx != 'undefined' ? window.screenx : window.screenleft,
                 screeny    = typeof window.screeny != 'undefined' ? window.screeny : window.screentop,
                 outerwidth = typeof window.outerwidth != 'undefined' ? window.outerwidth : document.body.clientwidth,
                 outerheight = typeof window.outerheight != 'undefined' ? window.outerheight : (document.body.clientheight - 22),
                 width    = 800,
                 height   = 450,
                 left     = parseInt(screenx + ((outerwidth - width) / 2), 10),
                 top      = parseInt(screeny + ((outerheight - height) / 2.5), 10),
                 features = (
                    'width=' + width +
                    ',height=' + height +
                    ',left=' + left +
                    ',top=' + top
                  );
 
            newwindow=window.open('<?= \yii\helpers\Url::to(['account/auth','authclient' => 'facebook']);?>','login_by_facebook',features);
 
           if (window.focus) {newwindow.focus()}
          return false;
	}
	
	 function glogin(){
            var  screenx    = typeof window.screenx != 'undefined' ? window.screenx : window.screenleft,
                 screeny    = typeof window.screeny != 'undefined' ? window.screeny : window.screentop,
                 outerwidth = typeof window.outerwidth != 'undefined' ? window.outerwidth : document.body.clientwidth,
                 outerheight = typeof window.outerheight != 'undefined' ? window.outerheight : (document.body.clientheight - 22),
                 width    = 800,
                 height   = 450,
                 left     = parseInt(screenx + ((outerwidth - width) / 2), 10),
                 top      = parseInt(screeny + ((outerheight - height) / 2.5), 10),
                 features = (
                    'width=' + width +
                    ',height=' + height +
                    ',left=' + left +
                    ',top=' + top
                  );
 
            newwindow=window.open('<?= \yii\helpers\Url::to(['account/auth','authclient' => 'google']);?>','login_by_facebook',features);
 
           if (window.focus) {newwindow.focus()}
          return false;
        }

</script>

