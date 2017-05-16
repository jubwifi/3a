<?php

namespace app\modules\chk\controllers;

use Yii;

class ImporthisController extends \yii\web\Controller {

    public function actionIndex() {
        $date1 = date('Y-m-d');
        $connection = Yii::$app->db2;
        $connectiond = Yii::$app->db;
        $type=0;
        
        if(isset($_GET['type'])=='1'){
            $type=1;
        }
        
        
        if (Yii::$app->request->isPost) {
            $type =$_POST['type'];
        }

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



        if (isset($_POST['n_update']) == '0') {
            
        } else {

            if (isset($_POST['date1'])) {

                
                if ($type == '0') {
                    //OPD
                    $datals = $connectiond->createCommand("DELETE FROM chk_ovst_log WHERE vstdate ='$date1'")->execute();
                    $datals = $connectiond->createCommand("DELETE FROM chk_ovst_confirm WHERE vstdate ='$date1'")->execute();
                    $sql = "SELECT o.vstdate,o.vn,o.hn,p.cid,CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                            v.pdx,CONCAT(o.pttype,' ',y.name) AS yname,o.hospmain,o.hospsub,
                            s.name AS sname,k.department,main_dep,y.hipdata_code,y.hipdata_code,o.pttype,
                            income,paid_money,uc_money,rcpt_money,item_money,
                            inc01,inc02,inc03,inc04,inc05,inc06,inc07,inc08,
                            inc09,inc10,inc11,inc12,inc13,inc14,inc15,inc16 
                        FROM ovst  o
                        LEFT JOIN patient p ON p.hn =o.hn
                        LEFT JOIN pttype y ON y.pttype = o.pttype
                        LEFT JOIN vn_stat v ON v.vn = o.vn
                        LEFT JOIN spclty s ON s.spclty = o.spclty
                        LEFT JOIN kskdepartment k ON k.depcode = o.main_dep
                        WHERE o.vstdate = '$date1'
                                                AND o.an IS NULL 
                        ORDER BY o.hn ";



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

                        $income = $data[$i]['income'];
                        $paid_money = $data[$i]['paid_money'];
                        $uc_money = $data[$i]['uc_money'];
                        $rcpt_money = $data[$i]['rcpt_money'];
                        $item_money = $data[$i]['item_money'];
                        $inc01 = $data[$i]['inc01'];
                        $inc02 = $data[$i]['inc02'];
                        $inc03 = $data[$i]['inc03'];
                        $inc04 = $data[$i]['inc04'];
                        $inc05 = $data[$i]['inc05'];
                        $inc06 = $data[$i]['inc06'];
                        $inc07 = $data[$i]['inc07'];
                        $inc08 = $data[$i]['inc08'];
                        $inc09 = $data[$i]['inc09'];
                        $inc10 = $data[$i]['inc10'];
                        $inc11 = $data[$i]['inc11'];
                        $inc12 = $data[$i]['inc12'];
                        $inc13 = $data[$i]['inc13'];
                        $inc14 = $data[$i]['inc14'];
                        $inc15 = $data[$i]['inc15'];
                        $inc16 = $data[$i]['inc16'];

                        $datals = $connectiond->createCommand("INSERT IGNORE INTO  chk_ovst_log (vstdate,vn,hn,cid,tname,pdx,nhso_pttype,yname,hospmain,hospsub,sname,department,main_dep,pttype,income,paid_money,uc_money,rcpt_money,item_money,
                                                            inc01,inc02,inc03,inc04,inc05,inc06,inc07,inc08,
                                                            inc09,inc10,inc11,inc12,inc13,inc14,inc15,inc16 ) 
                                                            VALUES 
                                                    ('$vstdate','$vn','$hn','$cid','$tname','$pdx','$hipdata_code','$yname','$hospmain','$hospsub','$sname','$department','$main_dep','$pttype',
                                                     '$income','$paid_money','$uc_money','$rcpt_money','$item_money','$inc01','$inc02','$inc03','$inc04','$inc05','$inc06','$inc07','$inc08','$inc09',
                                                     '$inc10','$inc11','$inc12','$inc13','$inc14','$inc15','$inc16')")->execute();
                    }
                    // end OPD
                } elseif ($type == '1') {

                    //IPD
                    $datals = $connectiond->createCommand("DELETE FROM chk_ipt_log WHERE dchdate ='$date1'")->execute();
                    $datals = $connectiond->createCommand("DELETE FROM chk_ipt_confirm WHERE dchdate ='$date1'")->execute();
                    $sql = "SELECT i.dchdate,i.regdate,i.hn,i.an,p.cid,
                                CONCAT(p.pname,p.fname,' ',p.lname) AS tname,
                                a.pdx,i.pttype,y.name AS yname,p.pttype,
                                o.hospmain,o.hospsub,i.rw,y.hipdata_code,

                                 income,paid_money,uc_money,rcpt_money,item_money,
                                inc01,inc02,inc03,inc04,inc05,inc06,inc07,inc08,
                                inc09,inc10,inc11,inc12,inc13,inc14,inc15,inc16 
                        FROM ipt i
                        LEFT JOIN an_stat a ON a.an = i.an
                        LEFT JOIN patient p ON p.hn = i.hn
                        LEFT JOIN pttype y ON y.pttype = i.pttype
                        LEFT JOIN ovst o ON o.an = i.an
                        WHERE i.dchdate ='$date1'";

                    $data = $connection->createCommand($sql)
                            ->queryAll();
                    for ($i = 0; $i < sizeof($data); $i++) {

                        $dchdate = $data[$i]['dchdate'];
                        $regdate = $data[$i]['regdate'];
                        $hn = $data[$i]['hn'];
                        $an = $data[$i]['an'];
                        $cid = $data[$i]['cid'];
                        $tname = $data[$i]['tname'];
                        $pdx = $data[$i]['pdx'];
                        $pttype = $data[$i]['pttype'];
                        $yname = $data[$i]['yname'];
                        $hospmain = $data[$i]['hospmain'];
                        $hospsub = $data[$i]['hospsub'];
                        $rw = $data[$i]['rw'];
                        $hipdata_code = $data[$i]['hipdata_code'];

                        $income = $data[$i]['income'];
                        $paid_money = $data[$i]['paid_money'];
                        $uc_money = $data[$i]['uc_money'];
                        $rcpt_money = $data[$i]['rcpt_money'];
                        $item_money = $data[$i]['item_money'];
                        $inc01 = $data[$i]['inc01'];
                        $inc02 = $data[$i]['inc02'];
                        $inc03 = $data[$i]['inc03'];
                        $inc04 = $data[$i]['inc04'];
                        $inc05 = $data[$i]['inc05'];
                        $inc06 = $data[$i]['inc06'];
                        $inc07 = $data[$i]['inc07'];
                        $inc08 = $data[$i]['inc08'];
                        $inc09 = $data[$i]['inc09'];
                        $inc10 = $data[$i]['inc10'];
                        $inc11 = $data[$i]['inc11'];
                        $inc12 = $data[$i]['inc12'];
                        $inc13 = $data[$i]['inc13'];
                        $inc14 = $data[$i]['inc14'];
                        $inc15 = $data[$i]['inc15'];
                        $inc16 = $data[$i]['inc16'];

                        $datals = $connectiond->createCommand("INSERT IGNORE INTO  chk_ipt_log (dchdate,regdate,hn,an,cid,tname,pdx,pttype,hipdata_code,yname,nhso_pttype,hospmain,hospsub,rw,income,paid_money,uc_money,rcpt_money,item_money,
                                                            inc01,inc02,inc03,inc04,inc05,inc06,inc07,inc08,
                                                            inc09,inc10,inc11,inc12,inc13,inc14,inc15,inc16,nhso_code ) 
                                                            VALUES 
                                                    ('$dchdate','$regdate','$hn','$an','$cid','$tname','$pdx','$pttype','$hipdata_code','$yname','$pttype','$hospmain','$hospsub','$rw',
                                                     '$income','$paid_money','$uc_money','$rcpt_money','$item_money','$inc01','$inc02','$inc03','$inc04','$inc05','$inc06','$inc07','$inc08','$inc09',
                                                     '$inc10','$inc11','$inc12','$inc13','$inc14','$inc15','$inc16','$pttype')")->execute();
                    }
                }
            } else {
                
            }
        }
        
        $datalp = $connectiond->createCommand("UPDATE chk_ovst_log l
                                                LEFT JOIN chk_pttype p ON p.pttype = l.pttype
                                                SET l.nhso_code = p.nhso_code
                                                WHERE vstdate ='$date1' ")->execute();
        
         $datalpi = $connectiond->createCommand("UPDATE chk_ipt_log l
                                                LEFT JOIN chk_pttype p ON p.pttype = l.pttype
                                                SET l.nhso_code = p.nhso_code
                                                WHERE dchdate ='$date1' ")->execute();
        




         if ($type == '0') {
      
            $sqlt = "SELECT c.*,d.maininscl,
                IF(nhso_pttype = maininscl,'Y','N') AS tck_pttype,'opd' AS type
                FROM chk_ovst_log c
                LEFT JOIN chk_dbpop d ON d.pid = c.cid
                WHERE vstdate = '$date1' ";
         }else{
             $sqlt = "SELECT c.*,d.maininscl,c.an as vn,dchdate as vstdate,
                IF(hipdata_code = maininscl,'Y','N') AS tck_pttype,'ipd' AS type
                FROM chk_ipt_log c
                LEFT JOIN chk_dbpop d ON d.pid = c.cid
                WHERE dchdate = '$date1' ";
         }
        


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





        return $this->renderAjax('modalpop', ['vn' => $vn, 'vstdate' => $vstdate, 'id' => $cid]);
    }
    
     public function actionModalpopipd() {

        $vn = $_GET['vn'];
        $vstdate = $_GET['vstdate'];
        $cid = $_GET['id'];





        return $this->renderAjax('modalpopipd', ['vn' => $vn, 'vstdate' => $vstdate, 'id' => $cid]);
    }

    public function actionBtnconfirm() {
        $date1 = $_GET['date1'];
        $connection = Yii::$app->db;

        $sql = "INSERT IGNORE INTO chk_ovst_confirm
                SELECT l.*,null,l.nhso_code 
                FROM chk_ovst_log l
                WHERE l.vstdate ='$date1'  ";
        $dataconfirm = $connection->createCommand($sql)->execute();
        
        
        $sqlu ="UPDATE chk_ovst_confirm c
                LEFT JOIN  
                (SELECT IF(paid_money>0,'1',
			 IF(nhso_pttype IN('WEL','UCS','SSS') AND h.chwpart = (SELECT prov FROM aaa_setting) AND uc_money>0,'2',
			 IF(nhso_pttype IN('SSS','SSI')  AND uc_money>0,'3',
			 IF(nhso_pttype IN('WEL','UCS')  AND uc_money>0,'4',
			 IF(nhso_pttype ='NRH' AND uc_money>0,'5',
			 IF(nhso_pttype IN('WEL','UCS') AND h.chwpart = (SELECT prov FROM aaa_setting)   AND uc_money>0 ,'6',
			 IF(p.pp ='1' AND h.chwpart = (SELECT prov FROM aaa_setting)  AND uc_money>0,'7',
			 IF(nhso_pttype IN('OFC','LGO')   AND uc_money>0,'8',
                        IF(p.sso='1' AND uc_money>0,'9',
                        IF(paid_money>0 AND uc_money>0,'10',
                        IF(p.aid='1' AND uc_money>0,'11',
                        IF(nhso_pttype IN('WEL','UCS') AND p.health='1' AND uc_money>0,'12','99'))))))))))))  AS claim,c.vn
                 FROM chk_ovst_confirm c
                 LEFT JOIN aaa_hospital h ON h.hospcode = c.hospmain
                 LEFT JOIN chk_pttype p ON  p.nhso_code = c.nhso_pttype AND c.nhso_code IS NOT NULL
                 WHERE vstdate ='$date1' ) AS t1 ON t1.vn = c.vn
                 SET c.acc = t1.claim";
        $datau = $connection->createCommand($sqlu)->execute();

        return $dataconfirm;
    }
    public function actionBtnconfirmipd() {
        $date1 = $_GET['date1'];
        $connection = Yii::$app->db;

        $sql = "INSERT IGNORE INTO chk_ipt_confirm
                SELECT l.*,null,l.nhso_pttype
                FROM chk_ipt_log l
                WHERE l.dchdate ='$date1'  ";
        $dataconfirm = $connection->createCommand($sql)->execute();
        
        
        $sqlu ="UPDATE chk_ipt_confirm c
                LEFT JOIN  
                (SELECT IF(paid_money>0,'1',
			 IF(c.hipdata_code IN('WEL','UCS','SSS') AND h.chwpart = (SELECT prov FROM aaa_setting) AND uc_money>0,'2',
			 IF(c.hipdata_code IN('SSS','SSI')  AND uc_money>0,'3',
			 IF(c.hipdata_code IN('WEL','UCS')  AND uc_money>0,'4',
			 IF(c.hipdata_code ='NRH' AND uc_money>0,'5',
			 IF(c.hipdata_code IN('WEL','UCS') AND h.chwpart = (SELECT prov FROM aaa_setting)   AND uc_money>0 ,'6',
			 IF(p.pp ='1' AND h.chwpart = (SELECT prov FROM aaa_setting)  AND uc_money>0,'7',
			 IF(c.hipdata_code IN('OFC','LGO')   AND uc_money>0,'8',
                        IF(p.sso='1' AND uc_money>0,'9',
                        IF(paid_money>0 AND uc_money>0,'10',
                        IF(p.aid='1' AND uc_money>0,'11',
                        IF(c.hipdata_code IN('WEL','UCS') AND p.health='1' AND uc_money>0,'12','99'))))))))))))  AS claim,c.an
                 FROM chk_ipt_confirm c
                 LEFT JOIN aaa_hospital h ON h.hospcode = c.hospmain
                 LEFT JOIN chk_pttype p ON  p.nhso_code = c.nhso_pttype AND c.nhso_code IS NOT NULL
                 WHERE dchdate ='$date1' ) AS t1 ON t1.an = c.an
                 SET c.acc = t1.claim";
        $datau = $connection->createCommand($sqlu)->execute();

        return $dataconfirm;
    }
    

    public function actionCpttype() {
        $date1 = $_GET['date1'];
        $cid = $_GET['cid'];
        $connection = Yii::$app->db;

        $sql = "UPDATE chk_ovst_log l
                LEFT JOIN chk_dbpop d ON d.pid = l.cid
                SET l.nhso_pttype = d.mainInScl,l.hospmain = d.hmain,l.hospsub = d.hsub2,l.nhso_code = d.subInScl
                WHERE md5(cid) ='$cid' AND vstdate ='$date1' ";
        $datacpttype = $connection->createCommand($sql)->execute();

        return $datacpttype;
    }
    public function actionCpttypeipd() {
        $date1 = $_GET['date1'];
        $cid = $_GET['cid'];
        $connection = Yii::$app->db;

        $sql = "UPDATE chk_ipt_log l
                LEFT JOIN chk_dbpop d ON d.pid = l.cid
                SET l.hipdata_code = d.mainInScl,l.hospmain = d.hmain,l.hospsub = d.hsub2,l.nhso_pttype = d.subInScl
                WHERE md5(cid) ='$cid' AND dchdate ='$date1' ";
        $datacpttype = $connection->createCommand($sql)->execute();

        return $datacpttype;
    }
    

}
