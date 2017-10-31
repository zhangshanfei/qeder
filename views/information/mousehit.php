<?php
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\bootstrap\ActiveForm;
use app\models\User;
AppAsset::register($this);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html>
	<head>
		<!--Meta -->
		<meta charset="<?php echo Yii::$app->charset; ?>">
		<?php
			$this->registerMetaTag(['name' => 'renderer','content' => 'webkit|ie-comp|ie-stand']);
			$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible','content' => 'IE=edge,chrome=1']);
			$this->registerMetaTag(['name' => 'viewport','content' => 'width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no']);
		?>
		<!--<link rel="shortcut icon" href="favicon.ico">-->
		<title><?php echo Html::encode($this->title); ?></title>
		<link rel="shortcut icon" href="<?php echo \Yii::$app->homeUrl?>images/favicon.ico">
		<?php $this->head();?>	
	</head>
<body>
<?php $this->beginBody();?>	

<!-- php echo $content;?> -->


<?php	

$this->title = "MouseHit Game —— Qedertek";

$this->registerCssFile(\Yii::$app->homeUrl.'mouseHit/css/main.css'        );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/myEngine/core/my.js'  );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/myEngine/component/Component.js'    );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/myEngine/component/DisplayObject.js');
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/myEngine/component/Bitmap.js'       );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/myEngine/utils/ImageManager.js'     );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/myEngine/utils/DOM.js'   );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/myEngine/utils/Math.js'  );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/myEngine/utils/buzz.js'  );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/resources/images.js'  );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/resources/audios.js'  );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/frames/mouse.js'      );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/frames/star.js'       );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/frames/score.js'      );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/classes/Audio.js'     );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/classes/Animation.js' );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/classes/star.js'	     );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/classes/score.js'     );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/classes/hammer.js'    );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/classes/mouse.js'     );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/classes/MouseHit.js'  );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/classes/UI.js'        );
$this->registerJsFile(\Yii::$app->homeUrl.'mouseHit/js/main.js'              );
?>
		
		
<div class="main support" id="main">		
		<div id="hitmouse">
			<!-- 预备界面 -->
			<div id="gameCover" class="block background">
				<!-- 声音控制按钮 -->
				<a href="javascript:void(0)" id="btnSound" class="icon">&nbsp;</a>
				<!-- 开始 -->
				<a href="javascript:void(0)" id="btnPlay" class="icon">&nbsp;</a>
				<!-- 帮助 -->
				<a href="javascript:void(0)" id="btnHelp" class="icon">&nbsp;</a>
				<!-- 退出-->
				<a href="javascript:void(0)" id="btnAboutMe" class="icon" >&nbsp;</a>
				<!-- 加载资源 -->
				<span id="progressText"></span>		
			</div>	
			<!-- 帮助界面 -->
			<div id="HelpDiv" >
			  <!-- 帮助图片   张善飞  -->
			  <img src="<?php echo \Yii::$app->homeUrl?>mouseHit/images/help.png"/>  
			  
			  <a href="javascript:void(0)" id="btnBack" class="icon">&nbsp;</a>
			</div>
			<!-- 游戏主体 -->
			<div id="gameBody" class="block">
				<div id="gameCanvas" class="block">
					<!-- Main背景层 -->
					<canvas width="750" height="550" id="maincanvas" ></canvas>
				</div>
				<!-- 分数及暂停按钮 -->
				<div id="numberAndPause" class="block">
					<!-- 分数 -->
					<div id="numberBefore" class="icon"></div>
					<div id="number" ></div>
					<!-- 暂停 -->
					<a href="javascript:void(0)" id="btnPause" class="icon">&nbsp;</a>
				</div>
				<!-- 下一关提示 -->
			  <div id="nextLoding">
					<!-- 分数 -->
					<span id="currentScore"></span>
					<span id="requireScore" ></span>
		     </div>
			</div>
			<!-- 游戏结束 -->
			<div id="gameOver" class="block">
				<!-- 得分 -->
				<span id="score"></span>
				<!-- 准备 -->
				<a href="javascript:void(0)" id="btnRetry" class="icon">&nbsp;</a>
				<!-- 返回主菜单 -->
				<a href="javascript:void(0)" id="btnBackToMenu" class="icon">&nbsp;</a>			
			</div>
		</div>
</div>


</div>
<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>
<script>
$(function(){
	$('#btn-newsletter').on('click', function(e){
                e.preventDefault();
		var data = $("#newsletter_form").serializeArray();
		postData = {};
		$(data).each(function(i){
			postData[this.name] = this.value;
		});
		console.log(postData);
		var url = '<?= Url::to(['newsletter/subscribe']) ?>';
		$.post(url,postData,function(result){
			if(result.status == 1){
				//成功
				return dialog.success(result.message,result.title);
			}else if(result.status == 0){
				//失败
				return dialog.error(result.message,result.title);
			}
		},"JSON");	
        });
	
})
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-88445926-1', 'auto');
  ga('send', 'pageview');

</script>












					