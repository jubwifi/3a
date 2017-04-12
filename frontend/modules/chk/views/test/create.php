<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\CPttype */

$this->title = 'Create Cpttype';
$this->params['breadcrumbs'][] = ['label' => 'Cpttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
