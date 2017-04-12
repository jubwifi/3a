<?php

namespace app\modules\chk\controllers;

use Yii;

class GpttypeController extends \yii\web\Controller {

    public function actionIndex() {

        if (Yii::$app->request->isPost) {
            $connection = Yii::$app->db2;
            $connectioni = Yii::$app->db;
            $sql = "select * from pttype";
            $data = $connection->createCommand($sql)
                    ->queryAll();
            for ($i = 0; $i < sizeof($data); $i++) {
                $pttype = $data[$i]['pttype'];
                $name = $data[$i]['name'];
                
                 $datals = $connectioni->createCommand("INSERT INTO chk_pttype (pttype,name,hmain,chk_pttype,pp,sso,claim,null_sps,paist,aid,health,nhso_code,hipdata_code) 
						VALUES ('$pttype','$name','0','0','0','0','0','0','0','0','0','','')")->execute();
            }
        }

        $sql = "select * from chk_pttype";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([
            //'key' => 'hoscode',
            'allModels' => $rawData,
            'pagination' => [
                'pageSize' => 200
            ],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
    
    public function actionModal() {
        
        
         return $this->renderAjax('index', ['dataProvider' => $dataProvider]);
    }

}
