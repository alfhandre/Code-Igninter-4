<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
        <h2>Toko SparePart</h2>
        <form  action="<?php echo base_url('/toko')?>" action="GET">
            <div class="mb-3">
                <label for="cari">Search</label>
                <input type="text"  name="cari">
                <button type="submit"  value="Cari" class="btn btn-secondary">Submit</button>
            </div>
        </form>
        <?php if(session()->getFlashdata('msg')):?>
            <?= session()->getFlashdata('msg') ?>
        <?php endif;?>
        <div class="row gx-5 gy-5">
            <?php foreach($barang as $br) : ?>
                <div class="col-md-3 ">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= base_url('gambar'). '/' . $br->gambar ?>" class="card-img-top" alt="..." style="width: 200;height: 200px; object-fit: cover">
                        <div class="card-body">
                            <h5 class="card-title"><?= $br->nama_barang ?></h5>
                            <div class="d-flex justify-content-between">
                                <p>Stok: <?= $br->stok ?></p>
                                <p><?= "Rp " . number_format($br->harga,2,',','.') ?></p>   
                            </div>
                            <form action="<?= base_url('/cart') ?>" method="post">
                                <input type="hidden" name="kode_barang" value="<?=$br->kode_barang?>">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>

<?= $this->endSection() ?>