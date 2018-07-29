<h1 class="heading">Lina Meritha</h1>
<table class="table table-bordered">
	<tr>
		<td>Nama Program</td>
		<td><?= $program->namaprogram; ?></td>
	</tr>
	<tr>
		<td>Fasilitas</td>
		<td>
			<?php
			$pecah = explode(',', $program->fasilitas);
			echo "<ul>";
			for ($i=0; $i < count($pecah); $i++) { 
				echo "<li>".$pecah[$i]."</li>";
			}
			echo "</ul>";
			?>
		</td>
	</tr>
	<tr>
		<td>Biaya Daftar</td>
		<td><?= $program->biayadaftar; ?></td>
	</tr>
	<tr>
		<td>Biaya Kursus</td>
		<td><?= $program->biayakursus; ?></td>
	</tr>
</table>

<hr>

<h1 class="heading">Lina Meritha</h1>
<table class="table table-bordered">
	<tr>
		<td>Nama Program</td>
		<td><?= $program->namaprogram; ?></td>
	</tr>
	<tr>
		<td>Fasilitas</td>
		<td>
			<?php
			$pecah = explode(',', $program->fasilitas);
			echo "<ul>";
			for ($i=0; $i < count($pecah); $i++) { 
				echo "<li>".$pecah[$i]."</li>";
			}
			echo "</ul>";
			?>
		</td>
	</tr>
	<tr>
		<td>Biaya Daftar</td>
		<td><?= $program->biayadaftar; ?></td>
	</tr>
	<tr>
		<td>Biaya Kursus</td>
		<td><?= $program->biayakursus; ?></td>
	</tr>
</table>