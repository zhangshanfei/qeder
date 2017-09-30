<?php
$css = <<<CS
*{margin: 0; padding: 0;}
     	  .zhuan_box{width: 100%; margin: 0 auto; background: #CCCCCC; position: relative; }
     	  .box1{width: 30%; margin: 0 auto; position: absolute; top: 10%; left: 35%;}
     	  .box2{width: 40%; height: auto; position: absolute; top: 30%; left: 29.5%;}
     	  .box2{animation: dh 4s infinite linear;   -webkit-animation:dh 4s infinite linear;}
     	  .box_con img,.box1 img{width: 100%; display: block;}
     	  
     @media(max-width:767px) {
     	  	 .zhuan_box{width: 95%; overflow: hidden;}
     	  	 .box_con img{width: 200%; margin-left: -30%;}
     	  	 .box1{width: 60%; left: 35%;}
     	  }
     	  .con1{width:50%;padding: 10px;text-align: justify; margin: 0 auto;}
	  .point{cursor:pointer;}
CS;
$this->registerCss($css);
?>
<div class="main" style="background:#ffd900;">
  <div class="zhuan_box">
  	 <div class="box1">
  	 	<img src="<?php echo \Yii::$app->homeUrl?>/mothersday/images/circle.png" />
  	   <div class="box2"><img class="point" src="<?php echo \Yii::$app->homeUrl?>/mothersday/images/rotate-static2.png" /></div>
  	 </div>
    <div class="box_con"><img src="<?php echo \Yii::$app->homeUrl?>/mothersday/images/bg.jpg" /></div>
  </div>
<div class="con1">
	<ul>
		<ul>
			<li><h2>Rules:</h2><li>
			<li>1. Qedertek Mother’s Day Lucky Draw ended at 05/14/2017 11:59 PM PDT.</li>
			<li>2. If you have already registered on Qedertek.com, please sign in to enter the lucky draw.</li>
			<li>3. If you are a new member, please sign up via email directly.</li>
			<li>4. The Lucky Draw is only open to the United States residents, prizes will be shipped from Amazon FBA.</li>
			<li>5. Every participant has one chance to win. If you failed at the first time, you have a chance to play again until you gain a prize.</li>
			<li>6. Winners can apply your prize according to system prompt.</li>
		</ul>
	</ul>
</div>
</div>
<?php
  $this->registerJsFile(\Yii::$app->homeUrl.'mothersday/js/jquery.easing.min.js',['depends'=>'yii\web\YiiAsset']);
  $this->registerJsFile(\Yii::$app->homeUrl.'mothersday/js/jQueryRotate.2.2.js',['depends'=>'yii\web\YiiAsset']);
	/**
	 * 根据转盘旋转角度判断获得什么奖品
	 * @param deg
	 * @returns {*}
	 */
$url =  \Yii\helpers\Url::to(['md/status']);
$jump_url = \Yii::$app->urlManager->createAbsoluteUrl(['md/prize']);
$login_url = \Yii::$app->urlManager->createAbsoluteUrl(['account/login']);
$userid = \Yii::$app->user->id;
$js = <<<JS
$(function(){
	var rotateFunc = function(awards,angle,text){  //awards:奖项，angle:奖项对应的角度
		$.get('$url',{click : 1});
		$('.point').stopRotate();
		$(".point").rotate({
			angle:0, 
			duration: 5000, 
			animateTo: angle+1440, //angle是图片上各奖项对应的角度，1440是我要让指针旋转4圈。所以最后的结束的角度就是这样子^^
			callback:function(){
				if(awards != 0){
				layer.alert(text, {
				 'title':'Message',
				 'btn': ['OK'],
				  skin: 'layui-layer-molv' //样式类名
				  ,closeBtn: 0
				}, function(){
					window.location.href='$jump_url'+'?award='+awards;
					
				});
				}else{
					layer.msg(text,{time:2000});
				}
			//	layer.msg(text, {
			//	  time: 2000 //2秒关闭（如果不配置，默认是3秒）
			//	}, function(){
			//		if(awards !=0){
			//			$.get('$url',{click : 1});
						//$.get('$jump_url',{award : awards});
						//window.location.href='$jump_url'+'?award='+awards;
					//	window.location.href='$jump_url';
					//	window.open("$jump_url?award="+awards,"_self");  
			//
			//		}
			//	});  
			}
		}); 
	};
	if('$userid'!='')
	{	
	$(".point").rotate({ 
	   bind: 
		 { 
			click: function(){
					var data = [0,1,2,3,4]; //返回的数组
					var failure ="Ohhh! You failed this time,Please try once agin!";
						data = data[Math.floor(Math.random()*data.length)];
					if(data==1){
						var angle = [22,247];
						angle = angle[Math.floor(Math.random()*angle.length)]
						rotateFunc(1,angle,'Congratulations,you have won free prize.' )
					}
					if(data==2){
						var angle = [157,337];
						angle = angle[Math.floor(Math.random()*angle.length)]
						rotateFunc(2,angle,'Congratulations,you have won 60% OFF prize!')
					}
					if(data==3){
						rotateFunc(3,67,'Congratulations,you have won 40% OFF prize!')
					}
					if(data==4){
						rotateFunc(4,202,'Congratulations,you have won 20% OFF prize!')
					}
					if(data==0){
						var angle = [112,292];
							angle = angle[Math.floor(Math.random()*angle.length)]
						rotateFunc(0,angle,failure)
					}
			}
		 } 
	   
	});
	}else{
		$(".point").rotate({
			bind:
				 {
					click:function(){
						layer.msg('Please log in', {
						  time: 2000 //2秒关闭（如果不配置，默认是3秒）
						}, function(){
							window.location.href='$login_url';
						});
							}
			   	 }	
		});
	}
	
})
JS;
$this->registerJs($js);
?>
