<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>
<!-- Calendar -->
<div class="box box-solid bg-green-gradient">
    <div class="box-header">
        <i class='fa fa-check-square-o'></i>

        <h3 class="box-title">ตรวจสอบสิทธิ์</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">

            </div>

            <button type="button" id="close" class="btn btn-success btn-sm"> <i class="fa fa-times"></i>
            </button>
        </div>
    </div>




</div>



<div class="panel panel-default">
  <div class="panel-body">
    <?php
        $gridColumns = [
                [
                'attribute' => 'tt',
                'label' => 'รายการ'
            ], [
                'attribute' => 't2',
                'label' => 'ข้อมูล'
            ]
        ];

        echo '<div class="col-md-12" align="right" >';
        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns
        ]);
        echo '</div>';
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
            'resizableColumns' => true,
            'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
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
  <div class="panel-footer">
      <button type="button" class='btn btn-danger' id="btnedit">ปรับสิททธิ์</button>
      <button type="button" id="close2" class="btn btn-danger  pull-right" data-dismiss="modal">Close</button>
  
  </div>
</div>


<?php
//$vstdate = '2017-03-28';
$script = <<< JS
$('#close').click(function() {
                       window.location="./index.php?r=chk/importhis&vstdate="+'$vstdate';  
                });
$('#close2').click(function() {
                      window.location="./index.php?r=chk/importhis&vstdate="+'$vstdate';  
                });

JS;
$this->registerJs($script);
?>