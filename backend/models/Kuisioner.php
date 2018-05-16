<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kuisioner".
 *
 * @property int $idkuisioner
 * @property int $idorangtua
 * @property int $idsiswabelajar
 * @property int $idguru
 * @property int $tanggal
 * @property int $penguasaanmateri
 * @property int $kemampuanmengajar
 * @property int $kedisiplinan
 * @property int $tanggungjawabdantingkahlaku
 * @property int $kerjasama
 */
class Kuisioner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kuisioner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idorangtua', 'idsiswabelajar', 'idguru', 'tanggal'], 'required'],
            [['tanggal'], 'safe'],
            [['idorangtua', 'idsiswabelajar', 'idguru', 'penguasaanmateri', 'kemampuanmengajar', 'kedisiplinan', 'tanggungjawabdantingkahlaku', 'kerjasama'], 'integer'],
            [['statuskuisioner'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idkuisioner' => 'Idkuisioner',
            'idorangtua' => 'Idorangtua',
            'idsiswabelajar' => 'Idsiswabelajar',
            'idguru' => 'Idguru',
            'statuskuisioner' => 'Status Kuisioner',
            'tanggal' => 'Tanggal',
            'penguasaanmateri' => 'Penguasaan Materi',
            'kemampuanmengajar' => 'Kemampuan Mengajar',
            'kedisiplinan' => 'Kedisiplinan',
            'tanggungjawabdantingkahlaku' => 'Tanggung Jawab dan Tingkah Laku',
            'kerjasama' => 'Kerjasama',
        ];
    }

    public function getSiswa()
    {
        $siswa = Siswa::find()->where(['idsiswa'=>$this->idsiswa])->one();
        return $siswa['namalengkap'];
    }
}
