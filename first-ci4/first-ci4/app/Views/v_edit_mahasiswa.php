<!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP</title>
</head>
<body>
 
	<h2>CRUD DATA MAHASISWA</h2>
	<br/>
	<a href="<?= base_url('/mahasiswa') ?>">KEMBALI</a>
	<br/>
	<br/>
	<h3>EDIT DATA MAHASISWA dengan NIM : <?= $mahasiswa->NIM ?></h3>
	<form method="post" action="<?= base_url('/mahasiswa').'/'. $mahasiswa->NIM . '/update' ?>">
		<table>
			<tr>			
				<td>Nama</td>
				<td><input type="text" name="nama" value="<?= $mahasiswa->nama ?>"></td>
			</tr>
			<!-- <tr>
				<td>NIM</td>
				<td><input type="number" name="NIM" value="<?= $mahasiswa->NIM ?>"></td>
			</tr> -->
			<tr>
				<td>Umur</td>
				<td><input type="text" name="umur" value="<?= $mahasiswa->umur ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>		
		</table>
	</form>
</body>
</html>