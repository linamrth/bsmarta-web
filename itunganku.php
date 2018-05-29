<?php

$db = new mysqli('localhost','root','','bsmarta');

$sql = "SELECT 
		idguru, idorangtua, tanggal, WEEK(tanggal) AS mingguke, 
	    COUNT(idorangtua) as orangtua,
		SUM(penguasaanmateri) AS penguasaanmateri, SUM(kemampuanmengajar) AS kemampuanmengajar, SUM(kedisiplinan) AS kedisiplinan, 
	    SUM(tanggungjawabdantingkahlaku) AS tanggungjawabdantingkahlaku,  SUM(kerjasama) AS kerjasama
	FROM 
		kuisioner
	WHERE 
		statuskuisioner = 'S' 
	    AND WEEK(tanggal) = 18
	GROUP BY 
		WEEK(tanggal),
	    idguru";

// ======================================================================== //
$query1 = $db->query($sql);
//deklrasai var
$penyebutC1 = [];
$penyebutC2 = [];
$penyebutC3 = [];
$penyebutC4 = [];
$penyebutC5 = [];
//proses push array
while ($dd1 = $query1->fetch_assoc()) {
	array_push($penyebutC1, $dd1['penguasaanmateri']);
	array_push($penyebutC2, $dd1['kemampuanmengajar']);
	array_push($penyebutC3, $dd1['kedisiplinan']);
	array_push($penyebutC4, $dd1['tanggungjawabdantingkahlaku']);
	array_push($penyebutC5, $dd1['kerjasama']);
}

//proses pencarian nilai terbesar dari setiap kategori
echo max($penyebutC1)."\n";
echo max($penyebutC2)."\n";
echo max($penyebutC3)."\n";
echo max($penyebutC4)."\n";
echo max($penyebutC5)."\n";
// ======================================================================== //

$query = $db->query($sql);
$dataHasil = [];
echo "<table border='1'>";
	echo "<tr>";
		echo "<td>Guru</td>";
		echo "<td>C1</td>";
		echo "<td>C2</td>";
		echo "<td>C3</td>";
		echo "<td>C4</td>";
		echo "<td>C5</td>";
	echo "</tr>";

	//pembagian hasil per baris dan per kolom 
	while($dd = $query->fetch_assoc()) {
		echo "<tr>";
			echo "<td>".$dd['idguru']."</td>";
			echo "<td>".$dd['penguasaanmateri']/max($penyebutC1)."</td>";
			echo "<td>".$dd['kemampuanmengajar']/max($penyebutC2)."</td>";
			echo "<td>".$dd['kedisiplinan']/max($penyebutC3)."</td>";
			echo "<td>".$dd['tanggungjawabdantingkahlaku']/max($penyebutC4)."</td>";
			echo "<td>".$dd['kerjasama']/max($penyebutC5)."</td>";
		echo "</tr>";

		array_push($dataHasil, [
			'c1'=>$dd['penguasaanmateri']/max($penyebutC1),
			'c2'=>$dd['kemampuanmengajar']/max($penyebutC2),
			'c3'=>$dd['kedisiplinan']/max($penyebutC3),
			'c4'=>$dd['tanggungjawabdantingkahlaku']/max($penyebutC4),
			'c5'=>$dd['kerjasama']/max($penyebutC5)
		]);
	}
echo "</table>";

// ======================================================================== //

echo "<br>";
// print_r($dataHasil);
echo "<br>";

$bobotC1 = 0.25;
$bobotC2 = 0.25;
$bobotC3 = 0.10;
$bobotC4 = 0.25;
$bobotC5 = 0.15;

$hasilAkhir = [];

echo "<table border='1'>";
	echo "<tr>";
		echo "<td>Guru</td>";
		echo "<td>C1</td>";
		echo "<td>C2</td>";
		echo "<td>C3</td>";
		echo "<td>C4</td>";
		echo "<td>C5</td>";
	echo "</tr>";

	for ($i=0; $i < count($dataHasil); $i++) { 
		echo "<tr>";
			echo "<td>".($i+1)."</td>";
			echo "<td>".$dataHasil[$i]['c1']."</td>";
			echo "<td>".$dataHasil[$i]['c2']."</td>";
			echo "<td>".$dataHasil[$i]['c3']."</td>";
			echo "<td>".$dataHasil[$i]['c4']."</td>";
			echo "<td>".$dataHasil[$i]['c5']."</td>";
		echo "</tr>";

		$itungan = ($dataHasil[$i]['c1']*$bobotC1) + ($dataHasil[$i]['c2']*$bobotC2) + ($dataHasil[$i]['c3']*$bobotC3) 
			+ ($dataHasil[$i]['c4']*$bobotC4) +  ($dataHasil[$i]['c5']*$bobotC5);

		array_push($hasilAkhir, $itungan);
	}
echo "</table>";

echo "<br>";
print_r($hasilAkhir);
echo "<br>";

// ======================================================================== //

$query2 = $db->query($sql);
$tempPembagi = [];
while($dd3 = $query2->fetch_assoc()){
	array_push($tempPembagi, $dd3['orangtua']);
}

echo "count rows pembagi: ".count($tempPembagi)."<br>";
print_r($tempPembagi);

echo "<br>";
echo "Hasil Akhir Guru: <br>";
for ($i=0; $i < count($hasilAkhir); $i++) { 
	echo "guru-".($i+1).": ".$hasilAkhir[$i]/$tempPembagi[$i]."<br>";
}
