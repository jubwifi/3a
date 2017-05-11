<?php
/* @var $this yii\web\View */

use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use yii\bootstrap\Dropdown;
use kartik\select2\Select2;

$model = '';
$this->title = 'AAA | ';
?>
<h2><i class="fa  fa-cloud-download"></i> นำเข้าข้อมูลจากระบบ HIS  </h2>



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
                                /* echo ' ถึง ';
                                  echo yii\jui\DatePicker::widget([
                                  'name' => 'date2',
                                  'value' => $date2,
                                  'language' => 'th',
                                  'dateFormat' => 'yyyy-MM-dd',
                                  'clientOptions' => [
                                  'changeMonth' => true,
                                  'changeYear' => true,
                                  //'dateFormat' => 'yy-mm-dd'
                                  ],
                                  ]); */
                                ?>

                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>ประเภทผู้ป่วย : </label>
                                <?=
                                Select2::widget([
                                    'name' => 'type',
                                    'value' => $type,
                                    'data' => ['OPD', 'IPD'],
                                    'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                                ]);
                                ?>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <br>
                            <div class="form-group">

                                <input type="checkbox"  name="n_update" value="0"  style="width:20px; height:20px;" >
                                &nbsp;&nbsp;<label>อัพเดทข้อมูลใหม่ </label>
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




                        <!-- /.box-header -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($type == '0') { ?> 
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class='fa fa-wheelchair'></i> &nbsp;ผู้ป่วยที่มารับบริการในวันที่ <?= $date1 ?> OPD</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $gridColumns = [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                            'attribute' => 'hn',
                            'label' => 'HN'
                        ],
                            [
                            'attribute' => 'cid',
                            'label' => 'CID'
                        ],
                            [
                            'attribute' => 'tname',
                            'label' => 'ชื่อ-สกุล'
                        ],
                            ['attribute' => 'pdx',
                            'label' => 'Pdx',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['pdx'] == null) {
                                    return "<span class='badge' style='background-color: #EC407A' >" . 'ว่าง' . " </span>";
                                } else {
                                    return "<span class='badge' style='background-color: #4CAF50' >" . $model['pdx'] . " </span>";
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                        //'width' => '150px',
                        //'noWrap' => true
                        ],
                            [
                            'attribute' => 'yname',
                            'label' => 'สิทธิติดตัว'
                        ],
                            ['attribute' => 'tck_pttype',
                            'label' => 'เช็คสิทธิ์',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['tck_pttype'] == 'N') {
                                    $vn = $model['vn'];
                                    $vstdate = $model['vstdate'];
                                    $cid = md5($model['cid']);
                                    return Html::a("<span class='badge' style='background-color: #F44336' ><i class='fa fa-times-circle'></i></span>", ['/chk/importhis/modalpop', 'vn' => $vn, 'vstdate' => $vstdate, 'id' => $cid], [
                                                'class' => 'activity-add-link',
                                                'title' => 'ตรวจสอบสิทธิ์การรักษา',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalvote',
                                                    //'data-whatever'=>$model['an'],
                                                    //'data-id' => $model['an'],
                                    ]);
                                } else {
                                    $vn = $model['vn'];
                                    $vstdate = $model['vstdate'];
                                    $cid = md5($model['cid']);
                                    return Html::a("<span class='badge' style='background-color: #4CAF50' ><i class='fa fa-check-square-o'></i></span>", ['/chk/importhis/modalpop', 'vn' => $vn, 'vstdate' => $vstdate, 'id' => $cid], [
                                                'class' => 'activity-add-link',
                                                'title' => 'ตรวจสอบสิทธิ์การรักษา',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalvote',
                                                    //'data-whatever'=>$model['an'],
                                                    //'data-id' => $model['an'],
                                    ]);
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                        //'width' => '150px',
                        //'noWrap' => true
                        ],
                            [
                            'attribute' => 'hospmain',
                            'label' => 'Hospmain'
                        ],
                            [
                            'attribute' => 'department',
                            'label' => 'แผนก'
                        ],
                            /*
                              [
                              'attribute' => 'an',
                              'label' => '#',
                              'value' => function($model, $key) {
                              $an ='';
                              $bed ='';
                              $ward = '';
                              return Html::a("<span class='bs-label bg-orange tooltip-button' style='background-color: #0099ff' ><i class='glyph-icon  icon-bell' ></i></span>", ['/food/foodadd/create', 'an' => $an, 'bed' => $bed, 'ward' => $ward], [
                              'class' => 'activity-add-link',
                              'title' => 'สั่งอาหาร',
                              'data-toggle' => 'modal',
                              'data-target' => '#modalvote',
                              //'data-whatever'=>$model['an'],
                              //'data-id' => $model['an'],
                              ]);
                              },
                              'filterType' => GridView::FILTER_COLOR,
                              'hAlign' => 'middle',
                              'format' => 'raw',
                              ], */
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
<?php } ?>


<?php if ($type == '1') { ?> 
    <div class="row">
        <div class="col-md-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title"> <i class='fa fa-wheelchair'></i> &nbsp;ผู้ป่วยที่มารับบริการในวันที่ <?= $date1 ?>  IPD</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <?php
                    $gridColumns = [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                            'attribute' => 'hn',
                            'label' => 'HN'
                        ],
                            [
                            'attribute' => 'cid',
                            'label' => 'CID'
                        ],
                            [
                            'attribute' => 'tname',
                            'label' => 'ชื่อ-สกุล'
                        ],
                            ['attribute' => 'pdx',
                            'label' => 'Pdx',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['pdx'] == null) {
                                    return "<span class='badge' style='background-color: #EC407A' >" . 'ว่าง' . " </span>";
                                } else {
                                    return "<span class='badge' style='background-color: #4CAF50' >" . $model['pdx'] . " </span>";
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                        //'width' => '150px',
                        //'noWrap' => true
                        ],
                            [
                            'attribute' => 'yname',
                            'label' => 'สิทธิติดตัว'
                        ],
                            ['attribute' => 'tck_pttype',
                            'label' => 'เช็คสิทธิ์',
                            //'options' => [ 'style' => 1==1 ? 'background-color:#FF0000':'background-color:#0000FF'],
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['tck_pttype'] == 'N') {
                                    $vn = $model['vn'];
                                    $vstdate = $model['vstdate'];
                                    $cid = md5($model['cid']);
                                    if ($model['type'] == 'opd') {
                                        return Html::a("<span class='badge' style='background-color: #F44336' ><i class='fa fa-times-circle'></i></span>", ['/chk/importhis/modalpop', 'vn' => $vn, 'vstdate' => $vstdate, 'id' => $cid], [
                                                    'class' => 'activity-add-link',
                                                    'title' => 'ตรวจสอบสิทธิ์การรักษา',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#modalvote',
                                        ]);
                                    } else {
                                        return Html::a("<span class='badge' style='background-color: #F44336' ><i class='fa fa-times-circle'></i></span>", ['/chk/importhis/modalpopipd', 'vn' => $vn, 'vstdate' => $vstdate, 'id' => $cid], [
                                                    'class' => 'activity-add-link',
                                                    'title' => 'ตรวจสอบสิทธิ์การรักษา',
                                                    'data-toggle' => 'modal',
                                                    'data-target' => '#modalvote',
                                        ]);
                                    }
                                } else {
                                    $vn = $model['vn'];
                                    $vstdate = $model['vstdate'];
                                    $cid = md5($model['cid']);
                                    return Html::a("<span class='badge' style='background-color: #4CAF50' ><i class='fa fa-check-square-o'></i></span>", ['/chk/importhis/modalpop', 'vn' => $vn, 'vstdate' => $vstdate, 'id' => $cid], [
                                                'class' => 'activity-add-link',
                                                'title' => 'ตรวจสอบสิทธิ์การรักษา',
                                                'data-toggle' => 'modal',
                                                'data-target' => '#modalvote',
                                                    //'data-whatever'=>$model['an'],
                                                    //'data-id' => $model['an'],
                                    ]);
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'middle',
                            'format' => 'raw',
                        //'width' => '150px',
                        //'noWrap' => true
                        ],
                            [
                            'attribute' => 'hospmain',
                            'label' => 'Hospmain'
                        ],
                            [
                            'attribute' => 'rw',
                            'label' => 'rw'
                        ],
                            /*
                              [
                              'attribute' => 'an',
                              'label' => '#',
                              'value' => function($model, $key) {
                              $an ='';
                              $bed ='';
                              $ward = '';
                              return Html::a("<span class='bs-label bg-orange tooltip-button' style='background-color: #0099ff' ><i class='glyph-icon  icon-bell' ></i></span>", ['/food/foodadd/create', 'an' => $an, 'bed' => $bed, 'ward' => $ward], [
                              'class' => 'activity-add-link',
                              'title' => 'สั่งอาหาร',
                              'data-toggle' => 'modal',
                              'data-target' => '#modalvote',
                              //'data-whatever'=>$model['an'],
                              //'data-id' => $model['an'],
                              ]);
                              },
                              'filterType' => GridView::FILTER_COLOR,
                              'hAlign' => 'middle',
                              'format' => 'raw',
                              ], */
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
<?php } ?>

<div class="modal remote fade " id="modalvote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content  "></div>
    </div>
</div>


<button class='btn btn-success' id="btnconfirm">Confirm Data</button>




<?php
$script = <<< JS
   
   var date1 = $date1;
        
    $('#btloading').on('click', function(e) {
    //document.getElementById("btloading").disabled = true; 
     $('#res').show(); 
     //
});
        
        
  $('#btnconfirm').click(function() {
        
       
        $.ajax({
            type: 'POST', url: './index.php?r=chk/importhis/btnconfirm&date1='+'$date1', dataType: 'json',
                data: {
                    
                    
                }, success: function(se) {
                    if(se>0){
                       
                      alert('บันทึกข้อมูลเรียบร้อยแล้ว');      
        }else{
        
                    alert('confirm แล้ว'); 
            }
                 }
        }); 
        
        
      
      
     
        
 });       
        
        
JS;
$this->registerJs($script);
?>


