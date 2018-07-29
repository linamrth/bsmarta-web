<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

use backend\models\Guru;
use backend\models\Siswa;
use backend\models\Programlevel;
use backend\models\Cabang;
use backend\models\Orangtua;

class SiswaForm extends Model
{
    public $idcabang;
    public $idorangtua;
    public $foto;
    public $namalengkap;
    public $namapanggilan;
    public $alamat;
    public $tempatlahir;
    public $tgllahir;
    public $asalsekolah;
    public $kelas;
    public $keterangan;
   
    public function rules()
    {
        return [
            [['idcabang', 'idorangtua', 'namalengkap', 'namapanggilan', 'alamat', 'tempatlahir', 'tgllahir', 'asalsekolah', 'kelas', 'keterangan'], 'required'],
            [['idcabang', 'idorangtua'], 'integer'],
            [['alamat', 'keterangan'], 'string'],
            [['tgllahir'], 'safe'],
            [['foto'], 'file'],
            [['namalengkap'], 'string', 'max' => 50],
            [['namapanggilan'], 'string', 'max' => 15],
            [['tempatlahir', 'asalsekolah'], 'string', 'max' => 30],
            [['kelas'], 'string', 'max' => 20],
        ];
    }

    public function attributeLabels()
    {
        return [
            'idcabang' => 'Idcabang',
            'idorangtua' => 'Idorangtua',
            'foto' => 'Foto',
            'namalengkap' => 'Nama Lengkap',
            'namapanggilan' => 'Nama Panggilan',
            'alamat' => 'Alamat',
            'tempatlahir' => 'Tempat Lahir',
            'tgllahir' => 'Tanggal Lahir',
            'asalsekolah' => 'Asal Sekolah',
            'kelas' => 'Kelas',
            'keterangan' => 'Keterangan',
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