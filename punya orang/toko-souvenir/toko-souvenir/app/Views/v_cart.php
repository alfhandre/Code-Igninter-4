<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container my-5">
        <h2>CART</h2>
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
    <form action="<?= base_url('/cart')?>" method="post">
            <input type="hidden" name="_method" value="delete">
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
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
</div>

<?= $this->endSection() ?>