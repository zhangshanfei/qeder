<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    $this->title = '添加分类';
    $this->params['breadcrumbs'][] = ['label' => '分类管理', 'url' => ['/admin/category/list']];
    $this->params['breadcrumbs'][] = $this->title;
    $this->registerCssFile('admin/css/compiled/new-user.css');
?>
    <!-- main container -->
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>添加新分类</h3>
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
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
                                echo $form->field($model, 'parentid')->dropDownList($list);
                                echo $form->field($model, 'title')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'meta_title')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'meta_keywords')->textarea(['class' => 'span9','rows' => 10]);
                                echo $form->field($model, 'meta_descr')->textarea(['class' => 'span9','rows' => 20]);
                                ?>
                                <div class="span11 field-box actions">
                                    <?php echo Html::submitButton('添加', ['class' => 'btn-glow primary']); ?>
                                    <span>OR</span>
                                    <?php echo Html::resetButton('取消', ['class' => 'reset']); ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <!-- side right column -->
                    <div class="span3 form-sidebar pull-right">
                        <div class="alert alert-info hidden-tablet">
                            <i class="icon-lightbulb pull-left"></i>
                            请在左侧表单当中填写要添加的分类，请选择好上级分类
                        </div>                        
                        <h6>商城分类说明</h6>
                        <p>该分类为无限级分类</p>
                    </div>
                </div>
            </div>
        </div>
    <!-- end main container -->

