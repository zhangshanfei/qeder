<?php use \yii\helpers\Url;?>
<?php
         $this->registerMetaTag(['name' => 'description', 'content' => isset($cateinfo['meta_descr']) ? $cateinfo['meta_descr'] : '' ]); 
         $this->registerMetaTag(['name' => 'keywords', 'content' => isset($cateinfo['meta_keywords']) ? $cateinfo['meta_keywords'] : '']);
         $this->title = isset($cateinfo['meta_title']) ? $cateinfo['meta_title'] : '';
?>

<div class="main" id="main">
	<div class="product_banner">
		<img src="<?php echo \Yii::$app->homeUrl?>images/product_banner.jpg" />
	</div>
	
		<div class="container">
			<ol class="breadcrumb xs-margin0">
			    <li><a href="<?php echo Url::home()?>"><i class="icon-home"></i></a></li>
			    <li> <a href="<?php echo Url::to(['products/'])?>">Products</a></li>
			    <li class="active"><?php echo $keywords?></li>
			</ol>
			<div class="product_nr row">
				<ul class="clearfix">
					<?php foreach($prods as $prod):?>
					<li class="col-sm-6 col-sm-4">
						<a href="<?php echo yii\helpers\Url::to(['products/detail','productid'=> $prod['productid']])?>">
							<div class="pro_display">
								<div class="pro_imgBox"><img src="<?php echo $prod['cover']?>" /></div>
								<p class="ptextsm"><?php echo $prod['title']?></p>
							</div>
						</a>
					</li>
					<?php endforeach;?>
			 	</ul>
			</div>
			<div class="page_fy">
				 <?php echo yii\widgets\LinkPager::widget([
                     		   'pagination' => $pager,
                       		   'prevPageLabel' => '&#8249;',
                        	   'nextPageLabel' => '&#8250;',
                   		 ]); ?>
			</div>
		</div>
	</div>
<?php
$js = <<<JS
	setMenu(1);
JS;
$this->registerJs($js);
?>
