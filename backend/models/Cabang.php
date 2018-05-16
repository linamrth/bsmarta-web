<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cabang".
 *
 * @property integer $idcabang
 * @property string $namacabang
 * @property string $jenis
 * @property string $alamat
 * @property string $telepon
 * @property string $fax
 * @property string $kabupaten
 */
class Cabang extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['namacabang','jenis','alamat','telepon','fax','kabupaten']; 
        return $scenarios; 
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cabang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['namacabang', 'jenis', 'alamat', 'telepon', 'kabupaten'], 'required'],
            [['namacabang', 'telepon', 'fax', 'kabupaten'], 'string', 'max' => 50],
            [['jenis'], 'string', 'max' => 10],
            [['alamat'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcabang' => 'Idcabang',
            'namacabang' => 'Nama Cabang',
            'jenis' => 'Jenis Cabang',
            'alamat' => 'Alamat Cabang',
            'telepon' => 'No Telepon',
            'fax' => 'Faximile',
            'kabupaten' => 'Kabupaten',
        ];
    }
}
