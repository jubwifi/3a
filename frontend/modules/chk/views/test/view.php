<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\CPttype */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cpttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cpttype-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pttype], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pttype], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pttype',
            'name',
            'hmain',
            'chk_pttype',
            'pp',
            'sso',
            'claim',
            'null_sps',
            'paist',
            'aid',
            'health',
            'nhso_code',
            'hipdata_code',
        ],
    ]) ?>

</div>
