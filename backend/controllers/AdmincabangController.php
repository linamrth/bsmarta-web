<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\db\Query;

use backend\models\Cabang;

class AdmincabangController extends \yii\web\Controller
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
    	$cabang = Cabang::find()->orderBy(['namacabang' => SORT_ASC])->all();
        return $this->render('index', ['cabangs'=>$cabang]);
    }

    public function actionView($id)
    {
        $cabang = Cabang::find()->where(['idcabang'=>$id])->one();
        return $this->render('view', ['model' => $cabang]);
    }

    public function actionCreate()
    {
        $model = new Cabang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcabang]);
        }
        else{
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idcabang]);
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
        if (($model = Cabang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
