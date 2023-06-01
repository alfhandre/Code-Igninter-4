<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
        <h2>TOKO SOUVENIR MOAN</h2>
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
            <?php foreach($souvenir as $sv) : ?>
                <div class="col-md-3 ">
                    <div class="card" style="width: 18rem;">
                        <img src="<?= base_url('image'). '/' . $sv->namafile ?>" class="card-img-top" alt="..." style="width: 264;height: 264px; object-fit: cover">
                        <div class="card-body">
                            <h5 class="card-title"><?= $sv->namabrg ?></h5>
                            <div class="d-flex justify-content-between">
                                <p>Stok: <?= $sv->stok ?></p>
                                <p><?= "Rp " . number_format($sv->harga - ($sv->harga * ($sv->diskon/100)),2,',','.') ?></p>   
                            </div>
                            <form action="<?= base_url('/cart') ?>" method="post">
                                <input type="hidden" name="idbrg" value="<?=$sv->idbrg?>">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
</div>

<?= $this->endSection() ?>