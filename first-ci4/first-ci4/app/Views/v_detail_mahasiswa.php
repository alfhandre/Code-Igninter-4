<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<h2>DATA MAHASISWA</h2>

<table>
    <tr>
        <td>Nama : </td>
        <td><?= $mahasiswa->nama ?></td>
    </tr>
    <tr>
        <td>NIM : </td>
        <td><?= $mahasiswa->NIM ?></td>
    </tr>
    <tr>
        <td>Umur : </td>
        <td><?= $mahasiswa->umur ?></td>
    </tr>
    <tr>
        <td>
            <a href="<?= base_url('/mahasiswa') ?>">Kembali</a>
        </td>
    </tr>
</table>

<?= $this->endSection() ?>