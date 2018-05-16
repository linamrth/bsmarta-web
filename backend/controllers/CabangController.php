<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;

use backend\models\Cabang;

class CabangController extends \yii\web\Controller
{
	public function beforeAction($action)
	{
	    Yii::$app->request->enableCsrfValidation = false;
	    return parent::beforeAction($action);
	}

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionViewcabang()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$student = Cabang::find()->all();
		if(count($student) > 0 ) {
			return array('status' => true, 'data'=> $student);
		} else {
			return array('status'=>false,'data'=> 'No Student Found');
		}
	}

	public function actionCreatecabang()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;
		$student = new Cabang();
		$student->scenario = Cabang::SCENARIO_CREATE;
		$student->attributes = Yii::$app->request->post();
		
		if($student->validate()) {
			$student->save();
			return array('status' => true, 'data'=> 'Student record is successfully updated');
		} else {
			return array('status'=>false,'data'=>$student->getErrors());    
		}
	}

	public function actionUpdatecabang()
	{
		Yii::$app->response->format = Response::FORMAT_JSON;     
		$attributes = Yii::$app->request->post();
		$student = Cabang::find()->where(['idcabang' => $attributes['idcabang'] ])->one();
		if(count($student) > 0 ) {
			$student->attributes = Yii::$app->request->post();
			$student->save();
			return array('status' => true, 'data'=> 'Student record is updated successfully');       
		} else {
			return array('status'=>false,'data'=> 'No Student Found');
		}
	}

	public function actionDeletecabang()
	{
		Yii::$app->response->format = Response:: FORMAT_JSON;
		$attributes = Yii::$app->request->post();
		$student = Cabang::find()->where(['idcabang' => $attributes['idcabang'] ])->one();  
		if(count($student) > 0 ) {
			$student->delete();
			return array('status' => true, 'data'=> 'Student record is successfully deleted'); 
		} else {
			return array('status'=>false,'data'=> 'No Student Found');
		}
	}


}
