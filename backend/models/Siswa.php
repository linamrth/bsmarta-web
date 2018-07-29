<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Cabang;
use backend\models\Orangtua;

/**
 * This is the model class for table "siswa".
 *
 * @property int $idsiswa
 * @property int $idcabang
 * @property int $idorangtua
 * @property string $foto
 * @property string $namalengkap
 * @property string $namapanggilan
 * @property string $alamat
 * @property string $tempatlahir
 * @property string $tgllahir
 * @property string $asalsekolah
 * @property string $kelas
 * @property string $tgldaftar
 * @property string $keterangan
 * @property string $statussiswa N=Belum Trial, T=Sudah Daftar Trial, M=Selesai Trial, Y=Siswa Kursus
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
            [['idcabang', 'idorangtua', 'foto', 'namalengkap', 'namapanggilan', 'alamat', 'tempatlahir', 'tgllahir', 'asalsekolah', 'kelas', 'tgldaftar', 'keterangan'], 'required'],
            [['idcabang', 'idorangtua'], 'integer'],
            [['alamat', 'keterangan'], 'string'],
            [['tgllahir', 'tgldaftar'], 'safe'],
            [['foto'], 'string', 'max' => 200],
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
            'foto' => 'Foto',
            'namalengkap' => 'Namalengkap',
            'namapanggilan' => 'Namapanggilan',
            'alamat' => 'Alamat',
            'tempatlahir' => 'Tempatlahir',
            'tgllahir' => 'Tgllahir',
            'asalsekolah' => 'Asalsekolah',
            'kelas' => 'Kelas',
            'tgldaftar' => 'Tgldaftar',
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
