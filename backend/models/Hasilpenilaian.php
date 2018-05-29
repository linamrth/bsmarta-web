<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hasilpenilaian".
 *
 * @property int $idhasilpenilaian
 * @property int $mingguke
 * @property int $idguru
 * @property int $hasil
 */
class Hasilpenilaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hasilpenilaian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mingguke', 'idguru', 'hasil'], 'required'],
            [['mingguke', 'idguru', 'hasil'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idhasilpenilaian' => 'Idhasilpenilaian',
            'mingguke' => 'Mingguke',
            'idguru' => 'Idguru',
            'hasil' => 'Hasil',
        ];
    }
}
