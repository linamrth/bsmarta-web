<?php
namespace backend\models;

use yii\base\Model;
use yii\helpers\ArrayHelper;
use backend\models\Trial;

class RapottrialcintamatikaForm extends Model
{
	public $soal1,$soal2,$soal3,$soal4,$soal5,$soal6,$soal7,$soal8,$catatan;
	
	public function rules()
	{
		return [
			[['soal1','soal2','soal3','soal4','soal5','soal6','soal7','soal8'],'required'],
			[['catatan'],'string','max'=>300]
		];
	}

	public function attributeLabels()
	{
		return [
			'soal1' => 'Hafal angka 1-10',
			'soal2' => 'Paham Konsep Bilangan',
			'soal3' => 'Operasi hitung penjumlahan',
			'soal4' => 'Operasi hitung pengurangan',
			'soal5' => 'Pemahaman soal cerita',
			'soal6' => 'Kemandirian',
			'soal7' => 'Kemmapuan Komunikasi',
			'soal8' => 'Berkebutuhan Khusus',
			'catatan' => 'Catatan',
		];
	}
}