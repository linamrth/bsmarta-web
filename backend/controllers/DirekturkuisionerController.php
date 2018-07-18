<?php

namespace backend\controllers;

use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\db\Query;
use yii\base\DynamicModel;

use backend\models\Hasilpenilaian;
use backend\models\Guru;

class DirekturkuisionerController extends \yii\web\Controller
{
	public function actionIndex()
	{
		$model = new DynamicModel(['tahun', 'bulan']);
		$model->addRule(['tahun'], 'string');
		$model->addRule(['tahun'], 'required');
		$model->addRule(['bulan'], 'string');
		$model->addRule(['bulan'], 'required');

		//jiks di klik submit
		if($model->load(Yii::$app->request->post()) && $model->validate()) {
			$tanggal = $model['tahun'].'-'.$model['bulan'];

			//untuk membandingkan apakah bulan yg dipilih adalah bulan ini
			if ((int) $model['bulan'] > date('n')) {
				$pesan = 'Belum Ada Data Untuk Bulan Depan';
				$hasilnya = [];
			}
			//untuk membandingkan apakah hari ini merupakan hari terakhir pada bulan ini
			elseif ((int) $model['bulan'] == date('n')) {
				//jika hari ini bukan hari terakhir pada bulan ini maka tidak boleh tampil
				if (date('j') != date("j", strtotime("last day of this month"))) {
					$pesan = 'Tidak Ada Data Karena Belum Hari Terakhir';
					$hasilnya = [];
					
				}
				else {
					$pesan = 'Tidak Ada Data';
					$hasilnya = [];
				}
			}
			//jika hari ini hari terakhir pada bulan ini maka ditampilkan
			else {

				$pesan = 'Ada Data';
				$hasilnya = $this->hitungNilaiBulanan($tanggal);
					
			}

			return $this->render('index', [
				'model'=>$model, 
				'hasil'=>$hasilnya,
				'pesan'=>$pesan,
				'tahun'=>$this->getTahun(), 
				'bulan'=>$this->getBulan()
			]);
		}
		//jika tidak di klik submit
		else{
			$model->tahun = '';
			$model->bulan = '';
			return $this->render('index', [
				'model'=>$model, 
				'hasil'=>[], 
				'pesan'=>'',
				'tahun'=>$this->getTahun(), 
				'bulan'=>$this->getBulan()
			]);
		}
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
		$bobotC1 = 25;
		$bobotC2 = 25;
		$bobotC3 = 10;
		$bobotC4 = 25;
		$bobotC5 = 15;

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
			$gurunya = Guru::find()->where(['idguru'=>$tempIdGuru[$i]])->one();
			array_push($hasilpalingakhir, ['hasil'=>$hasilAkhir[$i]/$tempPembagi[$i], 'idguru'=>$tempIdGuru[$i], 'nmguru'=>$gurunya['namaguru']]);
			
		}

        return $this->render('bulanan', [
        	'hasil' => $hasilpalingakhir, 
        ]);
    }

  //   public function actionMingguan($id)
  //   {
  //   	$convertWeek = date('W', strtotime($id));
  //   	$connection = Yii::$app->getDb();
  //       $command = $connection->createCommand("
   //          SELECT 
			// 	idguru, idorangtua, tanggal, WEEK(tanggal) AS mingguke, 
			//     COUNT(idorangtua) as orangtua,
			// 	SUM(penguasaanmateri) AS penguasaanmateri, SUM(kemampuanmengajar) AS kemampuanmengajar, SUM(kedisiplinan) AS kedisiplinan, 
			//     SUM(tanggungjawabdantingkahlaku) AS tanggungjawabdantingkahlaku,  SUM(kerjasama) AS kerjasama
			// FROM 
			// 	kuisioner
			// WHERE 
			// 	statuskuisioner = 'S' 
			//     AND WEEK(tanggal) = '".($convertWeek-1)."'
			// GROUP BY 
			// 	WEEK(tanggal),
			//     idguru");

  //       $result1 = $command->queryAll();

  //       //deklrasai var
		// $penyebutC1 = [];
		// $penyebutC2 = [];
		// $penyebutC3 = [];
		// $penyebutC4 = [];
		// $penyebutC5 = [];
		// $tempIdGuru = [];
		// //proses push array
		// foreach ($result1 as $key) {
		// 	array_push($penyebutC1, $key['penguasaanmateri']);
		// 	array_push($penyebutC2, $key['kemampuanmengajar']);
		// 	array_push($penyebutC3, $key['kedisiplinan']);
		// 	array_push($penyebutC4, $key['tanggungjawabdantingkahlaku']);
		// 	array_push($penyebutC5, $key['kerjasama']);
		// 	array_push($tempIdGuru, $key['idguru']);
		// }

		// //menghitung baris.kolom dibagi dengan penyebut terbesar
		// $result2 = $command->queryAll();
		// $dataHasil = [];
		// foreach ($result2 as $key) {
		// 	array_push($dataHasil, [
		// 		'c1'=>$key['penguasaanmateri']/max($penyebutC1),
		// 		'c2'=>$key['kemampuanmengajar']/max($penyebutC2),
		// 		'c3'=>$key['kedisiplinan']/max($penyebutC3),
		// 		'c4'=>$key['tanggungjawabdantingkahlaku']/max($penyebutC4),
		// 		'c5'=>$key['kerjasama']/max($penyebutC5)
		// 	]);
		// }

		// //mencari nilai akhir dari perhitungan saw (v)
		// $bobotC1 = 0.25;
		// $bobotC2 = 0.25;
		// $bobotC3 = 0.10;
		// $bobotC4 = 0.25;
		// $bobotC5 = 0.15;

		// $hasilAkhir = [];

		// for ($i=0; $i < count($dataHasil); $i++) { 
		// 	$itungan = ($dataHasil[$i]['c1']*$bobotC1) + ($dataHasil[$i]['c2']*$bobotC2) + ($dataHasil[$i]['c3']*$bobotC3)
		// 	+ ($dataHasil[$i]['c4']*$bobotC4) +  ($dataHasil[$i]['c5']*$bobotC5);

		// 	array_push($hasilAkhir, $itungan);
		// }

		// //hasil akhir perhitungan dibagi dengan jumlah orang tua yang menginputkan nilai ke setiap guru
		// $result3 = $command->queryAll();
		// $tempPembagi = [];
		// foreach ($result3 as $key) {
		// 	array_push($tempPembagi, $key['orangtua']);
		// }

		// //hasil akhir dari semua perhitungan dalam satu minggu
		// $hasilpalingakhir = [];
		// for ($i=0; $i < count($hasilAkhir); $i++) { 
		// 	array_push($hasilpalingakhir, [
		// 		'hasil'=>$hasilAkhir[$i]/$tempPembagi[$i], 
		// 		'idguru'=>$tempIdGuru[$i], 'tanggal'=>$id
		// 	]);
		// }


		// for ($i=0; $i < count($hasilpalingakhir); $i++) { 
		// 	$hasilkuis = new Hasilpenilaian();
		// 	$hasilkuis->mingguke = $hasilpalingakhir[$i]['tanggal'];
		// 	$hasilkuis->idguru 	= $hasilpalingakhir[$i]['idguru'];
		// 	$hasilkuis->hasil 	= $hasilpalingakhir[$i]['hasil'];
		// 	$hasilkuis->save();
		// }

  //       return $this->render('mingguan', ['hasil' => $hasilpalingakhir, 'mingguKe'=>$convertWeek]);
  //   }

    protected function hitungNilaiBulanan($id)
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
		$bobotC1 = 25;
		$bobotC2 = 25;
		$bobotC3 = 10;
		$bobotC4 = 25;
		$bobotC5 = 15;

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
			$gurunya = Guru::find()->where(['idguru'=>$tempIdGuru[$i]])->one();
			array_push($hasilpalingakhir, ['hasil'=>$hasilAkhir[$i]/$tempPembagi[$i], 'idguru'=>$tempIdGuru[$i], 'nmguru'=>$gurunya['namaguru']]);
		}

        
        return $hasilpalingakhir;
    }

    protected function getBulan()
    {
    	$bulan = [
    		'01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni',
    		'07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',
    	];

    	return $bulan;
    }

    protected function getTahun() 
    {
    	$currentYear = date('Y');
	    $yearFrom = date('Y')-10;
	    $yearsRange = range($yearFrom, $currentYear);
	    return array_combine($yearsRange, $yearsRange);
    }
}
