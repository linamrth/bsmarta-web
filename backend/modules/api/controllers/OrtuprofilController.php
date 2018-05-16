<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

use backend\models\Guru;
use backend\models\Guruskill;

/**
 * Default controller for the `api` module
 */
class OrtuprofilController extends Controller
{
    public function beforeAction($action)
    {
        Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function actionIndex($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, siswa.kelas
            FROM siswa
            INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
            WHERE siswa.idorangtua = '".$id."'");

        $queryProfile = $connection->createCommand("
            SELECT namaortu, jeniskelamin, telepon
            FROM orangtua
            WHERE idorangtua = '".$id."'"
        );

        $result = $queryProfile->queryAll()[0];
        $result["siswa"] = $command->queryAll();
        
        return ['status'=>'OK', 'results'=>$result];
    }
}