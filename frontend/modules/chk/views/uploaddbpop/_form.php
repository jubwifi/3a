<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use app\models\AaaMonth;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\ChkUploadDbpop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <?= $form->field($model, 'id')->hiddenInput(['maxlength' => true, 'value' => NULL])->label(FALSE); ?>
                <div class="row">
                    <div class="col-md-2"> 
                        <?=
                        $form->field($model, 'tyear')->dropDownList(['2559' => '2559',
                            '2560' => '2560',
                            '2561' => '2561',
                            '2562' => '2562',
                            '2563' => '2563',], ['prompt' => ''])
                        ?>
                    </div>
                    <div class="col-md-2"> 
                        <?=
                        $form->field($model, 'tmonth')->widget(Select2::className(), ['data' =>
                            ArrayHelper::map(app\models\AaaMonth::find()->all(), 'code', 'name'),
                            'options' => [
                                'placeholder' => '<--คลิก/พิมพ์เลือก-->'],
                            'pluginOptions' =>
                                [
                                'allowClear' => true
                            ],
                        ]);
                        ?> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"> 


                        <?=
                        $form->field($model, 'name')->widget(FileInput::classname(), [
                            //'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreview' => [],
                                'allowedFileExtensions' => ['zip'],
                                'showPreview' => TRUE,
                                'showUpload' => false
                            ]
                        ]);
                        ?>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div id="res"   class="col-md-4"  style="display: none">
                        <h2>รอสักครู่.....</h2>
                        <img src="../../assets/images/l1.gif"   height="120" width="120">
                    </div>
                    <br>
                </div>
                <br>
                
                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? 'นำเข้า' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'btloading']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


<?php
$script = <<< JS
    $('#btloading').on('click', function(e) {
    //document.getElementById("btloading").disabled = true; 
     $('#res').show(); 
     //
});
JS;
$this->registerJs($script);
?>