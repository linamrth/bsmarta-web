<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;

use backend\models\Programlevel;
use backend\models\Siswabelajar;
use backend\models\Orangtua;

class DirekturjumlahsiswaController extends \yii\web\Controller
{
    public function actionProgram()
    {
        $programlevel = Programlevel::find()->all();
        return $this->render('program', ['programlevel'=>$programlevel]);
    }

    public function actionKelas()
    {
    	$kelas = Siswabelajar::find()->all();
    	return $this->render('kelas', ['kelas'=>$kelas]);
    }

    public function actionGuru()
    {
    	$guru = Guru::find()->all();
    	return $this->render('guru', ['guru'=>$guru]);
    }
}
