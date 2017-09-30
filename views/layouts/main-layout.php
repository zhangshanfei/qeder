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
<!--<nav id="top_bar" class="mb_hidden">
   <div class="container">
   	 欢迎光临
   </div>
</nav>-->
<nav class="navbar navbar-default navbar-fixed-top rob" id="nav_bar">
  <div class="container head-container" id="headbox">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" > <span class="sr-only">Toggle navigation</span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> <span class="icon-bar"> </span> </button>
      <a class="logo_img" href="<?php echo Url::home() ?>"><img src="<?php echo \Yii::$app->homeUrl?>images/qedertek.png"></a>
    </div>
    <div class="user_login fr mb_hidden">
		<?php if(Yii::$app->user->isGuest){?>
		<a href="<?= Url::to(['account/login'])?>"><i class="icon-large icon-user icon-user1" ></i></a>
		<?php }else{?>
		 <span class="userText_box"><em class="user_text"><a href="<?= Url::to(['account/'])?>"><?php echo !empty(Yii::$app->session['username']) ? Yii::$app->session['username'] : Yii::$app->user->identity->useremail ?></a></em><a href="<?= Url::to(['account/logout'])?>"><i class="icon-large icon-signout"></a></i></span><!--4-1新增-->

		<?php } ?>
    	<a href="<?php echo Url::to(['cart/'])?>"><i class="icon-large icon-shopping-cart icon-shopping-cart1"><span id ="cartnum"><?php echo Yii::$app->session['cartnum'] == 0 ? '' : Yii::$app->session['cartnum']?></span></a></i>
    </div>
    
        <div class="search-top col-sm-2 col-md-2 no_padding fr">
	        <div class="nav fr">	
		<form id="search_form" action="<?php echo Url::to(['products/search'])?>" method="get">		
			<div id="search_div1" class="input-group input-group-sm"> <input id="search_input" type="search" name="keywords" class="form-control search_input search_input1" placeholder="Search" value=""> <span class="input-group-btn"> <button class="btn btn-primary button search-button search-button_active" id="search-button" title="Search" type="button" > <i class="icon-search"></i> </button> </span> </div> <div id="search_div2" class="input-group input-group-sm"> <input id="search_input2" class="search_input"> <span class="input-group-btn"> <button type="submit" class="btn btn-primary button search-button" id="search-button2" title="Search" type="button" > <i class="icon-search"></i>
			    </button>
			</span>
			</div>
	      </form>
      </div>	
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
        <li class="dropdown"> <a href="javascript:;">PROMOTION</a>
		<ul class="dropdown-menu">
			<li><a href="<?php echo Url::to(['information/influencer'])?>">Community</a></li>
			<li><a href="<?php echo Url::to(['information/giveaway'])?>">Giveaway</a></li>
			<li><a href="<?php echo Url::to(['information/mousehit'])?>" title="Please login first,then you can play.">A little game</a></li>
		</ul>
	</li>
        <li> <a href="<?php echo Url::to(['information/support'])?>">SUPPORT</a></li>
        <li class="md_hidden xs_display"> <a href="<?php echo Url::to(['account/create'])?>">REGISTER</a></li>
        <li class="md_hidden xs_display"> <a href="<?php echo Url::to(['account/login'])?>">LOGIN</a></li>
      </ul>
    </div>
  </div>
</nav>

<?php echo $content;?>

<div class="footer">
	<div class="footer_nr1 padding20">
		<div class="container">
			<div class="row">
				<ul class="clearfix">
					<li class="col-xs-6 col-sm-4 col-md-4">
						<dl>
							<form id="newsletter_form" action="<?=Url::to(['newsletter/subscribe'])?>" method="post">
							<dt>Subscribe:<span class="mb_hidden">Get out lastest news by email</span></dt>
							<dd>
								<div class="input-group col-lg-10 jymail">						         
						          <input type="text" name="emailAddress"  class="form-control email" placeholder="Email">
						          <button id="btn-newsletter" class="btn btn-default">Submit</button>
						        </div></dd>
							</form>
							<dt>Social Media</dt>
							<dd class="fonter-dd_icon">
								<a target="_blank" href="https://www.facebook.com/qedertek"><i class="icon-facebook"></i></a>
								<a target="_blank" href="https://www.youtube.com/channel/UCE_O9qeFOy9wNLhrNE4rNFQ"><i class="icon-youtube"></i></a>
								<a target="_blank" href="https://www.pinterest.com/qedertek/"><i class="icon-pinterest"></i></a>
								<a target="_blank" href="https://twitter.com/qedertek"><i class="icon-twitter"></i></a>
							</dd>
						</dl>					
					</li>
					<li class="col-xs-6 col-sm-4 col-md-4">
						<dl>
							<dt>Company</dt>
							<dd><a href="<?php echo Url::to(['information/about'])?>">ABOUT</a></dd>
							<dd><a href="<?php echo Url::to(['products/'])?>">PRODUTS</a></dd>
							<dd><a href="<?php echo Url::to(['information/promotion'])?>">PROMOTION</a></dd>
							<dd><a href="<?php echo Url::to(['information/support'])?>">SUPPORT</a></dd>
						</dl>
					</li>
					<li class="col-xs-12 col-sm-4 col-md-4">
						<dl>
							<dt>Site info</dt>
							<dd><i class="icon-map-marker"></i>　704 N. King Street Suite 500 P.O. Box 1031, Wilmington, DE 19899, County of New Castle </dd>
						    <dd><li><i class="icon-envelope"></i>　<a href="">support@qedertek.com</a></dd>
						    <!--<dd><i class="icon-phone"></i>　<a href="">(086)0755-653814</a></dd>-->
						</dl>
					</li>					
				</ul>
			</div>			
		</div>
	</div>
	<div class="footer_nr2">© 2016 Qedertek.Inc All right reserved</div>
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









