<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\db\Query;

use backend\models\User;
use backend\models\UserForm;

class AdminuserController extends \yii\web\Controller
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
        $user = User::find()->orderBy(['id' => SORT_ASC])->all();
        return $this->render('index', ['users'=>$user]);
    }

    public function actionView($id)
    {
        $user = User::find()->where(['id'=>$id])->one();
        return $this->render('view', ['model' => $user]);
    }

    public function actionCreate()
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post())) {
            $model->daftarUser();
            return $this->redirect(['index']);
        }
        else{
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
