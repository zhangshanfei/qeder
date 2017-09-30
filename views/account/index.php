<?php 
use yii\bootstrap\ActiveForm;
use app\models\LoginForm;
use yii\helpers\Html;
use yii\helpers\Url;
$model = new LoginForm();
?>
<div class="main" id="main">
		<div class="container">
			<ol class="breadcrumb xs-margin0">
			    <li><a href="<?php echo Url::home()?>"><i class="icon-home"></i></a></li>
			    <li>User Center</li>
			</ol>	
			<div class="usercenter">
				<div class="row">
					<?php echo $this->render('_left')?>
				<div class="col-main col-xs-12 col-sm-9">
	                <div class="account_box">
	                    <div class="a_box">
	                        <div class="info form">
	                             <div class="member_client">
	                                <div class="client_box">
	                                    <div class="client_lr">
	                                        <p class="ft16">welcome</p>
	                                    <table class="data-table">
	                                        <tbody>
		                                        <tr>
		                                            <td width="20%" style="padding:20px">Account</td>
		                                            <td style="padding:20px"><?php echo Yii::$app->user->identity->useremail ?></td>
		                                        </tr>
	                                           <!-- <tr>
		                                            <td width="20%" style="padding:20px">Coupons</td>
		                                            <td style="padding:20px">Total 0, value $ 0.00</td>
	                                       		</tr>
		                                        <tr>
		                                            <td style="padding:20px">Notice:</td>
		                                            <td style="padding:20px">In recent 30 days, your have submitted 0 order(s)                                     </td>
		                                        </tr>-->
	                                   		</tbody>
	                                    </table>	
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
		            </div>
		            </div>
        </div>
			</div>
		</div>
</div>
