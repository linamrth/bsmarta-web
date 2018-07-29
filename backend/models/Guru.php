<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

use backend\models\Guru;
use backend\models\Cabang;

/**
 * This is the model class for table "guru".
 *
 * @property int $idguru
 * @property int $idcabang
 * @property string $namaguru
 * @property string $telepon
 * @property string $alamat
 * @property string $foto
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
            [['idcabang', 'namaguru', 'telepon', 'alamat', 'foto'], 'required'],
            [['idcabang'], 'integer'],
            [['namaguru'], 'string', 'max' => 30],
            [['telepon'], 'string', 'max' => 15],
            [['alamat'], 'string', 'max' => 100],
            [['foto'], 'string', 'max' => 200],
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
            'namaguru' => 'Namaguru',
            'telepon' => 'Telepon',
            'alamat' => 'Alamat',
            'foto' => 'Foto',
        ];
    }

    public function getCabang()
    {
        $Guru = Cabang::find()->where(['idcabang'=>$this->idcabang])->one();
        return $Guru['namacabang'];
    }

    public function listCabang()
    {
        $cabang = Cabang::find()->all();
        return ArrayHelper::map($cabang, 'idcabang', 'namacabang');
    }
}
