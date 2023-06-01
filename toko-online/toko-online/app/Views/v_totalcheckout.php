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
              <th scope="col">#</th>
              <th scope="col">Kode Barang</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Harga</th>
              <th scope="col">Kuantitas</th>
              <th scope="col">Sub Total</th>
            </tr>
          </thead>
          <tbody>
            <?php if($cart) :?>
              <?php 
            $no = 1;
            $total = 0;
            foreach($cart as $item): ?>   
                <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?= $item['kode_barang'] ?></td>
                <td><?= $item['nama_barang'] ?></td>
                <td><?= "Rp " . number_format($item['harga'],2,',','.') ?></td>
                <td><?= $item['kuantitas'] ?></td>
                <td><?= "Rp " . number_format($item['kuantitas'] * $item['harga'] ,2,',','.') ?></td>
                </tr>
            <?php 
            $total += $item['kuantitas'] * $item['harga'];
            endforeach; ?>
            <?php else: ?>
              <p>Tidak Ada Data Cart</p>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <?php if($cart): ?>
              <tr>
                  <th colspan="4" class="text-center">TOTAL</th>
                  <th colspan="2" class="text-center"><?= "Rp " . number_format($total,2,',','.') ?></th>
              </tr>
              <!-- <tr>
                  <th colspan="4" class="text-center">ONGKIR</th>
                  <th colspan="2" class="text-center"><?= "Rp " . number_format($total,2,',','.') ?></th>
              </tr>
              <tr>
                  <th colspan="4" class="text-center">TOTAL SEMUA</th>
                  <th colspan="2" class="text-center"><?= "Rp " . number_format($total,2,',','.') ?></th>
              </tr> -->
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
          <input type="text" class="form-control" id="" aria-describedby="" name="no_hp" value="<?= set_value('no_hp') ?>">
          <span class="text-danger">
            <?php 
              if($validation->getError('no_hp')) {
                echo $validation->getError('no_hp');
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
          <label for="nama" class="form-label">Kode Pos</label>
          <input type="text" class="form-control" id="" aria-describedby="" name="kode_pos" value="<?= set_value('kode_pos') ?>">
          <span class="text-danger">
            <?php 
              if($validation->getError('kode_pos')) {
                echo $validation->getError('kode_pos');
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