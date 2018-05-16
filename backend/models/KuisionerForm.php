<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

use backend\models\Kuisioner;

class KuisionerForm extends Model
{
    public $penguasaanmateri;
    public $kemampuanmengajar;
    public $kedisiplinan;
    public $tanggungjawabdantingkahlaku;
    public $kerjasama;
   
    public function rules()
    {
        return [
            [['penguasaanmateri', 'kemampuanmengajar', 'kedisiplinan', 'tanggungjawabdantingkahlaku', 'kerjasama'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'penguasaanmateri' => 'Penguasaan Materi',
            'kemampuanmengajar' => 'Kemampuan Mengajar',
            'kedisiplinan' => 'Kedisiplinan',
            'tanggungjawabdantingkahlaku' => 'Tanggung Jawab dan Tingkah Laku',
            'kerjasama' => 'Kerjasama',
        ];
    }
}