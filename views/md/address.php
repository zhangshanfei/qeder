i<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="col-sm-7 address">
                                <p class="address_title">Shipping address</p>
                                <?php $form = ActiveForm::begin([
                                        'fieldConfig' => [
                                                'template' => '{input}{error}',
                                        ],
                                        'action' => ['mothersday/prize'],
                                ])?>
                                <div class="address_box clearfix">
                                        <div class="input_con col-sm-6">
                                                <div class="input_info">
                                                        <p>First name<span class="colorRed">*</span></p>
                                                        <?php echo $form->field($model, 'firstname')->textInput(['class' => 'input-box']);?>
                                                </div>
                                        </div>
                                        <div class="input_con col-sm-6">
                                                <div class="input_info">
                                                        <p>Last name<span class="colorRed">*</span></p>
                                                        <?php echo $form->field($model, 'lastname')->textInput(['class' => 'input-box']);?>
                                                </div>
                                        </div>
                                        <div class="input_con col-sm-12">
                                                <div class="input_info">
                                                        <p>Addredd line 1<span class="colorRed">*</span></p>
                                                        <?php echo $form->field($model, 'address1')->textInput(['class' => 'input-box']);?>
                                                </div>  
                                        </div>
                                        <div class="input_con col-sm-12">
												<div class="input_info">
                                                        <p>Address line 2</p>
                                                        <input type="text" class="input_box" />
                                                        <?php echo $form->field($model, 'address2')->textInput(['class' => 'input-box']);?>
                                                </div>
                                        </div>
                                        <div class="input_con col-sm-4">
                                                <div class="input_info">
                                                        <p>Country*<span class="colorRed">*</span></p>
                                                        <?php echo $form->field($model, 'country')->dropDownList(['1'=>'United States'],['class' => 'smll_select']);?>
                                                </div>
                                        </div>
                                        <div class="input_con col-sm-4">
                                                <div class="input_info">
                                                        <p>State<span class="colorRed">*</span></p>
                                                        <?php echo $form->field($model, 'province')->textInput(['class' => 'input-box']);?>
                                                </div>
                                        </div>
                                        <div class="input_con col-sm-4">
                                                <div class="input_info">
                                                        <p>City<span class="colorRed">*</span></p>
                                                        <?php echo $form->field($model, 'city')->textInput(['class' => 'input-box']);?>
                                                </div>
                                        </div>
                                        <div class="input_con col-sm-6">
                                                <div class="input_info">
                                                        <p>Phone number<span class="colorRed">*</span></p>
                                                        <?php echo $form->field($model, 'telephone')->textInput(['class' => 'input-box']);?>
                                                </div>
                                        </div>
                                        <div class="input_con col-sm-6">
                                                <div class="input_info">
                                                        <p>Zip code<span class="colorRed">*</span></p>
                                                        <?php echo $form->field($model, 'postalcode')->textInput(['class' => 'input-box']);?>
                                                </div>
                                        </div>

                                </div>
                            <div class="edit_but clearfix col-sm-12 row" >
                                    <?php echo Html::submitButton('SAVE', ['class' => 'edit_but1']); ?>
                            </div>
                                <?php ActiveForm::end()?>
                           </div>
