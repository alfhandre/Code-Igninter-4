<!DOCTYPE html>
<html>
<head>
	<title>CRUD PHP</title>
</head>
<body>
 
	<h2>CRUD DATA PEGAWAI</h2>
	<br/>
	<a href="<?= base_url('/pegawai') ?>">KEMBALI</a>
	<br/>
	<br/>
	<h3>TAMBAH DATA PEGAWAI</h3>
	<?php 
		$validation = \Config\Services::validation(); 
		helper('form');
	?>
	<form method="post" action="<?= base_url('/pegawai/save') ?>">
		<table>
			<tr>			
				<td>Nama: </td>
				<td><input type="text" name="nama" value="<?= set_value('nama') ?>" ></td>
			</tr>
			<tr>
				<td colspan="2" style="color:red">
					<?php 
						if($validation->getError('nama')) {
							echo $validation->getError('nama');
						}
					?>
				<br>
				<br>
				</td>
			</tr>
			<tr>
				<td>NIM: </td>
				<td><input type="number" name="NIM" value="<?= set_value('NIM') ?>"></td>
			</tr>
			<tr>
				<td colspan="2" style="color:red">
					<?php 
						if($validation->getError('NIM')) {
							echo $validation->getError('NIM');
						}
					?>
				<br>
				<br>
				</td>
			</tr>
			<tr>
				<td>Email: </td>
				<td><input type="email" name="email" value="<?= set_value('email') ?>"></td>
			</tr>
			<tr>
				<td colspan="2" style="color:red">
					<?php 
						if($validation->getError('email')) {
							echo $validation->getError('email');
						}
					?>
				<br>
				<br>
				</td>
			</tr>
			<tr>
				<td>No Telepon: </td>
				<td><input type="number" name="telepon" value="<?= set_value('telepon') ?>"></td>
			</tr>
			<tr>
				<td colspan="2" style="color:red">
					<?php 
						if($validation->getError('telepon')) {
							echo $validation->getError('telepon');
						}
					?>
				<br>
				<br>
				</td>
			</tr>
			<tr>
				<td>Gender: </td>
				<td>
					<input type="radio" name="gender" value="Pria" <?php if(set_value('gender')=='Pria'){ ?>  checked <?php  } ?>>
					<label for="">Pria</label>
					<input type="radio" name="gender" value="Wanita" <?php if(set_value('gender')=='Wanita'){ ?>  checked <?php  } ?>>
					<label for="">Wanita</label>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="color:red">
					<?php 
						if($validation->getError('gender')) {
							echo $validation->getError('gender');
						}
					?>
				<br>
				<br>
				</td>
			</tr>
			<tr>
				<td>Pendidikan: </td>
				<td>
					<select name="pendidikan" id="pendidikan">
						<option disabled <?php if(!set_value('pendidikan')){ ?>  selected <?php  } ?>>-- Pilih Pendidikan --</option>
						<option value="SD" <?php if(set_value('pendidikan')=='SD'){ ?>  selected <?php  } ?> >SD</option>
						<option value="SMP" <?php if(set_value('pendidikan')=='SMP'){ ?>  selected <?php  } ?>>SMP</option>
						<option value="SMA" <?php if(set_value('pendidikan')=='SMA'){ ?>  selected <?php  } ?>>SMA</option>
					</select>		
				</td>
			</tr>
			<tr>
				<td colspan="2" style="color:red">
					<?php 
						if($validation->getError('pendidikan')) {
							echo $validation->getError('pendidikan');
						}
					?>
				<br>
				<br>
				</td>
			</tr>	
			<tr>
				<td></td>
				<td><input type="submit" value="SIMPAN"></td>
			</tr>		
		</table>
	</form>
</body>
</html>