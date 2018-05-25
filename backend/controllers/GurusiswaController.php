<?php

namespace backend\controllers;

use Yii;
use yii\filters\VerbFilter;

use backend\models\Siswa;
use backend\models\Siswabelajar;
use backend\models\Programlevel;
use backend\models\Program;
use backend\models\Jadwal;
use backend\models\Jadwalgenerate;
use backend\models\Rapotbelajar;
use backend\models\RapotbelajarForm;
use backend\models\Lessonplan;

class GurusiswaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // $ambilidguru = Yii::$app->user->identity->idguru;
        // $connection = Yii::$app->getDb();
        // $command = $connection->createCommand("
        //     SELECT siswa.namalengkap, siswa.kelas, program.namaprogram, programlevel.level, siswabelajar.idsiswabelajar
        //     FROM siswabelajar
        //     RIGHT JOIN jadwal ON jadwal.idsiswabelajar = siswabelajar.idsiswabelajar
        //     LEFT JOIN programlevel ON programlevel.idprogramlevel = siswabelajar.idprogramlevel
        //     LEFT JOIN program ON program.idprogram = programlevel.idprogram
        //     LEFT JOIN siswa ON siswa.idsiswa = siswabelajar.idsiswa
        //     WHERE jadwal.idguru = '".$ambilidguru."'
        //     AND jadwal.statusjadwal = 'K'
        //     ORDER BY siswa.namalengkap");

        // $result = $command->queryAll();
        
        // return $this->render('index', ['siswabelajar'=>$result]);

        $siswabelajar = Siswabelajar::find()
            ->select('siswabelajar.*, jadwal.*')
            ->rightJoin('jadwal', 'jadwal.idsiswabelajar = siswabelajar.idsiswabelajar')
            ->leftJoin('programlevel', 'programlevel.idprogramlevel = siswabelajar.idprogramlevel')
            ->leftJoin('siswa', 'siswa.idsiswa = siswabelajar.idsiswa')
            ->where([
                'siswabelajar.idcabang'=>Yii::$app->user->identity->idcabang,
                'jadwal.idguru'=>Yii::$app->user->identity->idguru,
                ])
            ->orderBy('siswa.namalengkap')
            ->asArray()
            ->all();

        return $this->render('index', ['siswabelajar'=>$siswabelajar]);
    }

    public function actionView($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, program.namaprogram, programlevel.level, siswabelajar.idsiswabelajar
            FROM siswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE siswabelajar.idsiswabelajar = '".$id."'");
        $result = $command->queryAll();

        $jadwalgenerate = Jadwalgenerate::find()->where(['idsiswabelajar'=>$id])->orderBy(['tanggal'=>SORT_ASC])->all();
        
        return $this->render('view', [
            'result'=>$result,
            'jadwalgenerate'=>$jadwalgenerate,
        ]);
    }

    public function actionInputrapot($id)
    {
    	$pecah = explode("_", $id);
        $model = new RapotbelajarForm();
        $tabel = new Rapotbelajar();

        $jadwalgenerate = Jadwalgenerate::find()->where(['idgenerate'=>$pecah[0]])->one();
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwalgenerate->idsiswabelajar])->one();
        $nmsiswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
        $nmprogram = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();
        $lessonplan = Lessonplan::find()->where(['pertemuan'=>$pecah[1], 'idprogramlevel'=>$siswabelajar->idprogramlevel])->one();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {

            $tabel->idguru              = $model->idguru;
            $tabel->idgenerate          = $jadwalgenerate->idgenerate;
            $tabel->tanggal             = date('Y-m-d H:i:s');
            $tabel->materi              = $model->materi;
            $tabel->hasil               = $model->hasil;
            $tabel->halamanketercapaian = $model->halamanketercapaian;
            $tabel->pertemuanke         = $lessonplan->pertemuan;
            $tabel->catatanguru         = $model->catatanguru;
            $tabel->rewardhasil         = $model->rewardhasil;
            $tabel->rewardsikap         = $model->rewardsikap;
            $tabel->save();

            $jadwalgenerate->statusrapotkursus = 'S';
            $jadwalgenerate->save();
            
            return $this->redirect(['view', 'id'=>$jadwalgenerate['idsiswabelajar']]);
        } 
        else {
            $model->idguru = Yii::$app->user->identity->idguru;
            $model->materi = $lessonplan->materi;
            $model->halamanketercapaian = $lessonplan->hal;
            $back = $jadwalgenerate['idsiswabelajar'];
            return $this->render('inputrapot', [
                'model'=>$model,
                'nmsiswa'=>$nmsiswa,
                'lvprogram'=>$lvprogram,
                'nmprogram'=>$nmprogram,
                'jadwalgenerate'=>$jadwalgenerate,
                'back'=>$back
            ]);
        }
    }

    public function actionLihatrapot($id)
    {
        $rapot = Rapotbelajar::find()->where(['idgenerate'=>$id])->one();
        $jadwalgenerate = Jadwalgenerate::find()->where(['idgenerate'=>$rapot->idgenerate])->one();
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwalgenerate->idsiswabelajar])->one();
        $siswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
        $program = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();

        return $this->render('lihatrapot', [
            'rapot'=>$rapot,
            'siswabelajar'=>$siswabelajar,
            'siswa'=>$siswa,
            'lvprogram'=>$lvprogram,
            'program'=>$program,
            'back'=>$siswabelajar->idsiswabelajar
        ]);
    }

    public function actionGrafikperkembangan($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswabelajar.*, jadwalgenerate.*, rapotbelajar.*, programlevel.idprogramlevel
            FROM rapotbelajar
            INNER JOIN jadwalgenerate ON rapotbelajar.idgenerate = jadwalgenerate.idgenerate
            INNER JOIN siswabelajar ON jadwalgenerate.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            WHERE siswabelajar.idsiswabelajar = '".$id."'
            ORDER BY rapotbelajar.tanggal");
        $result = $command->queryAll();
        
        $hasiltarget = array();
        foreach ($result as $key) {
            array_push($hasiltarget, $key['halamanketercapaian']);
        }

        $data = Lessonplan::find()->where(['idprogramlevel'=>$result[0]['idprogramlevel']])->all();
        $pertemuan = array();
        $target = array();
        foreach ($data as $key) {
            array_push($pertemuan, $key['pertemuan']);
            array_push($target, $key['hal']);
        }

        return $this->render('grafikperkembangan', [
            'pertemuan'=>$pertemuan, 
            'target'=>$target,
            'hasiltarget'=>$hasiltarget,
            'back'=>$result[0]['idsiswabelajar'],
        ]);
    }

    public function actionAllsiswa()
    {
        $siswabelajar = Siswabelajar::find()
            ->select('siswabelajar.*, jadwal.*')
            ->rightJoin('jadwal', 'jadwal.idsiswabelajar = siswabelajar.idsiswabelajar')
            ->leftJoin('programlevel', 'programlevel.idprogramlevel = siswabelajar.idprogramlevel')
            ->leftJoin('siswa', 'siswa.idsiswa = siswabelajar.idsiswa')
            ->where([
                'siswabelajar.idcabang'=>Yii::$app->user->identity->idcabang,
                ])
            ->orderBy('siswa.namalengkap')
            ->asArray()
            ->all();

        return $this->render('allsiswa', ['siswabelajar'=>$siswabelajar]);
    }

    public function actionAllsiswaview($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswa.namalengkap, program.namaprogram, programlevel.level, siswabelajar.idsiswabelajar
            FROM siswabelajar
            INNER JOIN siswa ON siswabelajar.idsiswa = siswa.idsiswa
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            INNER JOIN program ON programlevel.idprogram = program.idprogram
            WHERE siswabelajar.idsiswabelajar = '".$id."'");
        $result = $command->queryAll();

        $jadwalgenerate = Jadwalgenerate::find()->where(['idsiswabelajar'=>$id])->orderBy(['tanggal'=>SORT_ASC])->all();
        
        return $this->render('allsiswaview', [
            'result'=>$result,
            'jadwalgenerate'=>$jadwalgenerate,
        ]);
    }

    public function actionAllsiswainputrapot($id)
    {
        $pecah = explode("_", $id);
        $model = new RapotbelajarForm();
        $tabel = new Rapotbelajar();

        $jadwalgenerate = Jadwalgenerate::find()->where(['idgenerate'=>$pecah[0]])->one();
        $Siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwalgenerate->idsiswabelajar])->one();
        $lessonplan = Lessonplan::find()->where(['pertemuan'=>$pecah[1], 'idprogramlevel'=>$Siswabelajar->idprogramlevel])->one();

        if($model->load(Yii::$app->request->post()) && $model->validate()) {

            $tabel->idguru              = $model->idguru;
            $tabel->idgenerate          = $jadwalgenerate->idgenerate;
            $tabel->tanggal             = date('Y-m-d H:i:s');
            $tabel->materi              = $model->materi;
            $tabel->hasil               = $model->hasil;
            $tabel->halamanketercapaian = $model->halamanketercapaian;
            $tabel->pertemuanke         = $lessonplan->pertemuan;
            $tabel->catatanguru         = $model->catatanguru;
            $tabel->rewardhasil         = $model->rewardhasil;
            $tabel->rewardsikap         = $model->rewardsikap;
            $tabel->save();

            $jadwalgenerate->statusrapotkursus = 'S';
            $jadwalgenerate->save();

            return $this->redirect(['allsiswaview', 'id'=>$jadwalgenerate['idsiswabelajar']]);
        } else {
            $model->materi = $lessonplan->materi;
            $model->halamanketercapaian = $lessonplan->hal;
            $back = $jadwalgenerate['idsiswabelajar'];
            return $this->render('allsiswainputrapot', [
                'model'=>$model,
                'jadwalgenerate'=>$jadwalgenerate,
                'back'=>$back
            ]);
        }
    }

    public function actionAllsiswalihatrapot($id)
    {
        $rapot = Rapotbelajar::find()->where(['idgenerate'=>$id])->one();
        $jadwalgenerate = Jadwalgenerate::find()->where(['idgenerate'=>$rapot->idgenerate])->one();
        $siswabelajar = Siswabelajar::find()->where(['idsiswabelajar'=>$jadwalgenerate->idsiswabelajar])->one();
        $siswa = Siswa::find()->where(['idsiswa'=>$siswabelajar->idsiswa])->one();
        $lvprogram = Programlevel::find()->where(['idprogramlevel'=>$siswabelajar->idprogramlevel])->one();
        $program = Program::find()->where(['idprogram'=>$lvprogram->idprogram])->one();

        return $this->render('allsiswalihatrapot', [
            'rapot'=>$rapot,
            'siswabelajar'=>$siswabelajar,
            'siswa'=>$siswa,
            'lvprogram'=>$lvprogram,
            'program'=>$program,
            'back'=>$siswabelajar->idsiswabelajar
        ]);
    }

    public function actionAllsiswagrafikperkembangan($id)
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            SELECT siswabelajar.*, jadwalgenerate.*, rapotbelajar.*, programlevel.idprogramlevel
            FROM rapotbelajar
            INNER JOIN jadwalgenerate ON rapotbelajar.idgenerate = jadwalgenerate.idgenerate
            INNER JOIN siswabelajar ON jadwalgenerate.idsiswabelajar = siswabelajar.idsiswabelajar
            INNER JOIN programlevel ON siswabelajar.idprogramlevel = programlevel.idprogramlevel
            WHERE siswabelajar.idsiswabelajar = '".$id."'
            ORDER BY rapotbelajar.tanggal");
        $result = $command->queryAll();
        
        $hasiltarget = array();
        foreach ($result as $key) {
            array_push($hasiltarget, $key['halamanketercapaian']);
        }

        $data = Lessonplan::find()->where(['idprogramlevel'=>$result[0]['idprogramlevel']])->all();
        $pertemuan = array();
        $target = array();
        foreach ($data as $key) {
            array_push($pertemuan, $key['pertemuan']);
            array_push($target, $key['hal']);
        }

        return $this->render('allsiswagrafikperkembangan', [
            'pertemuan'=>$pertemuan, 
            'target'=>$target,
            'hasiltarget'=>$hasiltarget,
            'back'=>$result[0]['idsiswabelajar'],
        ]);
    }

    public static function tglIndo($tanggal, $cetak_hari = false)
    {
        $hari = array ( 1 =>    
                    'Senin',
                    'Selasa',
                    'Rabu',
                    'Kamis',
                    'Jumat',
                    'Sabtu',
                    'Minggu'
                );
                
        $bulan = array (1 =>   
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
        $split    = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        
        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }
        return $tgl_indo;
    }
}
