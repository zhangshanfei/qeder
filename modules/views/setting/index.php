<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title ="设置";
$this->params['breadcrumbs'][] = $this->title;
?>
<!DOCTYPE html>
 <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>设置</h3>
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">

				<ul id="myTab" class="nav nav-tabs">
					<li class="active">
						<a href="#siteinfo" data-toggle="tab">
							 网站信息
						</a>
					</li>
					<li><a href="#smtp" data-toggle="tab">SMTP</a></li>
				</ul>
				<?php
                                if (Yii::$app->session->hasFlash('info')) {
                                    echo Yii::$app->session->getFlash('info');
                                }
                                $form = ActiveForm::begin([
                                    'fieldConfig' => [
                                        'template' => '<div class="span12 field-box">{label}{input}</div>{error}',
                                    ],
                                    'options' => [
                                        'class' => 'new_user_form inline-input',
                                    ],
                                ]);
                                ?>

				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade in active" id="siteinfo">
						<?php echo Html::label('站点标题',null).Html::textInput('siteTitle',$settings['siteTitle'],['class' => 'span9']);?>
						<?php echo Html::label('站点名称',null).Html::textInput('siteName',$settings['siteName'],['class' => 'span9']);?>
						<?php echo Html::label('站点关键词',null).Html::textInput('siteKeywords',$settings['siteKeywords'],['class' => 'span9']);?>
						<?php echo Html::label('站点描述',null).Html::textarea('siteDescription',$settings['siteDescription'],['class' => 'span9','rows'=>10]);?>
                                		<div class="span11 field-box actions">
						<?php echo Html::submitButton('添加', ['class' => 'btn-glow primary']); ?>
						</div>
					</div>
					<div class="tab-pane fade" id="smtp">
						 <?php echo Html::label('服务器',null).Html::textInput('smtpHost',$settings['smtpHost'],['class' => 'span9']);?>
                                                <?php echo Html::label('端口',null).Html::textInput('smtpPort',$settings['smtpPort'],['class' => 'span9']);?>
                                                <?php echo Html::label('用户名',null).Html::textInput('smtpUser',$settings['smtpUser'],['class' => 'span9']);?>
                                                <?php echo Html::label('密码',null).Html::passwordInput('smtpPassword',$settings['smtpPassword'],['class' => 'span9']);?>
                                                <div class="span11 field-box actions">
                                                <?php echo Html::submitButton('添加', ['class' => 'btn-glow primary']); ?>
                                                </div>
					</div>
				</div>
				<?php ActiveForm::end(); ?>
			 </div>
                    </div> 
            </div>
        </div>
    <!-- end main container -->

