<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rapotbelajar".
 *
 * @property integer $idrapotbelajar
 * @property integer $idgenerate
 * @property integer $idguru
 * @property string $tanggal
 * @property integer $pertemuanke
 * @property string $materi
 * @property integer $hal
 * @property string $hasil
 * @property string $catatanguru
 * @property string $rewardhasil
 * @property string $rewardsikap
 */
class Rapotbelajar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapotbelajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idgenerate', 'idguru', 'tanggal', 'pertemuanke', 'materi', 'halamanketercapaian', 'hasil', 'catatanguru', 'rewardhasil', 'rewardsikap'], 'required'],
            [['idgenerate', 'idguru', 'pertemuanke', 'halamanketercapaian'], 'integer'],
            [['tanggal'], 'safe'],
            [['materi', 'hasil', 'catatanguru'], 'string', 'max' => 500],
            [['rewardhasil', 'rewardsikap'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrapotbelajar' => 'Idrapotbelajar',
            'idgenerate' => 'Idgenerate',
            'idguru' => 'Idguru',
            'tanggal' => 'Tanggal',
            'pertemuanke' => 'Pertemuanke',
            'materi' => 'Materi',
            'halamanketercapaian' => 'Hal',
            'hasil' => 'Hasil',
            'catatanguru' => 'Catatanguru',
            'rewardhasil' => 'Rewardhasil',
            'rewardsikap' => 'Rewardsikap',
        ];
    }
}
