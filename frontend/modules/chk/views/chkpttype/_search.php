<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\ChkPttypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chk-pttype-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pttype') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'hmain') ?>

    <?= $form->field($model, 'chk_pttype') ?>

    <?= $form->field($model, 'pp') ?>

    <?php // echo $form->field($model, 'sso') ?>

    <?php // echo $form->field($model, 'claim') ?>

    <?php // echo $form->field($model, 'null_sps') ?>

    <?php // echo $form->field($model, 'paist') ?>

    <?php // echo $form->field($model, 'aid') ?>

    <?php // echo $form->field($model, 'health') ?>

    <?php // echo $form->field($model, 'nhso_code') ?>

    <?php // echo $form->field($model, 'hipdata_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
