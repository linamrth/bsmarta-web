<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;

Class ChangepasswordForm extends Model{
	public $password;
	public $repeatedPassword;
	public $_id;

	public function rules(){
		return[
			[['password', 'repeatedPassword', '_id'], 'required'],
			['repeatedPassword', 'compare', 'compareAttribute'=>'password'],
		];
	}

	public function changePassword(){
		if (!$this->validate()) {
			return null;
		}

		$user = User::findIdentity($this->_id);
		$user->setPassword($this->password);
		$user->generateAuthKey();

		return $user->save() ? $user : null;
	}
}