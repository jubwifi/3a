<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\ChkPttype */

$this->title = 'Create Chk Pttype';
$this->params['breadcrumbs'][] = ['label' => 'Chk Pttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chk-pttype-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
