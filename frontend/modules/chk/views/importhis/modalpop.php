


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



<?php

$vstdate = '2017-03-28';
$script = <<< JS
$('#close').click(function() {
                       window.location="./index.php?r=chk/importhis&vstdate="+'$vstdate';  
                });

JS;
$this->registerJs($script);
?>

<?=$vn?>
<?=$vn?>
<?=$vn?><?=$vn?>
