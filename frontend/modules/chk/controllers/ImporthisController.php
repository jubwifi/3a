<?php

namespace app\modules\chk\controllers;

use Yii;

class ImporthisController extends \yii\web\Controller {

    public function actionIndex() {
        $date1 = date('Y-m-d');
        $date2 = date('Y-m-d');

        if (isset($_GET['page'])) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        }
        if (Yii::$app->request->isPost) {
            if (isset($_POST['date1']) == '') {
                $date1 = Yii::$app->session['date1'];
                $date2 = Yii::$app->session['date2'];
            } else {

                $date1 = $_POST['date1'];
                $date2 = $_POST['date2'];
                Yii::$app->session['date1'] = $date1;
                Yii::$app->session['date2'] = $date2;
            }
        }
        if (isset($_GET['date1'])) {
            $date1 = Yii::$app->session['date1'];
            $date2 = Yii::$app->session['date2'];
        }






        if (Yii::$app->request->isPost) {

            $sql = "SELECT o.hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
			 v.pdx,CONCAT(o.pttype,' ',y.name) AS yname,o.hospmain,o.hospsub,
			 s.name AS sname,k.department,main_dep
                FROM ovst  o
                LEFT JOIN patient p ON p.hn =o.hn
                LEFT JOIN pttype y ON y.pttype = o.pttype
                LEFT JOIN vn_stat v ON v.vn = o.vn
                LEFT JOIN spclty s ON s.spclty = o.spclty
                LEFT JOIN kskdepartment k ON k.depcode = o.main_dep
                WHERE o.vstdate BETWEEN '$date1' and '$date2'
                                        AND o.an IS NULL 
                ORDER BY o.hn  ";


            $connection = Yii::$app->db2;
            $connectiond = Yii::$app->db;
            $data = $connection->createCommand($sql)
                    ->queryAll();
            for ($i = 0; $i < sizeof($data); $i++) {
                $hn = $data[$i]['hn'];
                $cid = $data[$i]['cid'];
                $tname = $data[$i]['tname'];
                $pdx = $data[$i]['pdx'];
                $yname = $data[$i]['yname'];
                $hospmain = $data[$i]['hospmain'];
                $hospsub = $data[$i]['hospsub'];
                $sname = $data[$i]['sname'];
                $department = $data[$i]['department'];
                $main_dep = $data[$i]['main_dep'];

                $datals = $connectiond->createCommand("INSERT IGNORE INTO  chk_ovst_log (hn,cid,tname,pdx,yname,hospmain,hospsub,sname,department,main_dep) 
							VALUES 
                                                    ('$hn','$cid','$tname','$pdx','$yname','$hospmain','$hospsub','$sname','$department','$main_dep')")->execute();
            }
        }else{
            
        }


        $sqlt = "SELECT * 
                FROM chk_ovst_log c
                LEFT JOIN chk_dbpop d ON d.pid = c.cid";

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


        return $this->render('index', ['dataProvider' => $dataProvider, 'date1' => $date1, 'date2' => $date2]);
    }

}
