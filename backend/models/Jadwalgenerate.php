<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jadwalgenerate".
 *
 * @property integer $idgenerate
 * @property integer $idsiswabelajar
 * @property integer $idguru
 * @property string $tanggal
 * @property string $hari
 * @property string $jam
 */
class Jadwalgenerate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwalgenerate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswabelajar', 'idguru'], 'integer'],
            [['tanggal'], 'safe'],
            [['hari', 'jam', 'statusrapotkursus'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idgenerate' => 'Idgenerate',
            'idsiswabelajar' => 'Idsiswabelajar',
            'idguru' => 'Idguru',
            'tanggal' => 'Tanggal',
            'hari' => 'Hari',
            'jam' => 'Jam',
            'statusrapotkursus' => 'Statusrapotkursus'
        ];
    }

    public function getNamaguru()
    {
        $namaguru = Guru::find()->where(["idguru"=>$this->idguru])->one();
        return $namaguru["namaguru"];
    }

    public function getJam()
    {
        $listJam = [
            '1'=>'10.00-11.00', 
            '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];

        return $listJam[$this->jam];
    }

    public function getProgramlevel()
    {
        $Siswabelajar = Siswabelajar::findOne(['idsiswabelajar'=>$this->idsiswabelajar]);
        $Programlevel = Programlevel::findOne(['idprogramlevel'=>$Siswabelajar->idprogramlevel]);
        $Program = Program::findOne(['idprogram'=>$Programlevel->idprogram]);

        return $Program['namaprogram'].' - Level '.$Programlevel['level'];
    }
}
