<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "orangtua".
 *
 * @property integer $idorangtua
 * @property string $namaortu
 * @property string $jeniskelamin
 * @property string $email
 * @property string $telepon
 */
class Orangtua extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orangtua';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['namaortu', 'jeniskelamin', 'telepon'], 'required'],
            [['namaortu'], 'string', 'max' => 50],
            [['jeniskelamin'], 'string', 'max' => 1],
            [['telepon'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idorangtua' => 'Idorangtua',
            'namaortu' => 'Nama Orang Tua',
            'jeniskelamin' => 'Jenis Kelamin',
            'telepon' => 'No Telepon',
        ];
    }

    public function listJeniskelamin()
    {
        $jeniskelamin = [
            ["id"=>"P","jeniskelamin"=>"Perempuan"],
            ["id"=>"L","jeniskelamin"=>"Laki-laki"]
        ];

        return ArrayHelper::map($jeniskelamin, "id", "jeniskelamin");
    }
}
