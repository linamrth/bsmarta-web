<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Guru;
use backend\models\Programlevel;
use backend\models\Program;

/**
 * This is the model class for table "guruskill".
 *
 * @property integer $idguruskill
 * @property integer $idguru
 * @property integer $idprogramlevel
 */
class Guruskill extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guruskill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idguru', 'idprogramlevel'], 'required'],
            [['idguru', 'idprogramlevel'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idguruskill' => 'Idguruskill',
            'idguru' => 'Idguru',
            'idprogramlevel' => 'Idprogramlevel',
        ];
    }

    public function listGuru()
    {
        $guru = Guru::find()->all();
        return ArrayHelper::map($guru, 'idguru', 'namaguru');
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
