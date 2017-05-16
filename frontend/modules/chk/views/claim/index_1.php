<?php
/* @var $this yii\web\View */

use yii\bootstrap\Html;
use kartik\grid\GridView;
use kartik\tabs\TabsX;
?>
<h1>แบ่งหมวดค่ารักษาพยาบาล เพื่อเรียกเก็บ</h1>






<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                <div class="container">
                    <div class="row">
                        <?= Html::beginForm(); ?>
                        <div class="col-md-2">
                            <label>เลือกวันที่ : </label>
                            <div class="form-group" >

                                <?php
                                echo yii\jui\DatePicker::widget([
                                    'name' => 'date1',
                                    'value' => $date1,
                                    'language' => 'th',
                                    'dateFormat' => 'yyyy-MM-dd',
                                    'clientOptions' => [
                                        'changeMonth' => true,
                                        'changeYear' => true,
                                    //'dateFormat' => 'yy-mm-dd'
                                    ],
                                ]);
                                ?>

                            </div>
                        </div>

                        <div class="col-md-2">
                            <br>
                            &nbsp;&nbsp;<button class='btn btn-danger' id="btloading">ประมวลผล</button>
                        </div>
                        <div id="res"   class="col-md-2" style="display: none">
                            <img src="../../assets/images/l1.gif"   height="80" width="80">
                        </div>
                        <?= Html::endForm(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-th-large"></i>&nbsp;&nbsp; รายละเอียด</div>
            <div class="panel-body">
                <div class="col-md-4">
                <?php
                echo TabsX::widget([
                    'position' => TabsX::POS_ABOVE,
                    'align' => TabsX::ALIGN_LEFT,
                    'items' => [
                            [
                            'label' => 'OPD',
                            'content' => $this->render('left', [
                               
                            ]),
                        ],
                    ]
                ]);
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

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
                $command = Yii::$app->db->createCommand("SELECT COUNT(vn)  FROM chk_ovst_confirm WHERE vstdate='$date1'");
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


    <?php if ($acc <> '0') { ?>

        <div class="col-md-9">
            <?php
            echo \kartik\grid\GridView::widget([
                'dataProvider' => $dataProvider2,
                'responsive' => TRUE,
                'hover' => true,
                'floatHeader' => true,
                'panel' => [
                    'before' => '',
                    'type' => \kartik\grid\GridView::TYPE_PRIMARY,
                ],
                'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],
                        [
                        'attribute' => 'vstdate',
                        'label' => 'วันที่มารับ',
                    ],
                        [
                        'attribute' => 'hn',
                        'label' => 'HN',
                    ],
                        [
                        'attribute' => 'tname',
                        'label' => 'ชื่อ-สกุล',
                    ],
                        [
                        'attribute' => 'hospmain',
                        'label' => 'hospmain',
                    ],
                        [
                        'attribute' => 'pdx',
                        'label' => 'Pdx',
                    ],
                        [
                        'attribute' => 'nhso_pttype',
                        'label' => 'Hipdata',
                    ],
                        [
                        'attribute' => 'paid_money',
                        'label' => 'paid_money',
                    ],
                        [
                        'attribute' => 'uc_money',
                        'label' => 'uc_money',
                    ],
                ],
                'toolbar' => [
                    '{export}',
                ],
                'export' => [
                    'fontAwesome' => true
                ],
            ]);
            ?>
        </div>

    <?php } ?>
</div>