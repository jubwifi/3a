<?php

namespace app\modules\chk\models;

use Yii;

/**
 * This is the model class for table "chk_nhso_inscl".
 *
 * @property string $nhso_code
 * @property string $pttype_name
 * @property string $pttype_code
 * @property string $pttype_exp
 * @property string $hipdata_code
 */
class ChkNhsoInscl extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chk_nhso_inscl';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nhso_code'], 'required'],
            [['nhso_code'], 'string', 'max' => 2],
            [['pttype_name'], 'string', 'max' => 150],
            [['pttype_code'], 'string', 'max' => 1],
            [['pttype_exp'], 'string', 'max' => 50],
            [['hipdata_code'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nhso_code' => 'Nhso Code',
            'pttype_name' => 'Pttype Name',
            'pttype_code' => 'Pttype Code',
            'pttype_exp' => 'Pttype Exp',
            'hipdata_code' => 'Hipdata Code',
        ];
    }
}
