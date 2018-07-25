<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use common\models\User;

use backend\models\ChangepasswordForm;

/**
 * Default controller for the `api` module
 */
class EditpasswordController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionEditpassword()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        // return 'lina';

    	$model = new ChangepasswordForm();

        if (Yii::$app->request->post()) {
            $model->_id = Yii::$app->request->post()['_id'];
            $model->password = Yii::$app->request->post()['password'];
            $model->repeatedPassword = Yii::$app->request->post()['repeatedPassword'];

            $user = $model->changePassword();
            
            return ['status'=>'OK', 'user'=>$user];
        }
    }
}