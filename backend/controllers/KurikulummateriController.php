<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\db\Query;

use backend\models\Materi;

class KurikulummateriController extends \yii\web\Controller
{
	public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
    	$materi = Materi::find()->orderBy(['idmateri' => SORT_ASC])->all();
        return $this->render('index', ['materis'=>$materi]);
    }

    public function actionCreate()
    {
        $model = new Materi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idmateri]);
        }
        else{
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idmateri]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    public function actionDelete($id)
    {
    	$this->findModel($id)->delete();
    	return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Materi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
