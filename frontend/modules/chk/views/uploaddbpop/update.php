<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChkUploadDbpop */

$this->title = 'Update Chk Upload Dbpop: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chk Upload Dbpops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chk-upload-dbpop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
