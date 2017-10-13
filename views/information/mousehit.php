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

					