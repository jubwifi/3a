<?php

namespace app\modules\chk\controllers;
use Yii;
class ClaimController extends \yii\web\Controller {
    
    public function actionLeft() {
        
        $date1=date('Y-m-d');
        return $this->render('left',['date1'=>$date1]);
    }

    public function actionIndex() {
        $date1 = date('Y-m-d');
        $type=0;
        
        if (Yii::$app->request->isPost) {
            if (Yii::$app->request->isPost) {
                if (isset($_POST['date1']) == '') {
                    $date1 = Yii::$app->session['date1'];
                    $type = Yii::$app->session['type'];
                } else {

                    $date1 = $_POST['date1'];
                    $type = $_POST['type'];
                    Yii::$app->session['date1'] = $date1;
                    Yii::$app->session['type'] = $type;
                    //$aa = 'test';
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
        
        if(isset($_GET['type'])==1){
            $type=$_GET['type'];
        }
        
        if($type==0){
            $sql = "SELECT cg.claimgroup,groupname,COUNT(c.vn) AS tcount,vstdate,'0' as type
                FROM  chk_claimgroup cg
                LEFT JOIN  chk_ovst_confirm c ON c.acc = cg.claimgroup AND  vstdate = '$date1'
                GROUP BY cg.claimgroup
                ORDER BY cg.claimgroup ";
            
            $sqldetail="SELECT * FROM chk_ovst_confirm WHERE   acc ='$acc' ";
        }else{
            $sql = "SELECT cg.claimgroup,groupname,COUNT(c.an) AS tcount,dchdate as vstdate,'1' as type
                FROM  chk_claimgroup cg
                LEFT JOIN  chk_ipt_confirm c ON c.acc = cg.claimgroup AND  dchdate = '$date1'
                GROUP BY cg.claimgroup
                ORDER BY cg.claimgroup ";
            
            $sqldetail="SELECT c.*,c.dchdate as vstdate FROM chk_ipt_confirm c WHERE   acc ='$acc' ";
            
        }
        
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
        
        
        return $this->render('index', ['dataProvider' => $dataProvider,'dataProvider2' => $dataProvider2, 'date1' => $date1,'acc'=>$acc,'type'=>$type]);
    }

}
