<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ChkUploadDbpop */

$this->title = 'Import dbpop';
$this->params['breadcrumbs'][] = ['label' => 'Chk Upload Dbpops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chk-upload-dbpop-create">

    <h1><i class="fa fa-arrow-circle-o-down text-success"></i> นำเข้าข้อมูล dbpop ไฟล์ ADD ทั้งหมด</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
