<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChkUploadDbpopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chk Upload Dbpops';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chk-upload-dbpop-index">

    <h1>ข้อมูลการนำเข้าฐาน dbpop ทั้งหมด</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-body">
                    <p>
                        
                         <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-upload"></span> นำเข้าข้อมูลใหม่ Remove'), ['create'], ['class' => 'btn btn-danger']) ?>
                         <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-upload"></span> นำเข้าข้อมูลใหม่ ADD'), ['createadd'], ['class' => 'btn btn-success']) ?>
                    </p>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'tyear',
                            'tmonth',
                            'name',
                                ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>
