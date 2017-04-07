<?php

namespace app\modules\chk\controllers;

use Yii;

class ImporthisController extends \yii\web\Controller {

    public function actionIndex() {
        $date1 = date('Y-m-d');
        $connection = Yii::$app->db2;
        $connectiond = Yii::$app->db;
        $type = '1';
        if (isset($_GET['vstdate'])) {
            $date1 = $_GET['vstdate'];
        }
        if (isset($_GET['page'])) {
            $date1 = Yii::$app->session['date1'];
        }
        if (Yii::$app->request->isPost) {
            if (isset($_POST['date1']) == '') {
                $date1 = Yii::$app->session['date1'];
            } else {

                $date1 = $_POST['date1'];
                Yii::$app->session['date1'] = $date1;
                $aa = 'test';
            }
        }
        if (isset($_GET['date1'])) {
            $date1 = Yii::$app->session['date1'];
        }






        if (isset($_POST['date1'])) {

            $datals = $connectiond->createCommand("DELETE FROM chk_ovst_log WHERE vstdate ='$date1'")->execute();
            $type = $_POST['type'];
            if ($_POST['type'] == '1') {

                $sql = "SELECT o.vstdate,o.vn,o.hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
			 v.pdx,CONCAT(o.pttype,' ',y.name) AS yname,o.hospmain,o.hospsub,
			 s.name AS sname,k.department,main_dep,y.hipdata_code,y.hipdata_code,
                         o.pttype
                FROM ovst  o
                LEFT JOIN patient p ON p.hn =o.hn
                LEFT JOIN pttype y ON y.pttype = o.pttype
                LEFT JOIN vn_stat v ON v.vn = o.vn
                LEFT JOIN spclty s ON s.spclty = o.spclty
                LEFT JOIN kskdepartment k ON k.depcode = o.main_dep
                WHERE o.vstdate = '$date1'
                                        AND o.an IS NULL 
                ORDER BY o.hn  ";



                $data = $connection->createCommand($sql)
                        ->queryAll();
                for ($i = 0; $i < sizeof($data); $i++) {
                    $vstdate = $data[$i]['vstdate'];
                    $hn = $data[$i]['hn'];
                    $vn = $data[$i]['vn'];
                    $cid = $data[$i]['cid'];
                    $tname = $data[$i]['tname'];
                    $pdx = $data[$i]['pdx'];
                    $yname = $data[$i]['yname'];
                    $hospmain = $data[$i]['hospmain'];
                    $hospsub = $data[$i]['hospsub'];
                    $sname = $data[$i]['sname'];
                    $department = $data[$i]['department'];
                    $main_dep = $data[$i]['main_dep'];
                    $hipdata_code = $data[$i]['hipdata_code'];
                    $pttype = $data[$i]['pttype'];

                    $datals = $connectiond->createCommand("INSERT IGNORE INTO  chk_ovst_log (vstdate,vn,hn,cid,tname,pdx,nhso_pttype,yname,hospmain,hospsub,sname,department,main_dep,pttype) 
							VALUES 
                                                    ('$vstdate','$vn','$hn','$cid','$tname','$pdx','$hipdata_code','$yname','$hospmain','$hospsub','$sname','$department','$main_dep','$pttype')")->execute();
                }
            } elseif ($_POST['type'] == '2') {
                
            }
        } else {
            
        }


        $sqlt = "SELECT c.*,d.maininscl,
                IF(nhso_pttype = maininscl,'Y','N') AS tck_pttype
                FROM chk_ovst_log c
                LEFT JOIN chk_dbpop d ON d.pid = c.cid
                WHERE vstdate = '$date1' ";

        try {
            $rawData = \Yii::$app->db->createCommand($sqlt)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 50
            ],
        ]);


        return $this->render('index', ['dataProvider' => $dataProvider, 'date1' => $date1, 'type' => $type]);
    }

    public function actionModalpop() {

        $vn = $_GET['vn'];
        $vstdate = $_GET['vstdate'];
        $cid = $_GET['id'];

       

        

        return $this->renderAjax('modalpop', ['vn' => $vn, 'vstdate' => $vstdate,'id'=>$cid]);
    }

}
