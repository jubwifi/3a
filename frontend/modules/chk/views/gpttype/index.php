<?php

use yii\bootstrap\Html;
use kartik\grid\GridView;
use app\modules\chk\models\ChkNhsoInscl;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">

                <?= Html::beginForm(); ?>

                <div class="col-md-2">
                    <br>
                    &nbsp;&nbsp;<button class='btn btn-info' id="btloading"><i class="fa  fa-cloud-download"></i> นำเข้าสิทธิ์จาก HIS</button>
                </div>

                <?= Html::endForm(); ?>


            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-danger">
            <div class="box-body">
                <?php
                $gridColumns = [
                        [
                        'attribute' => 'pttype',
                        'label' => 'Pttype'
                    ],
                        [
                        'attribute' => 'name',
                        'label' => 'ชื่อสิทธิ'
                    ],
                        ['attribute' => 'hmain',
                        'label' => 'Hmain',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['hmain'] == '1') {
                                return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        ['attribute' => 'chk_pttype',
                        'label' => 'ตรวจสอบสิทธิ',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['chk_pttype'] == '1') {
                               return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        ['attribute' => 'pp',
                        'label' => 'PP',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['pp'] == '1') {
                                 return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        ['attribute' => 'sso',
                        'label' => 'พรบ/ประกัน',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['sso'] == '1') {
                                return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        ['attribute' => 'claim',
                        'label' => 'จ่ายตรง/e-claim',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['claim'] == '1') {
                                 return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        ['attribute' => 'null_sps',
                        'label' => 'สิทธิว่าง(สปสช)',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['null_sps'] == '1') {
                                 return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        ['attribute' => 'paist',
                        'label' => 'ลูกหนี้สิทธิ',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['paist'] == '1') {
                                 return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        ['attribute' => 'aid',
                        'label' => 'สงเคราะห์',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['aid'] == '1') {
                                 return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                        ['attribute' => 'health',
                        'label' => 'ตรวจสุขภาพ',
                        //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                        'value' => function ($model, $key, $index, $widget) {
                            if ($model['health'] == '1') {
                                 return "<span class='badge' style='background-color: #EC407A' >Y</span>";
                            } else {
                                return "N";
                            }
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    //'width' => '150px',
                    //'noWrap' => true
                    ],
                                 [
                        'attribute' => 'nhso_code',
                        'label' => 'nhso_code'
                    ],
                                 [
                        'attribute' => 'hipdata_code',
                        'label' => 'hipdata_code'
                    ],
                                  [
                        'attribute' => 'ptype',
                        'label' => '#',
                        'value' => function($model, $key) {
                           $pttye= $model['pttype'];
                            return Html::a("<span class='badge' style='background-color: #0099ff' ><i class='fa  fa-sun-o'></i></span>", ['/chk/test/update', 'id' => $pttye], [
                                        'class' => 'activity-add-link',
                                        'title' => 'ตั่งค่า',
                                        'data-toggle' => 'modal',
                                        'data-target' => '#modalvote',
                                            //'data-whatever'=>$model['an'],
                                            //'data-id' => $model['an'],
                            ]);
                        },
                        'filterType' => GridView::FILTER_COLOR,
                        'hAlign' => 'middle',
                        'format' => 'raw',
                    ],
                ];
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'rowOptions' => function($model) {
                        
                    },
                    'autoXlFormat' => true,
                    'export' => [
                        'fontAwesome' => true,
                        'showConfirmAlert' => false,
                        'target' => GridView::TARGET_BLANK
                    ],
                    'columns' => $gridColumns,
                    'hover' => true,
                    'resizableColumns' => true,
                    //'floatHeader' => true,
                    //'floatHeaderOptions' => ['scrollingTop' => '100'],
                    'pjax' => true,
                    'pjaxSettings' => [
                        'neverTimeout' => true,
                    //'beforeGrid' => 'My fancy content before.',
                    //'afterGrid' => 'My fancy content after.',
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>


<div class="modal remote fade " id="modalvote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content  "></div>
    </div>
</div>