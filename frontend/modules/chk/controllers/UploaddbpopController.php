<?php

namespace app\modules\chk\controllers;

use Yii;
use app\models\ChkUploadDbpop;
use app\models\ChkUploadDbpopSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/**
 * UploaddbpopController implements the CRUD actions for ChkUploadDbpop model.
 */
class UploaddbpopController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ChkUploadDbpop models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ChkUploadDbpopSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChkUploadDbpop model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ChkUploadDbpop model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ChkUploadDbpop();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->name = $this->uploadSingleFile($model);



            return $this->redirect(['create', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }
    public function actionCreateadd() {
        $model = new ChkUploadDbpop();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->name = $this->uploadSingleFile2($model);



            return $this->redirect(['createadd', 'id' => $model->id]);
        } else {
            return $this->render('createadd', [
                        'model' => $model,
            ]);
        }
    }

    private function uploadSingleFile($model, $tempFile = null) {

        $connection = Yii::$app->db;
        $file = [];
        $json = '';
        try {
            $year = $model->tyear;
            $month = $model->tmonth;
            $UploadedFile = UploadedFile::getInstance($model, 'name');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '_' . $year . $month . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs('../web/dbpop' . '/' . $oldFileName);
                //$file[$newFileName] = $oldFileName;
                $json = Json::encode($file);

                $filedbpop = '../web/dbpop' . '/' . $oldFileName;
                $zip = new \ZipArchive();
                if ($zip->open($filedbpop) === TRUE) {
                    $zip->extractTo("dbpop");
                    $zip->close();
                }

                $tname = $UploadedFile->basename . '.txt';
                $path = 'dbpop' . '/' . $tname;
                $sql = "LOAD DATA LOCAL INFILE '$path' REPLACE INTO TABLE chk_remove_dbpop
                    CHARACTER SET UTF8
                    FIELDS TERMINATED BY ';' 
                    ENCLOSED BY '\"' 
                    LINES TERMINATED BY '\r\n' ";

                $data = $connection->createCommand($sql)->execute();



                $sql_id = "SELECT id FROM chk_upload_dbpop ORDER BY id DESC limit 1 ";
                $command = Yii::$app->db->createCommand($sql_id);
                $id = $command->queryScalar();

                $dataup_file = $connection->createCommand("UPDATE chk_upload_dbpop SET name='$tname' WHERE  id= '$id' ")->execute();
                
                $datadel_dbpop = $connection->createCommand("DELETE FROM chk_dbpop WHERE pid IN(SELECT cid FROM chk_remove_dbpop )")->execute();

                $datainsert_remove = $connection->createCommand("INSERT INTO chk_remove_dbpop_log SELECT * FROM chk_remove_dbpop ")->execute();

                $datadel_remove = $connection->createCommand("DELETE FROM chk_remove_dbpop ")->execute();

                unlink("dbpop/$tname");
            } else {
                $json = $tempFile;
            }
        } catch (Exception $e) {
            $json = $tempFile;
        }
        return $json;
    }
    
    
    private function uploadSingleFile2($model, $tempFile = null) {

        $connection = Yii::$app->db;
        $file = [];
        $json = '';
        try {
            $year = $model->tyear;
            $month = $model->tmonth;
            $UploadedFile = UploadedFile::getInstance($model, 'name');
            if ($UploadedFile !== null) {
                $oldFileName = $UploadedFile->basename . '_' . $year . $month . '.' . $UploadedFile->extension;
                $UploadedFile->saveAs('../web/dbpop' . '/' . $oldFileName);
                //$file[$newFileName] = $oldFileName;
                $json = Json::encode($file);

                $filedbpop = '../web/dbpop' . '/' . $oldFileName;
                $zip = new \ZipArchive();
                if ($zip->open($filedbpop) === TRUE) {
                    $zip->extractTo("dbpop");
                    $zip->close();
                }
                
              

                $tname = $UploadedFile->basename . '.txt';
                $path = 'dbpop' . '/' . $tname;
                
                utf8_encode($path);
                
                $sql = "LOAD DATA LOCAL INFILE '$path' REPLACE INTO TABLE chk_add_dbpop
                    CHARACTER SET utf8
                    FIELDS TERMINATED BY ';' 
                    ENCLOSED BY '\"' 
                    LINES TERMINATED BY '\r\n' ";

                $data = $connection->createCommand($sql)->execute();



                $sql_id = "SELECT id FROM chk_upload_dbpop ORDER BY id DESC limit 1 ";
                $command = Yii::$app->db->createCommand($sql_id);
                $id = $command->queryScalar();

                $dataup_file = $connection->createCommand("UPDATE chk_upload_dbpop SET name='$tname' WHERE  id= '$id' ")->execute();
                
                $sqladd ="INSERT IGNORE INTO chk_dbpop
                        SELECT cid,title,fname,lname,birthdate,sex,chat,maininscl,startdate,expdate,hmain,hsub,subinscl,ownerp,cardid,'' AS nation,'' AS pripro,hsub2,prov FROM chk_add_dbpop";
                $dataadd_dbpop = $connection->createCommand($sqladd)->execute();

                $datainsert_remove = $connection->createCommand("INSERT INTO chk_add_dbpop_log SELECT * FROM chk_add_dbpop ")->execute();

                $datadel_remove = $connection->createCommand("DELETE FROM chk_add_dbpop ")->execute();

                //unlink("dbpop/$tname");
            } else {
                $json = $tempFile;
            }
        } catch (Exception $e) {
            $json = $tempFile;
        }
        return $json;
    }

    /**
     * Updates an existing ChkUploadDbpop model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ChkUploadDbpop model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ChkUploadDbpop model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChkUploadDbpop the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ChkUploadDbpop::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function CreateDir($folderName) {
        if ($folderName != NULL) {
            $basePath = finger::getUploadPath();
            if (BaseFileHelper::createDirectory($basePath . $folderName, 0777)) {
                BaseFileHelper::createDirectory($basePath . $folderName . '/thumbnail', 0777);
            }
        }
        return;
    }

}
