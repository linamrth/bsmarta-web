<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

use backend\models\Orangtua;

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
            WHERE siswa.idorangtua = '".$id."'
            ORDER BY siswa.namalengkap");

        $queryProfile = $connection->createCommand("
            SELECT foto, namaortu, jeniskelamin, telepon
            FROM orangtua
            WHERE idorangtua = '".$id."'"
        );

        $result = $queryProfile->queryAll()[0];
        $result["siswa"] = $command->queryAll();
        
        return ['status'=>'OK', 'results'=>$result];
    }

    public function actionUpload($id)
    {
         Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        $model->foto = UploadedFile::getInstanceByName('foto');
        $model->foto->saveAs(Yii::getAlias('@admin').'/images/ortu/' . $model->foto->baseName . '.' . $model->foto->extension);
        $model->foto = 'ortu/'.$model->foto->baseName . '.' . $model->foto->extension;

        $model->save();
        return ['status'=>'OK', 'result'=>$model];
    }

    protected function findModel($id)
    {
        if (($model = Orangtua::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}