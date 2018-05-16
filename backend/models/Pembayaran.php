<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

use backend\models\Siswabelajar;
use backend\models\Siswa;

/**
 * This is the model class for table "pembayaran".
 *
 * @property integer $idpembayaran
 * @property integer $idsiswabelajar
 * @property integer $tahun
 * @property string $bulan
 * @property string $statuspembayaran
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswabelajar', 'tanggal'], 'required'],
            [['idsiswabelajar'], 'integer'],
            [['statuspembayaran'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpembayaran' => 'Idpembayaran',
            'idsiswabelajar' => 'Idsiswabelajar',
            'tanggal' => 'Tanggal',
            'statuspembayaran' => 'Statuspembayaran',
        ];
    }

    public function listSiswa()
    {
        $siswa = Siswa::find()->all();
        return ArrayHelper::map($siswa, 'idsiswa', 'namalengkap');
    }
}
