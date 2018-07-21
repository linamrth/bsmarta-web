<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\db\Query;

use backend\models\Guru;
use backend\models\Guruskill;
use backend\models\Cabang;

class AdminguruController extends \yii\web\Controller
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
        $guru = Guru::find()->orderBy(['namaguru' => SORT_ASC])->all();
        return $this->render('index', ['gurus'=>$guru]);
    }

    public function actionView($id)
    {
        $guru = Guru::find()->where(['idguru'=>$id])->one();
        $guruskill = Guruskill::find()->where(['idguru'=>$guru['idguru']])
            ->orderBy(['idguruskill' => SORT_ASC])
            ->all();
        return $this->render('view', ['guru' => $guru, 'guruskill' => $guruskill]);
    }

    public function actionCreateguruskill($id)
    {
        $model = new Guruskill();
        $model->idguru = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idguru]);
        }
        else{
            return $this->render('createguruskill', ['model' => $model]);
        }
    }

    public function actionCreate()
    {
        $model = new Guru();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idguru]);
        }
        else{
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idguru]);
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
        if (($model = Guru::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
