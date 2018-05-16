<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Siswa;
use backend\models\Program;
use backend\models\Cabang;
use backend\models\Orangtua;

/**
 * This is the model class for table "siswabelajar".
 *
 * @property integer $idsiswabelajar
 * @property integer $idsiswa
 * @property integer $idprogramlevel
 * @property integer $idcabang
 * @property string $tgldaftar
 */
class Siswabelajar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'siswabelajar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswa', 'idprogramlevel', 'idcabang'], 'required'],
            [['idsiswa', 'idprogramlevel', 'idcabang'], 'integer'],
            [['tgldaftar'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsiswabelajar' => 'Idsiswabelajar',
            'idsiswa' => 'Idsiswa',
            'idprogramlevel' => 'Idprogramlevel',
            'idcabang' => 'Idcabang',
            'tgldaftar' => 'Tgldaftar',
        ];
    }

    public function getSiswa()
    {
        $nmsiswa = Siswa::find()->where(['idsiswa'=>$this->idsiswa])->one();
        return $nmsiswa['namalengkap'];
    }

    public function getProgram()
    {
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$this->idprogramlevel])->one();
        $nmprogram = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();
        return $nmprogram['namaprogram'];
    }

    public function getLevel()
    {
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$this->idprogramlevel])->one();
        return $lvprogram['level'];
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
