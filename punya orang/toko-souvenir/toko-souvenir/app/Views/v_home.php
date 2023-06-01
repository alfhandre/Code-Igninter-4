<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
        <h2>Hallo <?= $username ?></h2>
    <br>
    <br>
        <h4>Tambah Data Barang</h4>
        <?php 
		    $validation = \Config\Services::validation(); 
		    helper('form');
	    ?>
        <form action="<?= base_url('/barang/save') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="" aria-describedby="" name="namabrg" value="<?= set_value('namabrg') ?>">
            <span class="text-danger">
                <?php 
                if($validation->getError('namabrg')) {
                    echo $validation->getError('namabrg');
                }
                ?>
            </span>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Harga</label>
                <input type="number" class="form-control" id="" aria-describedby="" name="harga" value="<?= set_value('harga') ?>">
                <span class="text-danger">
                    <?php 
                    if($validation->getError('harga')) {
                        echo $validation->getError('harga');
                    }
                    ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Diskon</label>
                <input type="number" class="form-control" id="" aria-describedby="" name="diskon" value="<?= set_value('diskon') ?>">
                <span class="text-danger">
                    <?php 
                    if($validation->getError('diskon')) {
                        echo $validation->getError('diskon');
                    }
                    ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Stok</label>
                <input type="number" class="form-control" id="" aria-describedby="" name="stok" value="<?= set_value('stok') ?>">
                <span class="text-danger">
                    <?php 
                    if($validation->getError('stok')) {
                        echo $validation->getError('stok');
                    }
                    ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar</label>
                <input class="form-control" type="file" id="formFile" name="namafile">
            </div>
        <div class="row" style="padding: 0 12px">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
</div>

<?= $this->endSection() ?>