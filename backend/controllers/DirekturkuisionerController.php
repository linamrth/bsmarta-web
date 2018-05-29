<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\db\Query;

class DirekturkuisionerController extends \yii\web\Controller
{
    public function actionMingguan($id)
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
			array_push($hasilpalingakhir, ['hasil'=>$hasilAkhir[$i]/$tempPembagi[$i], 'idguru'=>$tempIdGuru[$i]]);
		}

        return $this->render('index', ['hasil' => $hasilpalingakhir, 'mingguKe'=>$convertWeek]);
    }

    public function actionBulanan($id)
    {
    	$pecahTanggal = explode('-', $id);
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
			    AND tanggal LIKE '".$pecahTanggal[0]."-".$pecahTanggal[1]."%'
			GROUP BY 
				SUBSTRING(tanggal, 1, 7),
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
			array_push($hasilpalingakhir, ['hasil'=>$hasilAkhir[$i]/$tempPembagi[$i], 'idguru'=>$tempIdGuru[$i]]);
		}

        return $this->render('index', ['hasil' => $hasilpalingakhir, 'mingguKe'=>$pecahTanggal[0]."-".$pecahTanggal[1]]);
    }

}
