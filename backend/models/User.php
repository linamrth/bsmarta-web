<?php

namespace backend\models;

use Yii;

use backend\models\Guru;
use backend\models\Cabang;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $level
 * @property integer $idguru
 * @property integer $idcabang
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at', 'level', 'idguru', 'idorangtua', 'idcabang'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'level' => 'Level',
            'idguru' => 'Idguru',
            'idorangtua' => 'Idorangtua',
            'idcabang' => 'Idcabang',
        ];
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
