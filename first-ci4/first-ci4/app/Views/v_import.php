<?= $this->extend('v_template') ?>

<?= $this->section('content') ?>

<div class="container">
        <h2>IMPORT DATA MAHASISWA</h2>
        <form method="post" action="<?= base_url('/mahasiswa/import/simpan') ?>" enctype="multipart/form-data">
			<div class="form-group">
				<label>File Excel</label>
				<input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Upload</button>
			</div>
		</form>
</div>

<?= $this->endSection() ?>