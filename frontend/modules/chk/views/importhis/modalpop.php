<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;
?>
<!-- Calendar -->
<div class="box box-solid bg-green-gradient">
    <div class="box-header">
        <i class='fa fa-check-square-o'></i>

        <h3 class="box-title">ตรวจสอบสิทธิ์ <?= $id ?></h3>
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
        $connection = Yii::$app->db;

        $tname = "";
        $prov = "";
        $MainInScl = "";
        $nhso_code = "";
        $hmain = "";
        $hsub = "";
        $t2 = "";
        $sqlt = "SELECT CONCAT(fname,' ',lname) AS tname1,prov,CONCAT(m.tname ,'(',d.MainInScl,')') AS MainInScl ,
				CONCAT(pttype_name ,'(',n.nhso_code,')') AS nhso_code,hmain,hsub,
				DATE_FORMAT(startdate,'%d/%m/%Y')  AS t2,o.tname
                FROM chk_dbpop  d
                LEFT JOIN aaa_maininscl m ON m.maininscl = d.MainInScl
                LEFT JOIN chk_nhso_inscl n ON n.nhso_code = d.SubInScl
                LEFT JOIN chk_ovst_log o ON o.cid = d.pid
                WHERE md5(pid)='$id'";

        $data = $connection->createCommand($sqlt)
                ->queryAll();
        for ($i = 0; $i < sizeof($data); $i++) {
            $tname = $data[$i]['tname'];
            $prov = $data[$i]['prov'];
            $MainInScl = $data[$i]['MainInScl'];
            $nhso_code = $data[$i]['nhso_code'];
            $hmain = $data[$i]['hmain'];
            $hsub = $data[$i]['hsub'];
            $t2 = $data[$i]['t2'];
        }
        ?>


        <table class="table table-striped table-hover">
            <thead class="thead-inverse">
                <tr bgcolor="ccccb3">

                    <th width="25%"  align="center"><b>รายการ</b></th>
                    <th width="40%" ><b>ข้อมูล สปสช.</b></th>
                    <th><b>ข้อมูล HIS</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><b>ชื่อ-สกุล</b></td>
                    <td> :<?= ' ' . $tname ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td><b>จังหวัดที่ลงทะเบียนรักษา</b></td>
                    <td> :<?= ' ' . $prov ?></td>
                    <td></td>
                </tr>

                <tr>
                    <td><b>สิทธิการรักษาพยาบาล</b></td>
                    <td> :<?= ' ' . $MainInScl ?></td>
                    <td> :<?= ' ' ?></td>
                </tr>
                <tr>
                    <td><b>ประเภทสิทธิย่อย</b></td>
                    <td> :<?= ' ' . $nhso_code ?></td>
                    <td> :<?= ' ' ?></td>
                </tr>
                <tr>
                    <td><b>รหัสบัตรประกันสุขภาพ</b></td>
                    <td> :<?= ' ' . $tname ?></td>
                    <td> :<?= ' ' ?></td>
                </tr>

                <tr>
                    <td><b>หน่วยบริการประจำ</b></td>
                    <td> :<?= ' ' . $hmain ?></td>
                    <td> :<?= ' ' ?></td>
                </tr>
                <tr>
                    <td><b>สถานยยาบาลรอง</b></td>
                    <td> :<?= $hsub ?></td>
                    <td> :<?= ' ' ?></td>
                </tr>
                <tr>
                    <td><b>วันที่เริ่มใช้สิทธิ</b></td>
                    <td> :<?= ' ' . $t2 ?></td>
                    <td> </td>
                </tr>


            </tbody>
        </table>


    </div>
    <div class="panel-footer">
        <button type="button" class='btn btn-danger' id="btnpttype">ปรับสิททธิ์</button>
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
        
        
  $('#btnpttype').click(function() {
        
       
        $.ajax({
            type: 'POST', url: './index.php?r=chk/importhis/cpttype&date1='+'$vstdate'+'&cid='+'$id', dataType: 'json',
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