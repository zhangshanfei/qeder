<?php
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Alert;
    use yii\helpers\Html;
    $this->title = '商品添加';
    $this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['/admin/product/list']];
    $this->params['breadcrumbs'][] = $this->title;
    $css = <<<CSS
    .span8 div{
        display:inline;
    }
    .help-block-error {
        color:red;
        display:inline;
    }
CSS;
    $this->registerCss($css);
    $this->registerCssFile(\Yii::$app->homeUrl.'admin/css/compiled/new-user.css');
?>
    <!-- main container -->
        <div class="container-fluid">
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>添加商品</h3>
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
                                <?php
                                if (Yii::$app->session->hasFlash('info')) {
					echo  Alert::widget([
						'options' => [
							'class' => 'alert-success',
						],
                                    		'body' =>  Yii::$app->session->getFlash('info'),
					]);
                                }
                                $form = ActiveForm::begin([
                                    'fieldConfig' => [
                                        'template' => '<div class="span12 field-box">{label}{input}</div>{error}',
                                    ],
                                    'options' => [
                                        'class' => 'new_user_form inline-input',
                                        'enctype' => 'multipart/form-data'
                                    ],
                                ]);
                                echo $form->field($model, 'cateid')->dropDownList($opts, ['id' => 'cates']);
                                echo $form->field($model, 'title')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'descr')->textarea(['id' => "editor_desc", 'class' => "span9",'rows' => 40, 'style' => 'margin-left:120px']);
                                echo $form->field($model, 'short_descr')->textarea(['id' => "editor_short_desc", 'class' => "span9",'rows' => 40, 'style' => 'margin-left:120px']);
                                echo $form->field($model, 'faq')->textarea(['id' => "editor_faq", 'class' => "span9",'rows' => 40, 'style' => 'margin-left:120px']);
 				echo $form->field($model, 'meta_title')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'meta_keywords')->textarea(['class' => 'span9','rows' => 10]);
                                echo $form->field($model, 'meta_descr')->textarea(['class' => 'span9','rows' => 20]);
                                echo $form->field($model, 'amazon_url')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'walmart_url')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'ishot')->radioList([0 => '不热卖', 1 => '热卖'], ['class' => 'span8']);
                                echo $form->field($model, 'issale')->radioList(['不促销', '促销'], ['class' => 'span8']);
                                echo $form->field($model, 'price')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'saleprice')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'num')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'ison')->radioList(['下架', '上架'], ['class' => 'span8']);
                                echo $form->field($model, 'isrec')->radioList(['不推荐', '推荐'], ['class' => 'span8']);
                                echo $form->field($model, 'promotion_code')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'discount')->textInput(['class' => 'span9']);
                                echo $form->field($model, 'cover')->fileInput(['class' => 'span9']);
                                if (!empty($model->cover)):
                                ?>
                                    <img src="<?php echo $model->cover;?>-covermiddle">
                                    <hr>
                                <?php
                                    endif;
                                    echo $form->field($model, 'pics[]')->fileInput(['class' => 'span9', 'multiple' => true,]);
                                ?>
                                <?php
                                    foreach((array)json_decode($model->pics, true) as $k=>$pic) {
                                ?>
                                    <img src="<?php echo $pic ?>-coversmall">
                                    <a href="<?php echo yii\helpers\Url::to(['product/removepic', 'key' => $k, 'productid' => $model->productid]) ?>">删除</a>
                                <?php
                                }
                                ?>
                                <hr>
                                <input type='button' id="addpic" value='增加一个'>
                                <div class="span11 field-box actions">
                                    <?php echo Html::submitButton('提交', ['class' => 'btn-glow primary']); ?>
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
                            请在左侧表单当中填入要添加的商品信息,包括商品名称,描述,图片等
                        </div>                        
                        <h6>商城用户说明</h6>
                        <p>可以在前台进行购物</p>
                    </div>
                </div>
            </div>
        </div>
    <!-- end main container -->

<?php
$js = <<<JS
$("#addpic").click(function(){
    var pic = $("#product-pics").clone();
    pic.attr("style", "margin-left:120px");
    $("#product-pics").parent().append(pic);
});

KindEditor.ready(function(K) {
    window.editor = K.create('#editor_desc',{
      //uploadJson : 'admin.php?c=image&a=kindupload',
      afterBlur : function(){this.sync();}, //
    });
});

KindEditor.ready(function(K) {
    window.editor = K.create('#editor_short_desc',{
      //uploadJson : 'admin.php?c=image&a=kindupload',
      afterBlur : function(){this.sync();}, //
    });
});

KindEditor.ready(function(K) {
    window.editor = K.create('#editor_faq',{
      //uploadJson : 'admin.php?c=image&a=kindupload',
      afterBlur : function(){this.sync();}, //
    });
});

JS;
$this->registerJs($js);
?>




