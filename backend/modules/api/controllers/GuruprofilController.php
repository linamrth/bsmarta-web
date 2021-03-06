<?php

namespace backend\modules\api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

use backend\models\Guru;
use backend\models\Guruskill;

/**
 * Default controller for the `api` module
 */
class GuruprofilController extends Controller
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
            SELECT program.namaprogram, programlevel.level
            FROM guruskill 
            INNER JOIN guru ON guruskill.idguru = guru.idguru
            INNER JOIN programlevel ON guruskill.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            INNER JOIN cabang ON guru.idcabang = cabang.idcabang
            WHERE guru.idguru = '".$id."'");

        $queryProfile = $connection->createCommand("
            SELECT guru.foto, guru.namaguru, guru.telepon, guru.alamat, cabang.namacabang
            FROM guru, cabang
            WHERE guru.idcabang = cabang.idcabang AND guru.idguru = '".$id."'"
        );

        $result = $queryProfile->queryAll()[0];
        $result["program"] = $command->queryAll();
        
        return ['status'=>'OK', 'results'=>$result];
    }

    public function actionUpload($id)
    {
         Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        $model->foto = UploadedFile::getInstanceByName('foto');
        $model->foto->saveAs(Yii::getAlias('@admin').'/images/guru/' . $model->foto->baseName . '.' . $model->foto->extension);
        $model->foto = 'guru/'.$model->foto->baseName . '.' . $model->foto->extension;

        $model->save();
        return ['status'=>'OK', 'result'=>$model];
    }

    protected function findModel($id)
    {
        if (($model = Guru::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}