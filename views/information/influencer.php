<?php
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Html;
	$this->title = 'Qedertek Community';
?>
<div class="main" id="main">
	<div class="product_banner">
		<img src="images/influencer.jpg" />
	</div>
	<div class="banner_text">
		<div class="container box_text"><div class="text-center"><h1>COMMUNITY</h1></div>We're committed to constant improvement through user feedback. Our super user provide one of the main ways in which we engage with users to learn how we can do better. That's why we'd like to work with you. <br /><br />

Welcome to join and become our super users, more benefits you will get here, includes free samples, exclusive highly-discounted products, loyalty rewards, and other great privileges etc. <br /><br />

Free or highly-discounted products testing. Give us feedback. Help us get it right. So that we can build a better future for every one of us together. <br /><br />

Thanks a lot for your support, we hope you love our products.<br />
<br />
Register to become Qedertek Super User <a href="http://www.qedertek.com/account/login" >here!</a>
<div></br></div>
          </div>
	</div>
	<div class="container influencer-box">
       <div class="icn-bar">
    	<a href="javascript:void(0);" class="apply-infu info_btn" style="display: block;">Apply Now</a>
       </div>
       <div class="influencer-tab" style="display: none;">
	      <ul class="nav nav-tabs">
	        <li class="active">
	        	<a href="#facebook" data-toggle="tab">
	        		<img src="images/icn-facebook.jpg" class="img-responsive center-block">
	        	</a>
	        </li>
	        <li>
	        	<a href="#twitter" data-toggle="tab">
	        		<img src="images/icn-twitter.jpg" class="img-responsive center-block">
	        	</a>
	        </li>
	        <li>
	        	<a href="#blog" data-toggle="tab">
	        		<img src="images/icn-blog.jpg" class="img-responsive center-block">
	        	</a>
	        </li>
	        <li>
	        	<a href="#youtube" data-toggle="tab">
	        		<img src="images/icn-youtube.jpg" class="img-responsive center-block">
	        	</a>
	        </li>
	        <li>
	        	<a href="#in" data-toggle="tab">
	        		<img src="images/icn-in.jpg" class="img-responsive center-block">
	        	</a>
	        </li>
	        <li>
	        	<a href="#forum" data-toggle="tab">
	        		<img src="images/icn-forum.jpg" class="img-responsive center-block">
	        	</a>
	        </li>                
	      </ul>
	  <?php
		if(\Yii::$app->session->hasFlash('influencerinfo')){
			echo Alert::widget([
				'options' => [
					'class' => 'alert-success',
				],
				'body' => \Yii::$app->session->getFlash('influencerinfo'),
			]);
		}
		$form = ActiveForm::begin([
			'id' => 'influenceForm',
			'fieldConfig' => [
				'template' => '{input}{error}',
			],	
			'options' => [
				'class' => 'bv-form',
			],
			'action' => ['information/community'],
		]);
	  ?>
          <form id="influenceForm" method="POST" novalidate="novalidate" class="bv-form">
	    <button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
            <input name="brandId" id="brandId" type="hidden" value="2">
            <input name="langId" id="langId" type="hidden" value="1">
            <input name="count" id="count" type="hidden" value="1">
            <!-- First name -->
            <div class="form-group">
              <label class="control-label"><span class="org-size">*</span> First name :</label>
	 	 <?php echo $form->field($model,'firstname')->textInput(['class' => 'form-control','placeholder' => 'First name']);?>
            </div>
            <!-- END first name -->

            <!-- Last name -->
            <div class="form-group">
              <label class="control-label"><span class="org-size">*</span> Last name :</label>
	 	 <?php echo $form->field($model,'lastname')->textInput(['class' => 'form-control','placeholder' => 'Last name']);?>
            </div> 
            <!-- END last name -->
      
            <!-- country -->           
            <div class="form-group">
              <label class="control-label"><span class="org-size">*</span> Country :</label>
		<?php echo $form->field($model, 'country')->dropDownList($country);?>
              </div>
            <!-- END country -->
            
            <!-- Email -->
            <div class="form-group">
              <label class="control-label"><span class="org-size">*</span> Email :</label>
	 	 <?php echo $form->field($model,'email')->textInput(['class' => 'form-control','placeholder' => 'Email']);?>
	   </div> 
            <!-- END Email -->
            
            <div class="tab-content">
            
	            <!-- tab-pane-1 -->
	            <div class="tab-pane fade in active" id="facebook">
		            <!-- Link -->
		            <div class="form-group">
		              <label class="control-label">
		              	<span class="org-size">*</span>Please enter your Facebook profile link.
		              </label>
		              <input name="channelId" value="1" type="hidden">
			   </div>
			</div>
	            <!-- END tab-pane-1 -->
	            
	             <!-- tab-pane-2 -->
	             <div class="tab-pane fade" id="twitter">
		             <div class="form-group">
		                <label class="control-label">
		              	   <span class="org-size">*</span>Please enter your Twitter profile link. 
		                </label>
		                <input name="channelId" value="2" type="hidden">
			</div> 
	             </div>
	             <!-- END tab-pane-2 --> 
	            
	            <!-- tab-pane-3 -->
	            <div class="tab-pane fade" id="blog">
	              <div class="form-group">
		              <label class="control-label">
		              	<span class="org-size">*</span>Please enter your blog link.
		              </label>
	              	<input name="channelId" value="3" type="hidden">
			</div>           
	            </div>
	             <!-- END tab-pane-3 -->  
	             
	            <!-- tab-pane-4 -->
	            <div class="tab-pane fade" id="youtube">
		            <div class="form-group">
		              <label class="control-label">
		              	<span class="org-size">*</span>Please enter your YouTube channel link. 
		              </label>
		              <input name="channelId" value="4" type="hidden">
			</div>            
	            </div>
	             <!-- END tab-pane-4 -->  
	             
	            <!-- tab-pane-5 -->
	            <div class="tab-pane fade" id="in">
		            <div class="form-group">
		              <label class="control-label">
		              	<span class="org-size">*</span>Please enter your Instagram profile link.
		              </label>
		              <input name="channelId" value="5" type="hidden">
			</div>            
	            </div>
	             <!-- END tab-pane-5 -->  
	                                      
	            <!-- tab-pane-6 -->
	            <div class="tab-pane fade" id="forum">
		            <div class="form-group">
		              <label class="control-label">
		              	<span class="org-size">*</span>Please enter your forum profile link.
		              </label>
		              <input name="channelId" value="6" type="hidden">
			</div>            
	            </div>
	            <!-- END tab-pane-6 -->                      
	 	 	 <?php echo $form->field($model,'profile_link')->textInput(['class' => 'form-control','placeholder' => 'http://']);?>
            </div>
         
            <div class="form-group form-code">
              <label class="control-label yzm">Verification Code:</label>
		<?= $form->field($model, 'verifyCode')->widget(yii\captcha\Captcha::className(), [ 
			'template' => '<div class="row"><div class="col-lg-2">{image}</div><div class="col-lg-2">{input}</div></div>', 
		]) ?>
	   </div>
            <!-- btn -->
            <div class="text-center">
             <!-- <p class="text-center"> 
              Qedertek values and respects your privacy. Please read the 
              <a href="/privacy-policy.html" target="_blank" class="text-blue">Privacy Policy</a> for more information.</p>-->
		<?php echo Html::submitButton('Submit',['class' => 'info_btn'])?>
            </div> 
	<?php ActiveForm::end();?>
      </div>   
 
    </div>
</div>
<?php
$js = <<<JS
$(function(){
		$(".apply-infu").click(function(){
                        $(".apply-infu").css('display','none');
                        $(".influencer-tab").css('display','block');
                })

		function height_cc(){
			var doc=$(document).width();
			if (doc>768) {
				var height_v=$(".box_text").height();
				$(".box_text").css("margin-top",-height_v);
			} 
		}
		height_cc();	
		$(window).resize(function(){
			height_cc();		
		})
	})
JS;
$this->registerJs($js);
?>
