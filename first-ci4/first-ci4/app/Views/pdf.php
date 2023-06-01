<html>
	<head>
		<style>
			table {
			  font-family: arial, sans-serif;
			  border-collapse: collapse;
			  width: 100%;
			}

			td, th {
			  border: 1px solid #000000;
			  text-align: center;
			  height: 20px;
			  margin: 8px;
			}

		</style>
	</head>
	<body>
        <br>
        <br>
        <h2>Data Mahasiswa</h2>
		<table cellpadding="6" >
			<tr>
				<th><strong>No</strong></th>
				<th><strong>NIM</strong></th>
				<th><strong>Nama</strong></th>
				<th><strong>Umur</strong></th>
			</tr>
			<?php 
                $no = 1;
                foreach($mahasiswa as $mhs){ ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $mhs->NIM ?></td>
                        <td><?= $mhs->Nama ?></td>
                        <td><?= $mhs->Umur ?></td>
                    </tr>
                <?php } ?>
		</table>
	</body>
</html>