<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use backend\models\Guru;
use backend\models\Guruskill;

class RapotbelajarForm extends Model
{
	public $pertemuanke;
	public $idguru;
	public $materi;
	public $halamanketercapaian;
	public $hasil;
	public $catatanguru;
	public $rewardhasil;
	public $rewardsikap;

	public function rules()
	{
		return[
			[['idguru','materi','hasil', 'catatanguru',
					'rewardhasil','rewardsikap'], 
				'required'],
			[['pertemuanke'], 'integer'],
			[['halamanketercapaian'], 'integer'],
		];
	}

	public function attributeLabels()
	{
		return[
			'pertemuanke' 			=> 'Pertemuan Ke',
			'idguru' 				=> 'Nama Guru',
			'materi' 				=> 'Materi',
			'halamanketercapaian' 	=> 'Halaman Ketercapaian',
			'hasil' 				=> 'Hasil',
			'catatanguru' 			=> 'Catatan Guru',
			'rewardhasil' 			=> 'Reward Hasil',
			'rewardsikap' 			=> 'Reward Sikap',
		];
	}

	public function dataGuru()
    {
    	$gurunya = Guruskill::find()
    		->select('guruskill.*, guru.*')
    		->leftJoin('guru', 'guru.idguru = guruskill.idguru')
    		->where([
    			'guru.idcabang'=>Yii::$app->user->identity->idcabang,
    		])
    		->asArray()
    		->all();

        return ArrayHelper::map($gurunya,'idguru',function($mode){ 
        	return $mode['namaguru'];
        });
    }
}