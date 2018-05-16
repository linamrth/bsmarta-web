<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

use common\models\User;

use backend\models\Guru;
use backend\models\Cabang;

Class UserForm extends Model{
    public $username;
    public $level;
    public $email;
    public $password;
    public $idcabang;
    public $idorangtua;
    public $idguru;

    public function rules(){
        return[
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already exists'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['idcabang', 'required'],
            ['level', 'required'],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email has already exists'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function daftarUser(){
        if($this->validate()){
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->idcabang = $this->idcabang;
            $user->idguru = $this->idguru;
            $user->level = $this->level;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }
        return null;
    }

    public function daftarUserortu(){
        if($this->validate()){
            $user = new User();
            $user->username     = $this->username;
            $user->email        = $this->email;
            $user->idcabang     = $this->idcabang;
            $user->idorangtua   = $this->idorangtua;
            $user->level        = $this->level;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->save();
            return $user;
        }
        return null;
    }

    public function getCabang()
    {
        $cabang = Cabang::find()->where(['idcabang'=>$this->idcabang])->one();
        return $cabang['namacabang'];
    }

    public function getGuru()
    {
        $Guru = Guru::find()->where(['idguru'=>$this->idguru])->one();
        return $Guru['namaguru'];
    }

    public function getLevel()
    {
        $level = ["1"=>"Administrator","2"=>"Kurikulum","3"=>"Guru","4"=>"Orangtua","5"=>"Direktur", "6"=>"Pimpinan"];
        return $level[$this->level];
    }

    public function listCabang()
    {
        $cabang = Cabang::find()->all();
        return ArrayHelper::map($cabang, 'idcabang', 'namacabang');
    }

    public function listGuru()
    {
        $guru = Guru::find()->all();
        return ArrayHelper::map($guru, 'idguru', 'namaguru');
    }

    public function listLevel()
    {
        $level = [
            ["id"=>"1", "level"=>"Administrator"],
            ["id"=>"2", "level"=>"Kurikulum"],
            ["id"=>"3", "level"=>"Guru"],
            ["id"=>"4", "level"=>"Orang Tua"],
            ["id"=>"5", "level"=>"Direktur"],
            ["id"=>"6", "level"=>"Pimpinan"],
        ];
        return ArrayHelper::map($level, 'id', 'level');
    }
}