<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Cabang;
use backend\models\Orangtua;

/**
 * This is the model class for table "siswa".
 *
 * @property integer $idsiswa
 * @property integer $idcabang
 * @property integer $idorangtua
 * @property string $namalengkap
 * @property string $namapanggilan
 * @property string $alamat
 * @property string $tempatlahir
 * @property string $tgllahir
 * @property string $asalsekolah
 * @property string $kelas
 * @property string $tgldaftar
 * @property string $keterangan
 * @property string $statussiswa
 */
class Siswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcabang', 'idorangtua', 'namalengkap', 'namapanggilan', 'alamat', 'tempatlahir', 'tgllahir', 'asalsekolah', 'kelas', 'tgldaftar'], 'required'],
            [['idcabang', 'idorangtua'], 'integer'],
            [['alamat', 'keterangan'], 'string'],
            [['tgllahir', 'tgldaftar'], 'safe'],
            [['namalengkap'], 'string', 'max' => 50],
            [['namapanggilan'], 'string', 'max' => 15],
            [['tempatlahir', 'asalsekolah'], 'string', 'max' => 30],
            [['kelas'], 'string', 'max' => 20],
            [['statussiswa'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsiswa' => 'Idsiswa',
            'idcabang' => 'Idcabang',
            'idorangtua' => 'Idorangtua',
            'namalengkap' => 'Nama Lengkap',
            'namapanggilan' => 'Nama Panggilan',
            'alamat' => 'Alamat',
            'tempatlahir' => 'Tempat Lahir',
            'tgllahir' => 'Tanggal Lahir',
            'asalsekolah' => 'Asal Sekolah',
            'kelas' => 'Kelas',
            'tgldaftar' => 'Tanggal Daftar',
            'keterangan' => 'Keterangan',
            'statussiswa' => 'Statussiswa',
        ];
    }

    public function listCabang()
    {
        $cabang = Cabang::find()->all();
        return ArrayHelper::map($cabang, 'idcabang', 'namacabang');
    }

    public function listOrangtua()
    {
        $ortu = Orangtua::find()->all();
        return ArrayHelper::map($ortu, 'idorangtua', 'namaortu');
    }

    public function getCabang()
    {
        $cabang = Cabang::find()->where(['idcabang'=>$this->idcabang])->one();
        return $cabang['namacabang'];
    }

    public function getOrtu()
    {
        $ortu = Orangtua::find()->where(['idorangtua'=>$this->idorangtua])->one();
        return $ortu['namaortu'];
    }
}
