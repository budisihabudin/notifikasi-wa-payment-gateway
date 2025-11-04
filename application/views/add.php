<!DOCTYPE html>
<html>
<head>
    <title>Tambah Customer</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
<div class="container mt-4">
    <h3>Tambah Customer</h3>
    <form action="<?= site_url('customer/store') ?>" method="post">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Rekening</label>
            <input type="text" name="rekening" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Bank / Pemilik Rekening</label>
            <input type="text" name="nama_bank" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Paket</label>
            <input type="text" name="nama_paket" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jumlah Tagihan</label>
            <input type="number" step="0.01" name="jumlah_tagihan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= site_url('customer') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
