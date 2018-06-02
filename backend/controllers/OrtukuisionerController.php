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
use backend\models\HasilKuisioner;
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
    		SELECT siswa.namalengkap, kuisioner.tanggal, program.namaprogram, programlevel.level, guru.namaguru, kuisioner.idkuisioner, kuisioner.idsiswabelajar, kuisioner.statuskuisioner
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
            $tabel->save();

            // //proses
            // $hasilpalingakhir = $this->insertNilaiKuisioner($result['tanggal']);
            // for ($i=0; $i < count($hasilAkhir); $i++) { 
            //     $hasilkuis = new Hasilpenilaian();
            //     $hasilkuis->mingguke = $hasilpalingakhir[$i]['tanggal'];
            //     $hasilkuis->idguru  = $hasilpalingakhir[$i]['idguru'];
            //     $hasilkuis->hasil   = $hasilpalingakhir[$i]['hasil'];
            //     $hasilkuis->save();
            // }

            return $this->redirect(['view', 'id'=>$result[0]['idsiswabelajar']]);
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

    protected function insertNilaiKuisioner($id)
    {
        $convertWeek = date('W', strtotime($id));
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT 
                idguru, idorangtua, tanggal, WEEK(tanggal) AS mingguke, 
                COUNT(idorangtua) as orangtua,
                SUM(penguasaanmateri) AS penguasaanmateri, SUM(kemampuanmengajar) AS kemampuanmengajar, SUM(kedisiplinan) AS kedisiplinan, 
                SUM(tanggungjawabdantingkahlaku) AS tanggungjawabdantingkahlaku,  SUM(kerjasama) AS kerjasama
            FROM 
                kuisioner
            WHERE 
                statuskuisioner = 'S' 
                AND WEEK(tanggal) = '".($convertWeek-1)."'
            GROUP BY 
                WEEK(tanggal),
                idguru");

        $result1 = $command->queryAll();

        //deklrasai var
        $penyebutC1 = [];
        $penyebutC2 = [];
        $penyebutC3 = [];
        $penyebutC4 = [];
        $penyebutC5 = [];
        $tempIdGuru = [];
        //proses push array
        foreach ($result1 as $key) {
            array_push($penyebutC1, $key['penguasaanmateri']);
            array_push($penyebutC2, $key['kemampuanmengajar']);
            array_push($penyebutC3, $key['kedisiplinan']);
            array_push($penyebutC4, $key['tanggungjawabdantingkahlaku']);
            array_push($penyebutC5, $key['kerjasama']);
            array_push($tempIdGuru, $key['idguru']);
        }

        //menghitung baris.kolom dibagi dengan penyebut terbesar
        $result2 = $command->queryAll();
        $dataHasil = [];
        foreach ($result2 as $key) {
            array_push($dataHasil, [
                'c1'=>$key['penguasaanmateri']/max($penyebutC1),
                'c2'=>$key['kemampuanmengajar']/max($penyebutC2),
                'c3'=>$key['kedisiplinan']/max($penyebutC3),
                'c4'=>$key['tanggungjawabdantingkahlaku']/max($penyebutC4),
                'c5'=>$key['kerjasama']/max($penyebutC5)
            ]);
        }

        //mencari nilai akhir dari perhitungan saw (v)
        $bobotC1 = 0.25;
        $bobotC2 = 0.25;
        $bobotC3 = 0.10;
        $bobotC4 = 0.25;
        $bobotC5 = 0.15;

        $hasilAkhir = [];

        for ($i=0; $i < count($dataHasil); $i++) { 
            $itungan = ($dataHasil[$i]['c1']*$bobotC1) + ($dataHasil[$i]['c2']*$bobotC2) + ($dataHasil[$i]['c3']*$bobotC3)
            + ($dataHasil[$i]['c4']*$bobotC4) +  ($dataHasil[$i]['c5']*$bobotC5);

            array_push($hasilAkhir, $itungan);
        }

        //hasil akhir perhitungan dibagi dengan jumlah orang tua yang menginputkan nilai ke setiap guru
        $result3 = $command->queryAll();
        $tempPembagi = [];
        foreach ($result3 as $key) {
            array_push($tempPembagi, $key['orangtua']);
        }

        //hasil akhir dari semua perhitungan dalam satu minggu
        $hasilpalingakhir = [];
        for ($i=0; $i < count($hasilAkhir); $i++) { 
            array_push($hasilpalingakhir, [
                'hasil'=>$hasilAkhir[$i]/$tempPembagi[$i], 
                'idguru'=>$tempIdGuru[$i], 'tanggal'=>$id
            ]);
        }

        return $hasilpalingakhir;
    }
}