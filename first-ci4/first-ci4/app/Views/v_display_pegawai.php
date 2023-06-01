<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<h2>CRUD DATA PEGAWAI</h2>
    <a href="<?= base_url('/pegawai/create') ?>">Tambah Data</a>
    <br>
    <br>
    <form  action="<?php echo base_url('pegawai')?>" action="GET">
          <div class="mb-3">
            <label for="cari">Search</label>
            <input type="text"  name="cari">
            <button type="submit"  value="Cari">Submit</button>
          </div>
    </form>
    <br>
    <br>
    <?php if(session()->getFlashdata('msg')):?>
        <?= session()->getFlashdata('msg') ?>
    <?php endif;?>
	<table border="1">
		<tr>
			<th>NO</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Pendidikan</th>
			<th>No.Telepon</th>
			<!-- <th>Action</th> -->
		</tr>
        <?php 
        $no = 1;
        foreach($pegawai as $pgw){ ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $pgw->NIM ?></td>
                <td><?= $pgw->nama ?></td>
                <td><?= $pgw->gender ?></td>
                <td><?= $pgw->email ?></td>
                <td><?= $pgw->pendidikan ?></td>
                <td><?= $pgw->telepon ?></td>
            </tr>
        <?php } ?>
	</table>

<?= $this->endSection() ?>