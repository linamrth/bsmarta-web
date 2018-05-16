<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Programlevel;
use backend\models\Program;

/**
 * This is the model class for table "materi".
 *
 * @property integer $idmateri
 * @property integer $idprogramlevel
 * @property integer $hal
 * @property string $materi
 */
class Materi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idprogramlevel', 'hal', 'materi'], 'required'],
            [['idprogramlevel', 'hal'], 'integer'],
            [['materi'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idmateri' => 'Idmateri',
            'idprogramlevel' => 'Idprogramlevel',
            'hal' => 'Hal',
            'materi' => 'Materi',
        ];
    }

    public function listProgram()
    {
        $program = Programlevel::find()
            ->select('programlevel.*, program.namaprogram')
            ->leftJoin('program','program.idprogram = programlevel.idprogram')
            ->where(['idprogramlevel'=>$this->idprogramlevel])
            ->asArray()
            ->one();

        return $program['namaprogram']." - ".$program['level'];
    }

    public function listProgramLevel()
    {
        $program = Programlevel::find()
            ->select('programlevel.*, program.namaprogram')
            ->leftJoin('program','program.idprogram = programlevel.idprogram')
            ->asArray()
            ->all();
        
        return ArrayHelper::map($program, 'idprogramlevel', function($model) { 
            return $model['namaprogram'].' - '.$model['level']; 
        });   
    }
}
