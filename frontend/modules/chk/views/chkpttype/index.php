<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\chk\models\ChkPttypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chk Pttypes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chk-pttype-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Chk Pttype', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pttype',
            'name',
            'hmain',
            'chk_pttype',
            'pp',
            // 'sso',
            // 'claim',
            // 'null_sps',
            // 'paist',
            // 'aid',
            // 'health',
            // 'nhso_code',
            // 'hipdata_code',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
