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
	<meta charset="<?php echo Yii::$app->charset; ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" />
	<?php
		$this->registerMetaTag(['name' => 'renderer','content' => 'webkit|ie-comp|ie-stand']);
		$this->registerMetaTag(['http-equiv' => 'X-UA-Compatible','content' => 'IE=edge,chrome=1']);
	?>
	<title>Penguin Game</title>
	<meta property="og:url" content="<?php echo \Yii::$app->homeUrl?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Qedertek.com" />
	<meta property="og:description"   content="Holidays Lighting | Decorative Lights | Light Fixtures | Homeimprovements" />
	<meta property="og:image" content="<?php echo \Yii::$app->homeUrl?>images/product_banner.jpg" />
	<link rel="shortcut icon" href="<?php echo \Yii::$app->homeUrl?>images/favicon.ico">
	<script>
			(function (d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10';
				  fjs.parentNode.insertBefore(js, fjs);
			  }(document, 'script', 'facebook-jssdk'));
	</script>
	<style>
/* 		body, */
/* 		html { */
/* 			padding: 0; */
/* 			margin: 0; */
/* 			width: 100%; */
/* 			height: 100%; */
/* 			background: rgb(221, 244, 248); */
/* 			-webkit-tap-highlight-color: transparent; */
/* 			color: rgb(199, 204, 223); */
/* 		} */
@media (min-device-width:768px){
		canvas {
			width: 100%;
			height: 100%;
			margin-top:77px;
		}
}
@media (max-device-width:450px){
		canvas {
			width: 100%;
			height: 100%;
/* 			margin-top:50px; */
		}
}
		#container {
			position: absolute;
			bottom: 0;
			left: 0;
			width: 100%;
			height: 100%;

		}
		/* #sharef{
			position: absolute;
			left: 277px;
			top: 380px;
			z-index: 10;
		} */
	</style>
<?php $this->head();?>	
</head>

<body>
<?php $this->beginBody();?>	
<nav class="navbar navbar-default navbar-fixed-top rob" id="nav_bar">
  <div class="container head-container" id="headbox">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" > <span class="sr-only">Toggle navigation</span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> </button>
      <a class="logo_img" href="<?php echo Url::home() ?>"><img src="<?php echo \Yii::$app->homeUrl?>images/qedertek.png"></a>
    </div>
    <div class="user_login fr mb_hidden">
		<?php if(Yii::$app->user->isGuest){?>
		<a  href="<?= Url::to(['account/login'])?>"><i class="icon-large icon-user icon-user1" ></i></a>
		<?php }else{?>
		 <span class="userText_box"><em class="user_text"><a id="useremail" href="<?= Url::to(['account/'])?>"><?php echo !empty(Yii::$app->session['username']) ? Yii::$app->session['username'] : Yii::$app->user->identity->useremail ?></a></em><a href="<?= Url::to(['account/logout'])?>"><i class="icon-large icon-signout"></a></i></span><!--4-1新增-->
		<?php } ?>
    </div>
      <!--navbar-->    
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav fr">
      	<li> <a href="<?php echo Url::home() ?>">HOME</a></li>
        <li class="dropdown"><a href="javascript:;" data-toggle="dropdown" >PRODUCTS<b class="caret mb_display"></b></a>
          <ul class="dropdown-menu">
          		<?php foreach ($this->params['menu'] as $menu):?>
			<li <?php if($menu['children']){?> class="caret1 clearfix"<?php } ?>>  <a href="<?php echo yii\helpers\Url::to(['products/index','cateid' => $menu['cateid']]) ?>"><?php echo $menu['title']?></a>
				<?php if($menu['children']){?>
				<ol class="threeMenu">
					<?php foreach($menu['children'] as $child):?>
					<li> <a href="<?php echo Url::to(['products/index','cateid' => $child['cateid']]) ?>"><?php echo $child['title']?></a> </li>
					<?php endforeach;?>
				</ol>
				<?php } ?>
			</li>
		<?php endforeach;?>
          </ul>
        </li>
        <li class="dropdown"> <a href="javascript:;" data-toggle="dropdown">PROMOTION<b class="caret mb_display"></b></a>
		<ul class="dropdown-menu">
			<li><a href="<?php echo Url::to(['information/influencer'])?>">Community</a></li>
			<li><a href="<?php echo Url::to(['information/giveaway'])?>">Giveaway</a></li>
			<li><a href="<?php echo Url::to(['information/dqe'])?>"  title="Please login first,then you can play.">Punguin Game</a></li>
			<li><a onclick="window.open('<?php echo Url::to(['information/mousehit'])?>','_blank','height=792,width=1349,resizable=no')" title="Please login first,then you can play.">A little game</a></li>
		</ul>
	</li>
        <li> <a href="<?php echo Url::to(['information/support'])?>">SUPPORT</a></li>
        <li class="md_hidden xs_display"> <a href="<?php echo Url::to(['account/create'])?>">REGISTER</a></li>
        <li class="md_hidden xs_display"> <a href="<?php echo Url::to(['account/login'])?>">LOGIN</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php	
$this->registerCssFile(\Yii::$app->homeUrl.'dqe/common.css');
$this->registerJsFile(\Yii::$app->homeUrl.'dqe/createjs.min.js');
$this->registerJsFile(\Yii::$app->homeUrl.'dqe/zepto.min.js'  );
$this->registerJsFile(\Yii::$app->homeUrl.'dqe/common.js');
$this->registerJsFile(\Yii::$app->homeUrl.'dqe/index.js'  );
$this->registerJsFile(\Yii::$app->homeUrl.'dqe/flyline.js'  );
?>
<!-- content开始 -->

	<!-- 分享到Facebook 张善飞2017年10月27日11:56:02 -->
	<!-- Load Facebook SDK for JavaScript -->
	

	<div id="container">
		<div id="fb-root"></div>
		<canvas id="canvas"></canvas>
		     	
		<!-- 分享按钮代码 -->
		<div>
			<div class="fb-share-button" data-href="https://www.qedertek.com"  data-layout="button" data-size="large"></div>
			<a href="javascript:window.open('http://twitter.com/home?status='+encodeURIComponent(document.location.href)+' '+encodeURIComponent(document.title),'_blank','toolbar=yes, location=yes, directories=no, status=no, menubar=yes, scrollbars=yes, resizable=no, copyhistory=yes, width=600, height=450,top=100,left=350');void(0)" ><img src="../dqe/img/tweet.png" height="28px" style="position:absolute; padding:0px;margin:0px;"></img></a>
		</div>
	</div>

	<script>
	// 张善飞 2017年10月26日16:53:40
	function postdata(){
		var useremail = document.getElementById("useremail").innerText;
		var gamename = "打企鹅";	// 游戏的名称
		var data = useremail+'&'+Main.maxScore*10+'&'+gamename;	//发送的数据
		var url = "../savescore.php";
		var xhr = new XMLHttpRequest();
		xhr.open("POST",url);
		xhr.setRequestHeader("Content-Type","plain/text");
		xhr.send(data);
	}
	</script>
	<script language=javascript>
		var mebtnopenurl = 'http://www.qedertek.com';
		window.shareData = {
			"imgUrl": "http://game2.id87.com/games/dqe/img/icon.png",
			"timeLineLink": "http://game2.id87.com/games/dqe",
			"tTitle": "打企鹅",
			"tContent": "打企鹅"
		};

		function goHome() {
			window.location = mebtnopenurl;
		}
		
// 		function dp_share() {
// 			document.title = "你简直霸气侧漏，把企鹅击飞出" + myData.scoreName + "，谁还能超越我？";
// 			document.getElementById("share").style.display = "";
// 			window.shareData.tTitle = document.title;
// 		}
		function dp_Ranking() {
			window.location = mebtnopenurl;
		}
	</script>
    <script type="text/javascript">
//     		var myData = { gameid: "dqe" };
//     		window.shareData.timeLineLink = "http://game2.id87.com/games/dqe/index.html?gameid=" + myData.gameid + (localStorage.myuid ? "&uid=" + localStorage.myuid : "");
//     		function dp_submitScore(score) {
//     			myData.score = score * 10;
//     			myData.scoreName = score + "米";
//     			if (score > 0) {
//     				if (confirm("你太猛了，大力出奇迹，一下把伦家击飞" + score + "米！要不要通知一下小伙伴")) {
//     					dp_share();
//     				}
//     			}
//     		}
			
	</script>

<!-- content结束 -->

<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();?>
