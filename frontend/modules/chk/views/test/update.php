<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\chk\models\CPttype */

$this->title = 'Update Cpttype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cpttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->pttype]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cpttype-update">

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


    </div>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>



<?php
//$vstdate = '2017-03-28';
$script = <<< JS
$('#close').click(function() {
                       window.location="./index.php?r=chk/gpttype";  
                });

        

JS;
$this->registerJs($script);
?>
