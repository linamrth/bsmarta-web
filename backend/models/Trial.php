<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Siswa;
use backend\models\Program;
use backend\models\Orangtua;
use backend\models\Cabang;
/**
 * This is the model class for table "trial".
 *
 * @property integer $idtrial
 * @property integer $idsiswa
 * @property integer $idprogramlevel
 * @property string $status
 */
class Trial extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trial';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswa', 'idprogram'], 'required'],
            [['idsiswa', 'idprogram'], 'integer'],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtrial' => 'Idtrial',
            'idsiswa' => 'Idsiswa',
            'idprogram' => 'Idprogram',
            'status' => 'Status',
        ];
    }

    public function getNamaguru()
    {
        $namaguru = Guru::find()->where(["idguru"=>$this->idguru])->one();
        return $namaguru["namaguru"];
    }

    public function getSiswa()
    {
        $siswa = Siswa::find()->where(['idsiswa'=>$this->idsiswa])->one();
        return $siswa['namalengkap'];
    }

    public function getProgram()
    {
        $program = Program::find()->where(['idprogram'=>$this->idprogram])->one();
        return $program['namaprogram'];
    }

    public function listSiswa()
    {
        $siswa = Siswa::find()->all();
        return ArrayHelper::map($siswa, 'idsiswa', 'namalengkap');
    }

    public function listProgram()
    {
        $program = Program::find()->all();
        return ArrayHelper::map($program, 'idprogram', 'namaprogram');
    }
}
