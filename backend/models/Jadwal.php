<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use backend\models\Guru;

/**
 * This is the model class for table "jadwal".
 *
 * @property integer $idjadwal
 * @property integer $idsiswabelajar
 * @property integer $idtrial
 * @property integer $idguru
 * @property string $hari
 * @property string $jam
 * @property string $tanggal
 * @property string $statusjadwal
 */
class Jadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswabelajar', 'idtrial', 'idguru', 'hari', 'jam', 'statusjadwal'], 'required'],
            [['idsiswabelajar', 'idtrial', 'idguru'], 'integer'],
            [['tanggal'], 'safe'],
            [['hari', 'jam'], 'string', 'max' => 20],
            [['statusjadwal'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idjadwal' => 'Idjadwal',
            'idsiswabelajar' => 'Idsiswabelajar',
            'idtrial' => 'Idtrial',
            'idguru' => 'Idguru',
            'hari' => 'Hari',
            'jam' => 'Jam',
            'tanggal' => 'Tanggal',
            'statusjadwal' => 'Statusjadwal',
        ];
    }

    public function listGuru()
    {
        $guru = Guru::find()->all();
        return ArrayHelper::map($guru, 'idguru', 'namaguru');
    }

    public function getNamaguru()
    {
        $namaguru = Guru::find()->where(["idguru"=>$this->idguru])->one();
        return $namaguru["namaguru"];
    }

    public function getJam()
    {
        $jam = [
            '1'=>'10.00-11.00', '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];

        return $jam[$this->jam];
    }
}
