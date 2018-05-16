<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\web\Controller;
use yii\db\Query;

use backend\models\Guruskill;
use backend\models\Guru;

class GuruprofilController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$ambilidguru = Yii::$app->user->identity->idguru;
        $guruskill = Guruskill::find()->where(['idguru'=> $ambilidguru])->orderBy(['idguruskill' => SORT_ASC])->all();
        return $this->render('index', ['guruskills'=>$guruskill]);
    }
}
