<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Mahasiswa</th>
                <th>Umur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mahasiswa as $mhs) : ?>
                <tr>
                    <td><?= $mhs['NIM']?></td>
                    <td><?= $mhs['Nama']?></td>
                    <td><?= $mhs['Umur']?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <a href="/mahasiswa/create">Create data</a>
</body>

</html>

<!-- /menampilkan tabel mahasiswa ke screen
    mahasiswa
    code
    view_mahasiswa_display
    function get data / get all
-->

