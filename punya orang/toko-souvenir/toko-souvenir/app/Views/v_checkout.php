<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
  <h2>CHECKOUT</h2>
  <div class="row mt-5">
    <div class="col-md-6">
      <h5>Rincian</h5>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Nama Barang</th>
      <th scope="col">JmlJual</th>
      <th scope="col">Harga</th>
      <th scope="col">Diskon (%)</th>
      <th scope="col">Harga - Diskon</th>
      <th scope="col">Sub Total</th>
    </tr>
  </thead>
  <tbody>
    <?php if($cart) :?>
      <?php 
    $total = 0;
    foreach($cart as $item): 
    ?>   
        <tr>
        <td><?= $item['namabrg'] ?></td>
        <td><?= $item['kuantitas'] ?></td>
        <td><?= "Rp " . number_format($item['harga'],2,',','.') ?></td>
        <td><?= $item['diskon'] ?></td>
        <td><?= "Rp " . number_format($item['harga_diskon'] ,2,',','.') ?></td>
        <td><?= "Rp " . number_format($item['kuantitas'] * $item['harga_diskon'] ,2,',','.') ?></td>
        </tr>
    <?php 
    $total += $item['kuantitas'] * $item['harga_diskon'];
    endforeach; ?>
    <?php else: ?>
      <p>Tidak Ada Data Cart</p>
    <?php endif; ?>
  </tbody>
  <tfoot>
    <?php if($cart): ?>
      <tr>
          <th colspan="5" class="text-center">TOTAL</th>
          <th><?= "Rp " . number_format($total,2,',','.') ?></th>
      </tr>
    <?php endif; ?>
  </tfoot>
</table>
    </div>
    <div class="col-md-6">
      <h5>Form Isian Checkout</h5>
      <?php 
		    $validation = \Config\Services::validation(); 
		    helper('form');
	    ?>
      <form action="<?= base_url('/checkout') ?>" method="post">
      <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" class="form-control" id="" aria-describedby="" name="nama" value="<?= set_value('nama') ?>">
          <span class="text-danger">
            <?php 
              if($validation->getError('nama')) {
                echo $validation->getError('nama');
              }
            ?>
          </span>
        </div>
        <div class="mb-3">
          <label for="nama" class="form-label">No HP</label>
          <input type="text" class="form-control" id="" aria-describedby="" name="hp" value="<?= set_value('hp') ?>">
          <span class="text-danger">
            <?php 
              if($validation->getError('hp')) {
                echo $validation->getError('hp');
              }
            ?>
          </span>
        </div>
        <div class="mb-3">
          <label for="nama" class="form-label">Alamat</label>
          <input type="text" class="form-control" id="" aria-describedby="" name="alamat" value="<?= set_value('alamat') ?>">
          <span class="text-danger">
            <?php 
              if($validation->getError('alamat')) {
                echo $validation->getError('alamat');
              }
            ?>
          </span>
        </div>
        <div class="mb-3">
          <label for="nama" class="form-label">Kecamatan</label>
          <input type="text" class="form-control" id="" aria-describedby="" name="kecamatan" value="<?= set_value('kecamatan') ?>">
          <span class="text-danger">
            <?php 
              if($validation->getError('kecamatan')) {
                echo $validation->getError('kecamatan');
              }
            ?>
          </span>
        </div>
        <div class="mb-3">
          <label for="nama" class="form-label">Kota</label>
          <input type="text" class="form-control" id="" aria-describedby="" name="kota" value="<?= set_value('kota') ?>">
          <span class="text-danger">
            <?php 
              if($validation->getError('kota')) {
                echo $validation->getError('kota');
              }
            ?>
          </span>
        </div>
        <div class="row" style="padding: 0 12px">
          <button type="submit" class="btn btn-primary">Checkout</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?= $this->endSection() ?>