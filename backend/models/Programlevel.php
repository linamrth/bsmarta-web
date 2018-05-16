<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "programlevel".
 *
 * @property integer $idprogramlevel
 * @property integer $idprogram
 * @property string $level
 * @property integer $jmlpertemuan
 */
class Programlevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'programlevel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idprogram', 'level', 'jmlpertemuan'], 'required'],
            [['idprogram', 'jmlpertemuan'], 'integer'],
            [['level'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idprogramlevel' => 'Idprogramlevel',
            'idprogram' => 'Idprogram',
            'level' => 'Level',
            'jmlpertemuan' => 'Jmlpertemuan',
        ];
    }
}
