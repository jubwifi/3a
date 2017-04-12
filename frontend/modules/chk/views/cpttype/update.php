<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\CPttype */

$this->title = 'Update Cpttype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cpttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->pttype]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cpttype-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
