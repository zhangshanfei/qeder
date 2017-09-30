<?php
	 $this->registerMetaTag(['name' => 'description', 'content' => $setting['siteDescription']]);
         $this->registerMetaTag(['name' => 'keywords', 'content' => $setting['siteKeywords']]);
	 $this->title = $setting['siteTitle'];
?>
<div class="main" id="main">
	<!--轮播图-->	
	<div id="carousel-example-generic" class="carousel slide both" data-ride="carousel">  
	  <!-- Indicators -->  
	            <ol class="carousel-indicators">  
	                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>  
	                <li data-target="#carousel-example-generic" data-slide-to="1"></li>  
	                <li data-target="#carousel-example-generic" data-slide-to="2"></li>  
	            </ol>  
	  
  <!-- Wrapper for slides -->  
            <div class="carousel-inner" role="listbox">  
                <div class="item active">  
                  <a href="<?php echo yii\helpers\Url::to(['products/detail','productid' => 70])?>"><img src="images/Banner1.jpg" /> </a>                     
                </div>  
                <div class="item">  
                   <a href="<?php echo yii\helpers\Url::to(['products/','cateid' => 2])?>"><img src="images/Banner2.jpg" /></a>                        
                </div>  
                <div class="item">  
                   <a href="<?php echo yii\helpers\Url::to(['information/promotion'])?>"><img src="images/Banner3.jpg" /></a>                      
                </div>      
            </div>  
            <!-- Controls -->  
            <a id="carleft" class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">  
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>  
                <span class="sr-only">Previous</span>  
            </a>  
            <a id="carright" class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">  
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>  
                <span class="sr-only">Next</span>  
            </a>  
        </div>  

<!--轮播图结束-->
		
		<div class="container cc margin30">			
			<div class="box">
				<div class="box1 col-sm-12 col-md-6">
					<a href="<?php echo \yii\helpers\Url::to(['information/promotion'])?>">
						<div class="left">
							<img src="images/p1.jpg" />					
						</div>
						<div class="right">
							<div class="padding20">
								<p class="p1">Qedertek 100-Round Giveaways</p>
								<p class="p2">10 winners every day. Prize are various. Big Surprise. </p>
								<span class="span1">More>></span>
							</div>
						</div>
					</a>
				</div>
				<div class="box1 box2 col-sm-12 col-md-6">
					<a href="<?php echo \yii\helpers\Url::to(['information/sale'])?>">
						<div class="left">
							<img src="images/p2.jpg" />						
						</div>
						<div class="right">
							<div class="padding20">
								<p class="p1">Up to 90% OFF</p>
								<p class="p2">Lowest prices ever! First Come, First Served!</p>
								<span class="span1">More>></span>
							</div>
						</div>
					</a>
				</div>
				<div class="box1 box2 col-sm-12 col-md-6">
					<a href="<?php echo \yii\helpers\Url::to(['information/deals'])?>">
						<div class="left">
							<div class="padding20">
								<p class="p1">Amazon Deals</p>
								<p class="p2">Click to copy the coupon codes of your selected products. Up to 70% OFF.</p>
								<span class="span1">More>></span>
							</div>
						</div>
						<div class="right"><img src="images/p3.jpg" /></div>
					</a>
				</div>
				<div class="box1 col-sm-12 col-md-6">
					<a href="<?php echo \yii\helpers\Url::to(['products/detail','productid' => 35])?>">
						<div class="left">
							<div class="padding20">
								<p class="p1">New Arrival</p>
								<p class="p2">Be the first to test our new products. Your better choice!</p>
								<span class="span1">More>></span>
							</div>
						</div>
						<div class="right"><img src="images/p4.jpg" /></div>
					</a>
				</div>
			</div>	
			
		</div>
	</div>
<?php
$js = <<<JS
	setMenu(0);
JS;
$this->registerJs($js);
?>
