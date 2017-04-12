<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\CPttype */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="panel panel-default">
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-2">
                <?= $form->field($model, 'pttype')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-10">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-2">
                <?=
                $form->field($model, 'hmain')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->hmain],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
            <div class="col-lg-2">
                <?=
                $form->field($model, 'chk_pttype')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->chk_pttype],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
            <div class="col-lg-2">
                <?=
                $form->field($model, 'pp')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->pp],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
            <div class="col-lg-2">
                <?=
                $form->field($model, 'sso')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->sso],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
            <div class="col-lg-2">
                <?=
                $form->field($model, 'claim')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->claim],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
            <div class="col-lg-2">
                <?=
                $form->field($model, 'null_sps')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->null_sps],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
        </div>
        <div class="row">

            <div class="col-lg-2">
                <?=
                $form->field($model, 'paist')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->paist],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
            <div class="col-lg-2">
                <?=
                $form->field($model, 'aid')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--คลิก/พิมพ์เลือก-->',
                        'value' => $model->aid],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
            <div class="col-lg-2">
                <?=
                $form->field($model, 'health')->widget(Select2::className(), ['data' => ['N', 'Y'],
                    'options' => [
                        'placeholder' => '<--เลือก-->',
                        'value' => $model->health],
                    'pluginOptions' =>
                        [
                        'allowClear' => true
                    ],
                ]);
                ?> 

            </div>
        </div>


        <div class="row">
            <div class="col-lg-2">
                <?= $form->field($model, 'nhso_code')->textInput(['maxlength' => true]) ?>
            </div> 
        </div>

        <div class="row">
            <div class="col-lg-2">
               <?= $form->field($model, 'hipdata_code')->textInput(['maxlength' => true]) ?>
            </div> 
        </div>

        

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-primary']) ?>
        </div>



    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-danger" id="close2" data-dismiss="modal">ปิด</button>
</div>

<?php ActiveForm::end(); ?>


<?php
//$vstdate = '2017-03-28';
$script = <<< JS
$('#close2').click(function() {
                       window.location="./index.php?r=chk/gpttype";  
                });

        

JS;
$this->registerJs($script);
?>
