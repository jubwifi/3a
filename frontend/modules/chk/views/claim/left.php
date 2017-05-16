<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\grid\GridView;
use kartik\tabs\TabsX;
?>







<div class="row">

    <div class="col-md-3">
        <div class="box box-info box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">ระบบ</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">

                <?php
                $command = Yii::$app->db->createCommand("SELECT COUNT(vn)  FROM chk_ovst_confirm WHERE vstdate='11'");
                $c_total = $command->queryScalar();

                $gridColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                        'attribute' => 'groupname',
                        'label' => 'กลุ่ม',
                    //'pageSummary' => 'รวมทั้งหมด',
                    //'headerOptions' => ['class' => 'text-center'],
                    ],
                        ['attribute' => 'tcount',
                        'label' => 'จำนวน\ครั้ง',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            $acc = $model['claimgroup'];
                            $date1 = $model['vstdate'];
                            if ($model['tcount'] > 0) {
                                return Html::a("<span class='badge' style='background-color: #EC407A' >" . $model['tcount'] . "</span>", ['/chk/claim', 'date1' => $date1, 'acc' => $acc], [
                                ]);
                            } else {
                                return "<span class='badge' style='background-color: #4CAF50' >" . $model['tcount'] . " </span>";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'right',
                        'format' => 'raw',
                    // 'pageSummary' => true,
                    // 'pageSummaryOptions' => ['id' => 'tcount'],
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                ];


                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'autoXlFormat' => true,
                    'summary' => '',
                    'responsive' => true,
                    'hover' => true,
                    'columns' => $gridColumns,
                    'resizableColumns' => true,
                ]);
                ?> 




                <h2>รวมทั้งหมด :  <?= $c_total ?> </h2>




            </div>
        </div>
    </div>


   
</div>