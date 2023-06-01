<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container">
        <h2>CRUD DATA MAHASISWA</h2>
        <a href="<?= base_url('/mahasiswa/create') ?>" class="btn btn-success mb-2">Tambah Data</a>
        <a href="<?= base_url('/mahasiswa/convert/pdf') ?>" class="btn btn-success mb-2">PDF</a>
        <form  action="<?php echo base_url('/mahasiswa')?>" action="GET">
            <div class="mb-3">
                <label for="cari">Search</label>
                <input type="text"  name="cari">
                <button type="submit"  value="Cari" class="btn btn-secondary">Submit</button>
            </div>
        </form>
        <?php if(session()->getFlashdata('msg')):?>
            <?= session()->getFlashdata('msg') ?>
        <?php endif;?>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($mahasiswa as $mhs){ ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $mhs->NIM ?></td>
                        <td><?= $mhs->nama ?></td>
                        <td><?= $mhs->umur ?></td>
                        <td>
                            <a href="<?= base_url('/mahasiswa/detail') . '/' . $mhs->NIM ?>" class="btn btn-primary">Detail</a>
                            <a href="<?= base_url('/mahasiswa') . '/' . $mhs->NIM. '/edit' ?>" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?= $pager->links('mahasiswa', 'template') ?>
      </div>
    </div>
</div>

<?= $this->endSection() ?>