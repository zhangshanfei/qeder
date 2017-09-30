<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="main" id="main" style="background:#fe9dcd">
	<div class="product_banner">
		<img src="<?php echo \Yii::$app->homeUrl?>/mothersday/images/lg-s.png" />
	</div>
	
		<div class="container">
			<div class="product_nr row">
				<?php
				if($award == 2){
				    echo $this->render('product_60off');
				}else if($award == 3){
				    echo $this->render('product_40off');
				}else if($award == 4){
				    echo $this->render('product_20off');
				}
				?>
			</div>
		</div>
</div>

