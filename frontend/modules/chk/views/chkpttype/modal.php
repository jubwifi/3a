<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\ChkPttype */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-solid bg-green-gradient">
    <div class="box-header">
        <i class='fa fa-check-square-o'></i>

        <h3 class="box-title">ตั่งค่า</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">

            </div>

            <button type="button" id="close" class="btn btn-success btn-sm"> <i class="fa fa-times"></i>
            </button>
        </div>
    </div>

    <?php
    $connection = Yii::$app->db;
    
    $sql = "select * from chk_pttype where pttype='$pttype' ";


    $data = $connection->createCommand($sql)
            ->queryAll();
    for ($i = 0; $i < sizeof($data); $i++) {
        $pttype = $data[$i]['pttype'];
        $name = $data[$i]['name'];
        $hmain = $data[$i]['hmain'];
        $chk_pttype = $data[$i]['chk_pttype'];
        $pp = $data[$i]['pp'];
        $sso = $data[$i]['sso'];
        $claim = $data[$i]['claim'];
        $null_sps = $data[$i]['null_sps'];
        $paist = $data[$i]['paist'];
        $aid = $data[$i]['aid'];
        $health = $data[$i]['health'];
        $nhso_code = $data[$i]['nhso_code'];
        $hipdata_code = $data[$i]['hipdata_code'];
        
        if($hmain=='N'){ $hmain=0;}else{ $hmain=1;}
        if($chk_pttype=='N'){ $chk_pttype=0;}else{ $chk_pttype=1;}
        if($pp=='N'){ $pp=0;}else{ $pp=1;}
        if($sso=='N'){ $sso=0;}else{ $sso=1;}
        if($claim=='N'){ $claim=0;}else{ $claim=1;}
        if($null_sps=='N'){ $null_sps=0;}else{ $null_sps=1;}
        if($paist=='N'){ $paist=0;}else{ $paist=1;}
        if($aid=='N'){ $aid=0;}else{ $aid=1;}
        if($health=='N'){ $health=0;}else{ $health=1;}
        if($nhso_code=='N'){ $nhso_code=0;}else{ $nhso_code=1;}
        if($hipdata_code=='N'){ $hipdata_code=0;}else{ $hipdata_code=1;}
    }
    ?>


</div>

<div class="panel panel-default">
    <div class="panel-body">
       

        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>ตรวจสอบสิทธิ</label>
                    <?=
                    Select2::widget([
                        'name' => 'chk_pttype',
                        'value' => $chk_pttype,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>ตรวจสอบสิทธิ</label>
                    <?=
                    Select2::widget([
                        'name' => 'chk_pttype',
                        'value' => $chk_pttype,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>PP</label>
                    <?=
                    Select2::widget([
                        'name' => 'pp',
                        'value' => $pp,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>พรบ./ประกัน</label>
                    <?=
                    Select2::widget([
                        'name' => 'sso',
                        'value' => $sso,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>
         
            <div class="col-lg-3">
                <div class="form-group">
                    <label>จ่ายตรง/e-claim</label>
                    <?=
                    Select2::widget([
                        'name' => 'claim',
                        'value' => $claim,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label>สิทธิว่าง(สปสช.)</label>
                    <?=
                    Select2::widget([
                        'name' => 'null_sps',
                        'value' => $null_sps,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label>ลูกหนี้สิทธิ</label>
                    <?=
                    Select2::widget([
                        'name' => 'paist',
                        'value' => $paist,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label>สงเคราะห์</label>
                    <?=
                    Select2::widget([
                        'name' => 'aid',
                        'value' => $aid,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label>ตรวจสุขภาพ</label>
                    <?=
                    Select2::widget([
                        'name' => 'health',
                        'value' => $health,
                        'data' => ['N', 'Y'],
                        'options' => ['multiple' => false, 'placeholder' => '<--คลิก/พิมพ์เลือก-->']
                    ]);
                    ?> 


                </div>
            </div>



        </div>
        <div class="row">
            <div class="col-lg-3">
                
            </div>
            <div class="col-lg-3">
                
            </div>
        </div>








    </div>
    <div class="modal-footer">


        <button type="button" id="edit" class="btn btn-info  pull-left" data-dismiss="modal">บันทึก</button>
        <button type="button" id="close2" class="btn btn-danger  pull-right" data-dismiss="modal">ปิด</button>

    </div>

   
</div>




<?php
//$vstdate = '2017-03-28';
$script = <<< JS
$('#close').click(function() {
                       window.location="./index.php?r=chk/gpttype";  
                });
$('#close2').click(function() {
                      window.location="./index.php?r=chk/gpttype";  
                });
        
        

JS;
$this->registerJs($script);
?>