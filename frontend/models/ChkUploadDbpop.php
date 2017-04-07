<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chk_upload_dbpop".
 *
 * @property integer $id
 * @property string $tyear
 * @property string $tmonth
 * @property string $name
 */
class ChkUploadDbpop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     const UPLOAD_FOLDER = 'dbpop';
     
    public static function tableName()
    {
        return 'chk_upload_dbpop';
    }

    public static function getUploadPath() {
        return Yii::getAlias('@webroot') . '/' . self::UPLOAD_FOLDER . '/';
    }

    public static function getUploadUrl() {
        return Url::base(true) . '/' . self::UPLOAD_FOLDER . '/';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tyear','tmonth'],'required'],
            [['tyear', 'tmonth', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tyear' => 'ปี',
            'tmonth' => 'เดือน',
            'name' => 'อัพโหลดไฟล์',
        ];
    }
}
