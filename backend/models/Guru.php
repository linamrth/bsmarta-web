<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Cabang;

/**
 * This is the model class for table "guru".
 *
 * @property integer $idguru
 * @property integer $idcabang
 * @property string $namaguru
 * @property string $telepon
 * @property string $alamat
 */
class Guru extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'guru';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcabang', 'namaguru', 'telepon', 'alamat'], 'required'],
            [['idcabang'], 'integer'],
            [['namaguru'], 'string', 'max' => 30],
            [['telepon'], 'string', 'max' => 15],
            [['alamat'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idguru' => 'Idguru',
            'idcabang' => 'Idcabang',
            'namaguru' => 'Nama Guru',
            'telepon' => 'No Telepon',
            'alamat' => 'Alamat',
        ];
    }

    public function getCabang()
    {
        $cabang = Cabang::find()->where(['idcabang'=>$this->idcabang])->one();
        return $cabang['namacabang'];
    }

    public function listCabang()
    {
        $cabang = Cabang::find()->all();
        return ArrayHelper::map($cabang, 'idcabang', 'namacabang');
    }
}
