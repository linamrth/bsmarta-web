<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rapottrial".
 *
 * @property integer $idhasiltrial
 * @property integer $idtrial
 * @property string $soal1
 * @property string $soal2
 * @property string $soal3
 * @property string $soal4
 * @property string $soal5
 * @property string $soal6
 * @property string $soal7
 * @property string $soal8
 * @property string $soal9
 * @property string $soal10
 * @property string $soal11
 * @property string $catatan
 * @property string $tgl
 */
class Rapottrial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rapottrial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjadwal', 'soal1', 'soal2', 'soal3', 'soal4', 'soal5', 'soal6', 'soal7', 'soal8', 'catatan'], 'required'],
            [['idjadwal'], 'integer'],
            [['tgl'], 'safe'],
            [['soal1', 'soal2', 'soal3', 'soal4', 'soal5', 'soal6', 'soal7', 'soal8', 'soal9', 'soal10', 'soal11'], 'string', 'max' => 10],
            [['catatan'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idhasiltrial' => 'Idhasiltrial',
            'idjadwal' => 'Idjadwal',
            'soal1' => 'Soal1',
            'soal2' => 'Soal2',
            'soal3' => 'Soal3',
            'soal4' => 'Soal4',
            'soal5' => 'Soal5',
            'soal6' => 'Soal6',
            'soal7' => 'Soal7',
            'soal8' => 'Soal8',
            'soal9' => 'Soal9',
            'soal10' => 'Soal10',
            'soal11' => 'Soal11',
            'catatan' => 'Catatan',
            'tgl' => 'Tgl',
        ];
    }
}
