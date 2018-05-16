<?php

namespace backend\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use backend\models\Trial;

class RapottrialcintabacaForm extends Model
{
	public $soal1,$soal2,$soal3,$soal4,$soal5,$soal6,$soal7,$soal8,$soal9,$soal10,$soal11,$catatan;
	
	public function rules()
	{
		return [
			[['soal1','soal2','soal3','soal4','soal5','soal6','soal7','soal8','soal9','soal10','soal11'],'required'],
			[['catatan'],'string','max'=>300]
		];

	}

	public function attributeLabels()
	{
		return [
			'soal1' => 'Pernah mengikuti program baca dan tulis',
			'soal2' => 'Pengenalan Huruf Vokal',
			'soal3' => 'Pengenalan Huruf Konsonan',
			'soal4' => 'Membaca Suku Kata Terbuka',
			'soal5' => 'Membaca Suku Kata Tertutup',
			'soal6' => 'Menulis Suku Kata Terbuka',
			'soal7' => 'Menulis Suku Kata Terbuka',
			'soal8' => 'Kemandirian',
			'soal9' => 'Kemampuan Komunikasi',
			'soal10' => 'Berkebutuhan Khusus',
			'soal11' => 'Bergaransi',
			'catatan' => 'Catatan',
		];
	}
}