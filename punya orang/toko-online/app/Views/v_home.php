<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
       <h2>Welcome <?= $username ?></h2>
       <br>
       <br>
       <h4>Tambah Data Sparepart</h4>
       <?php
       $validation = \Config\Services::validation();
       helper('form');
       ?>
       <form action="<?= base_url('/barang/save') ?>" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                     <label for="nama" class="form-label">Nama Sparepart</label>
                     <input type="text" class="form-control" id="" aria-describedby="" name="nama_barang" value="<?= set_value('nama_barang') ?>">
                     <span class="text-danger">
                            <?php
                            if ($validation->getError('nama_barang')) {
                                   echo $validation->getError('nama_barang');
                            }
                            ?>
                     </span>
              </div>
              <div class="mb-3">
                     <label for="nama" class="form-label">Stok Sparepart</label>
                     <input type="number" class="form-control" id="" aria-describedby="" name="stok" value="<?= set_value("stok") ?>">
                     <span class="text-danger">
                            <?php
                            if ($validation->getError('stok')) {
                                   echo $validation->getError('stok');
                            }
                            ?>
                     </span>
              </div>
              <div class="mb-3">
                     <label for="nama" class="form-label">Harga Sparepart</label>
                     <input type="number" class="form-control" id="" aria-describedby="" name="harga" value="<?= set_value("harga") ?>">
                     <span class="text-danger">
                            <?php
                            if ($validation->getError('harga')) {
                                   echo $validation->getError('harga');
                            }
                            ?>
                     </span>
              </div>
              <div class="mb-3">
                     <label for="formFile" class="form-label">Gambar</label>
                     <input class="form-control" type="file" id="formFile" name="namafile">
              </div>
              <div class="mb-3">
                     <label for="nama" class="form-label">Berat</label>
                     <input type="berat" class="form-control" id="" aria-describedby="" name="berat" value="<?= set_value("berat") ?>">
                     <span class="text-danger">
                            <?php
                            if ($validation->getError('berat')) {
                                   echo $validation->getError('berat');
                            }
                            ?>
                     </span>
              </div>
              <div class="row" style="padding: 0 12px">
                     <button type="submit" class="btn btn-primary">Save</button>
              </div>
       </form>
</div>


<?= $this->endSection() ?>