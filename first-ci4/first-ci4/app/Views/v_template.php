<!DOCTYPE html>
<html>
<head>
	<title>Templating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .table-striped>tbody>tr:nth-child(odd)>td, 
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #e4ffe2; 
        }
    </style>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <td colspan="6" align="center">
                    <h1>HEADER</h1>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <a href="<?= base_url('/home') ?>" >Home</a>
                </td>
                <td>
                    <a href="<?= base_url('/info') ?>">Info</a>
                </td>
                <td>
                    <a href="<?= base_url('/mahasiswa') ?>">Mahasiswa</a>
                </td>
                <td>
                    <a href="<?= base_url('/pegawai') ?>">Pegawai</a>
                </td>
                <td>
                    <a href="<?= base_url('/toko') ?>">Toko</a>
                </td>
                <td>
                    <a href="<?= base_url('/logout') ?>">Logout</a>
                </td>
            </tr>
            <tr>
                <td colspan="6" align="center">
                    <?= $this->renderSection('content') ?>
                </td>
            </tr>
            <tr>
            <td colspan="6" align="center">
                <h1>FOOTER</h1>
            </td>
        </tr>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>