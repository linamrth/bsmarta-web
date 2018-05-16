<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

use backend\models\Guru;
/**
 * Signup form
 */
class JadwaltrialForm extends Model
{
    public $idtrial;
    public $idguru;
    public $hari;
    public $jam;
    public $tanggal;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtrial','idguru','hari','jam','tanggal'], 'required'],
        ];
    }

    public function listGuru()
    {
        $guru = Guru::find()->all();
        return ArrayHelper::map($guru, 'idguru', 'namaguru');
    }

    public function getHari()
    {
        $hari = [
            'Senin'=>'Senin', 'Selasa'=>'Selasa', 'Rabu'=>'Rabu', 
            'Kamis'=>'Kamis', 'Jumat'=>'Jumat', 'Sabtu'=>'Sabtu'
        ];

        return $hari;
    }

    public function getJam()
    {
        $jam = [
            '1'=>'10.00-11.00', '2'=>'11.00-12.00', '3'=>'13.00-14.00', '4'=>'14.00-15.00', 
            '5'=>'15.00-16.00', '6'=>'16.00-17.00', '7'=>'18.00-19.00'
        ];

        return $jam;
    }
}
