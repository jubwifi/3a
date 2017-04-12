<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2

/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\CPttype */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-solid bg-green-gradient">
    <div class="box-header">
        <i class='fa fa-check-square-o'></i>

        <h3 class="box-title">ตั่งค่า</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">

            </div>

            <button type="button" id="close" class="btn btn-success btn-sm"> <i class="fa fa-times"></i>
            </button>
        </div>
    </div>


</div>

<?php
    if($model->hmain=='N'){ $model->hmain=0;}else{ $model->hmain=1;}
?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php $form = ActiveForm::begin(['id' => 'foodF']); ?>
        <div class="row">
            <div class="col-lg-3">
                <?=
                $form->field($model, 'hmain')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->hmain ],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
            <div class="col-lg-3">
                <?=
                $form->field($model, 'chk_pttype')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => 0],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 
            </div>
            <div class="col-lg-3">
               
            </div>
            <div class="col-lg-3">
                
            </div>

            <div class="col-lg-3">
               
                
            </div>

            <div class="col-lg-3">
                
            </div>

            <div class="col-lg-3">
                
                
            </div>

            <div class="col-lg-3">
               
                
            </div>

            <div class="col-lg-3">
                
                
            </div>



        </div>





    </div>
</div>



<div class="col-lg-4">

    <?= $form->field($model, 'pttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

</div>



<?= $form->field($model, 'hmain')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'chk_pttype')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'pp')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'sso')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'claim')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'null_sps')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'paist')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'aid')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'health')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nhso_code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'hipdata_code')->textInput(['maxlength' => true]) ?>

<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
