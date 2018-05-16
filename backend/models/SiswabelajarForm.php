<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

use backend\models\Guru;
use backend\models\Siswa;
use backend\models\Programlevel;

class SiswabelajarForm extends Model
{
    public $idsiswa;
    public $idprogramlevel;
   
    public function rules()
    {
        return [
            [['idsiswa', 'idprogramlevel'], 'required'],
            [['idsiswa', 'idprogramlevel'], 'integer'],
        ];
    }

    public function listSiswa()
    {
        $siswa = Siswa::find()->all();
        return ArrayHelper::map($siswa, 'idsiswa', 'namalengkap');
    }

    public function listProgramLevel()
    {
        $programlevel = Programlevel::find()
            ->select('programlevel.*, program.namaprogram')
            ->leftJoin('program','program.idprogram = programlevel.idprogram')
            ->asArray()
            ->all();
        
        return ArrayHelper::map($programlevel, 'idprogramlevel', function($model) { 
            return $model['namaprogram'].' - '.$model['level']; 
        });   
    }
}