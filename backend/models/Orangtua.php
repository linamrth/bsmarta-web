<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\db\Query;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * This is the model class for table "orangtua".
 *
 * @property int $idorangtua
 * @property string $namaortu
 * @property string $jeniskelamin L=Lakilaki, P=Perempuan
 * @property string $telepon
 * @property string $foto
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
            [['namaortu', 'jeniskelamin', 'telepon', 'foto'], 'required'],
            [['namaortu'], 'string', 'max' => 50],
            [['jeniskelamin'], 'string', 'max' => 1],
            [['telepon'], 'string', 'max' => 15],
            [['foto'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idorangtua' => 'Idorangtua',
            'namaortu' => 'Namaortu',
            'jeniskelamin' => 'Jeniskelamin',
            'telepon' => 'Telepon',
            'foto' => 'Foto',
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
