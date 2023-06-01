<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
        <h2>CART</h2>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kode Barang</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Harga</th>
      <th scope="col">Kuantitas</th>
      <th scope="col">Sub Total</th>
      <th>Action</th>
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
        <td>
          <form action="<?= base_url('/cart'). '/' . $no - 1 ?>" method="post">
            <input type="hidden" name="_method" value="delete">
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </td>
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
          <th colspan="5" class="text-center">TOTAL</th>
          <th><?= "Rp " . number_format($total,2,',','.') ?></th>
      </tr>
    <?php endif; ?>
  </tfoot>
</table>
<a href="<?= base_url('/checkout') ?>" class="btn btn-primary">Checkout</a>
<a href="<?= base_url('/destroy') ?>" class="btn btn-primary">Clear</a>
</div>

<?= $this->endSection() ?>