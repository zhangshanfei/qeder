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
			    <?php if(!$cnames){?>
			    <li class="active">Products</li>
			    <?php }else{?>
			    <li> <a href="<?php echo Url::to(['products/'])?>">Products</a></li>
				<?php foreach(array_reverse($cnames) as $key=>$cname):?>
				<?php if(0 == $key && count($cnames) != 1){?>
			   	 <li><a href="<?php echo Url::to(['products/index','cateid'=>$cname['cateid']])?>"><?php echo $cname['title']?></a></li>
				<?php }else{ ?>
			   	 <li class="active"><?php echo $cname['title']?></a></li>
				<?php } endforeach;?>
			    <?php }?>
			</ol>
			<div class="product_nav row">
				<ul class="clearfix">
					<?php foreach($childs as $child):?>
					<li class="col-md-3 col-sm-4 col-xs-5"><a href="<?php echo Url::to(['products/index','cateid' => $child['id']])?>"><?php echo $child['text'] ?></a></li>
					<?php endforeach;?>
				<!--	<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor na2</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoorna3</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor nna4</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor TV An5</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor TV Antn6</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor TV Anenna</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor TV Anna2</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor TV Anna3</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor TV Ant4</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor n5</a></li>
					<li class="col-md-2 col-sm-3 col-xs-6"><a href="products_list.html">Indoor tenn6</a></li>-->
				</ul>
			</div>
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
				<!--<ul class="pagination">
					<li><a href="#">&laquo; Previous</a></li>
				    <li><a href="#">1</a></li>
				    <li><a href="#">2</a></li>
				    <li><a href="#">3</a></li>
				    <li><a href="#">4</a></li>
				    <li><a href="#">5</a></li>
				    <li><a href="#">Next &raquo;</a></li>
				</ul>-->
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
