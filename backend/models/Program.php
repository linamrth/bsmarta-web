<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "program".
 *
 * @property integer $idprogram
 * @property string $namaprogram
 * @property string $fasilitas
 * @property integer $biayadaftar
 * @property integer $biayakursus
 * @property string $biayatambahan
 * @property string $deskripsi
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['namaprogram', 'fasilitas', 'biayadaftar', 'biayakursus', 'biayatambahan', 'deskripsi'], 'required'],
            [['biayadaftar', 'biayakursus'], 'integer'],
            [['deskripsi'], 'string'],
            [['namaprogram'], 'string', 'max' => 50],
            [['fasilitas', 'biayatambahan'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idprogram' => 'Idprogram',
            'namaprogram' => 'Namaprogram',
            'fasilitas' => 'Fasilitas',
            'biayadaftar' => 'Biayadaftar',
            'biayakursus' => 'Biayakursus',
            'biayatambahan' => 'Biayatambahan',
            'deskripsi' => 'Deskripsi',
        ];
    }
}
