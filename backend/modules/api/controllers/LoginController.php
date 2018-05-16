<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use common\models\User;

/**
 * Default controller for the `api` module
 */
class LoginController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
    	Yii::$app->response->format = Response::FORMAT_JSON;

    	$tabel = new User();
        if (Yii::$app->request->post()) {
        	$model 		= Yii::$app->request->post();
        	$userdata	= $tabel->findByUsername($model['username']);
            $validasi 	= Yii::$app->security->validatePassword($model['password'], $userdata->password_hash);
            
            if($userdata && $validasi){
            	return ['status'=>'OK', 'result'=>$userdata];
            }
            else{
            	return ['status'=>'FAIL', 'result'=>'Username or password wrong!!!.'];
            }
        }
    }
}