<?php

namespace app\modules\chk\controllers;
use Yii;
class ClaimController extends \yii\web\Controller {

    public function actionIndex() {
        $date1 = date('Y-m-d');
        
        
        if (Yii::$app->request->isPost) {
            if (Yii::$app->request->isPost) {
                if (isset($_POST['date1']) == '') {
                    $date1 = Yii::$app->session['date1'];
                } else {

                    $date1 = $_POST['date1'];
                    Yii::$app->session['date1'] = $date1;
                    $aa = 'test';
                }
            }
        }

        if (isset($_GET['date1'])) {
            $date1 = Yii::$app->session['date1'];
        }
        
        if (isset($_GET['acc'])) {
            $acc=$_GET['acc'];
        }else{
            $acc='0';
        }
        
        
        $sql = "SELECT cg.claimgroup,groupname,COUNT(c.vn) AS tcount,vstdate
                FROM  chk_claimgroup cg
                LEFT JOIN  chk_ovst_confirm c ON c.acc = cg.claimgroup AND  vstdate = '$date1'
                GROUP BY cg.claimgroup
                ORDER BY cg.claimgroup ";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
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
        
        
        $sqldetail="SELECT * FROM chk_ovst_confirm WHERE   acc ='$acc' ";
        try {
            $rawData2 = \Yii::$app->db->createCommand($sqldetail)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider2 = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData2,
            'pagination' => [
                'pageSize' => 2000
            ],
        ]);
        
        
        return $this->render('index', ['dataProvider' => $dataProvider,'dataProvider2' => $dataProvider2, 'date1' => $date1,'acc'=>$acc]);
    }

}
