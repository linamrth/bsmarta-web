<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hasilpenilaian".
 *
 * @property int $idhasilpenilaian
 * @property string $mingguke
 * @property int $idguru
 * @property double $hasil
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
            [['mingguke'], 'safe'],
            [['idguru'], 'integer'],
            [['hasil'], 'number'],
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
