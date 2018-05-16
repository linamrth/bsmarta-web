<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\db\Query;

use backend\models\Kuisioner;
use backend\models\KuisionerForm;
use backend\models\Siswabelajar;
use backend\models\Orangtua;

class OrtukuisionerController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$ambilidortu = Yii::$app->user->identity->idorangtua;
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("
		    SELECT siswa.*, program.namaprogram, programlevel.level, orangtua.idorangtua, siswabelajar.idsiswabelajar
			FROM siswabelajar
			INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
			INNER JOIN orangtua ON siswa.idorangtua = orangtua.idorangtua
			INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
			INNER JOIN program ON programlevel.idprogram = program.idprogram
			WHERE orangtua.idorangtua = $ambilidortu
			ORDER BY siswa.namalengkap");
		$result = $command->queryAll();

		return $this->render('index', ['result' => $result]);
    }

    public function actionView($id)
    {
    	$connection = Yii::$app->getDb();
    	$command = $connection->createCommand("
    		SELECT siswa.namalengkap, program.namaprogram, programlevel.level, kuisioner.tanggal, guru.namaguru, kuisioner.idkuisioner, kuisioner.statuskuisioner
			FROM kuisioner
			INNER JOIN siswabelajar ON kuisioner.idsiswabelajar = siswabelajar.idsiswabelajar
			INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
			INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
			INNER JOIN program ON programlevel.idprogram = program.idprogram
			INNER JOIN guru ON kuisioner.idguru = guru.idguru
			WHERE kuisioner.idsiswabelajar = '".$id."'");
    	$result = $command->queryAll();

		return $this->render('view', ['result' => $result]);
    }

    public function actionInputkuisioner($id)
    {
    	$connection = Yii::$app->getDb();
    	$command = $connection->createCommand("
    		SELECT siswa.namalengkap, program.namaprogram, programlevel.level, guru.namaguru, kuisioner.idkuisioner, kuisioner.idsiswabelajar, kuisioner.statuskuisioner
			FROM kuisioner
			INNER JOIN siswabelajar ON kuisioner.idsiswabelajar = siswabelajar.idsiswabelajar
			INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
			INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
			INNER JOIN program ON programlevel.idprogram = program.idprogram
			INNER JOIN guru ON kuisioner.idguru = guru.idguru
			WHERE kuisioner.idkuisioner = '".$id."'");
    	$result = $command->queryAll();

    	$model = new KuisionerForm();
        $tabel = Kuisioner::find()->Where(['idkuisioner'=>$id])->one();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {

            $tabel->penguasaanmateri    		= $model->penguasaanmateri;
            $tabel->kemampuanmengajar   		= $model->kemampuanmengajar;
            $tabel->kedisiplinan        		= $model->kedisiplinan;
            $tabel->tanggungjawabdantingkahlaku = $model->tanggungjawabdantingkahlaku;
            $tabel->kerjasama               	= $model->kerjasama;
            $tabel->statuskuisioner 			= 'S';

            if($tabel->save())
            {
                return $this->redirect(['view', 'id'=>$result[0]['idsiswabelajar']]);
            }
        } else {
            $back = $result[0]['idsiswabelajar'];
            return $this->render('inputkuisioner', [
                'model'=>$model,
                'result'=>$result,
                'back'=>$back
            ]);
        }
    }

    public function actionLihatkuisioner($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT guru.namaguru, siswa.namalengkap, program.namaprogram, programlevel.level, kuisioner.tanggal, kuisioner.penguasaanmateri, kuisioner.kemampuanmengajar, kuisioner.kedisiplinan, kuisioner.tanggungjawabdantingkahlaku, kuisioner.kerjasama, siswabelajar.idsiswabelajar
            FROM kuisioner
            INNER JOIN guru ON kuisioner.idguru = guru.idguru
            INNER JOIN siswabelajar ON kuisioner.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE kuisioner.idkuisioner = '".$id."'");
        $result = $command->queryAll();

        $back = $result[0]['idsiswabelajar'];
        return $this->render('lihatkuisioner', ['result' => $result, 'back' => $back]);
    }
}
