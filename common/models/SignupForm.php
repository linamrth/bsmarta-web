<?php
namespace common\models;

use common\models\User;
use yii\base\Model;
use Yii;

Class SignupForm extends Model{
	public $firstname;
	public $lastname;
	public $username;
	public $level;
	public $email;
	public $password;

	public function rules(){
		return[
			['username', 'filter', 'filter' => 'trial'],
			['username', 'required'],
			['firstname', 'required'],
			['lastname', 'required'],
			['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already exists'],
			['username', 'string', 'min' => 2, 'max' => 255],

			['level', 'required'],

			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email has already exists'],

			['password', 'required'],
			['password', 'string', 'min' => 6],
		];
	}

	public function signup(){
		if($this->validate()){
			$user = new User();
			$user->firstname = $this->firstname;
			$user->lastname = $this->lastname;
			$user->username = $this->username;
			$user->email = $this->email;
			$user->setPassword($this->password);
			$user->generateAuthKey();
			$user->save();
			return $user;
		}
		return null;
	}
}