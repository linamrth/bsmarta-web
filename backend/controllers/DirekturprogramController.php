<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;

use backend\models\Programlevel;
use backend\models\Siswabelajar;
use backend\models\Orangtua;

class DirekturprogramController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $programlevel = Programlevel::find()->all();
        return $this->render('index', ['programlevel'=>$programlevel]);
    }

    public function actionView($id)
    {
    	$programlevel = Programlevel::find()->where(['idprogramlevel'=>$id])->one();
    	$siswabelajar = Siswabelajar::find()
    		->leftJoin('siswa', 'siswabelajar.idsiswa = siswa.idsiswa')
    		->where([
    			'siswabelajar.idprogramlevel'=>$programlevel->idprogramlevel, 
    			'siswa.idcabang'=>Yii::$app->user->identity->idcabang])
    		->all();

    	return $this->render('view', [
    		'judul'=>$programlevel,
    		'model' => $siswabelajar,
		]);
    }
}
