<?php

namespace app\modules\chk\models;

use Yii;

/**
 * This is the model class for table "chk_pttype".
 *
 * @property string $pttype
 * @property string $name
 * @property string $hmain
 * @property string $chk_pttype
 * @property string $pp
 * @property string $sso
 * @property string $claim
 * @property string $null_sps
 * @property string $paist
 * @property string $aid
 * @property string $health
 * @property string $nhso_code
 * @property string $hipdata_code
 */
class CPttype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chk_pttype';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pttype'], 'required'],
            [['pttype'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 255],
            [['hmain', 'chk_pttype', 'pp', 'sso', 'claim', 'null_sps', 'paist', 'aid', 'health'], 'string', 'max' => 1],
            [['nhso_code', 'hipdata_code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pttype' => 'Pttype',
            'name' => 'ชื่อสิทธิ',
            'hmain' => 'ตรวจ Hmain',
            'chk_pttype' => 'ตรวจสอบสิทธิ',
            'pp' => 'PP',
            'sso' => 'พรบ./ประกัน',
            'claim' => 'จ่ายจรง/e-claim',
            'null_sps' => 'สิทธิว่าง(สปสช.)',
            'paist' => 'ลูกหนี้สิทธิ',
            'aid' => 'สงเคราะห์',
            'health' => 'ตรวจสุขภาพ',
            'nhso_code' => 'Nhso_Code',
            'hipdata_code' => 'Hipdata_Code',
        ];
    }
}
