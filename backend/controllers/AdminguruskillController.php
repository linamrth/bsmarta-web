<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\db\Query;

use backend\models\Guruskill;
use backend\models\Guru;
use backend\models\Programlevel;
use backend\models\Program;

class AdminguruskillController extends \yii\web\Controller
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
    	$guruskill = Guruskill::find()->orderBy(['idguruskill' => SORT_ASC])->all();
        return $this->render('index', ['guruskills'=>$guruskill]);
    }

    public function actionCreate()
    {
        $model = new Guruskill();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idguruskill]);
        }
        else{
            return $this->render('create', ['model' => $model]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->idguruskill]);
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
        if (($model = Guruskill::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
