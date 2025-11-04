<!DOCTYPE html>
<html>
<head>
    <title>Data Customer</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <style>
        body {
            background-color: #e9ecef; /* Abu-abu terang untuk latar belakang */
            padding-bottom: 50px; /* Ruang di bawah */
        }
        .card {
            border-radius: 12px; /* Sudut lebih membulat */
            border: none;
        }
        .card-header {
            background-color: #0d6efd; 
            color: #fff;
            font-weight: 600; 
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 1rem 1.5rem;
            font-size: 1.25rem;
        }
        .table th, .table td {
            vertical-align: middle;
            padding: 0.75rem; 
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05); 
        }
        .table-hover tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.1) !important; 
        }
        .thead-light th {
            color: #495057;
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }
        /* Style tambahan agar tombol aksi berdekatan dan rapi */
        .action-btns .btn {
            margin: 2px; /* Jarak antar tombol */
            white-space: nowrap; /* Mencegah tombol putus baris */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">Daftar Data Customer</h2>
    <div class="card shadow-lg"> 
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Manajemen Customer</span>
            <a href="<?= site_url('customer/add') ?>" class="btn btn-light btn-sm fw-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add me-1" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5a.5.5 0 0 1 .5.5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 .5-.5ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                    <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.021.74.053.226.386.495.744.82 1.03A6.16 6.16 0 0 0 8 14Zm-2 0a.25.25 0 0 1-.25-.25 4.5 4.5 0 0 0-.08-.713c.092.355.207.69.346 1.004Z"/>
                </svg>
                Tambah Customer
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Rekening</th>
                            <th>Nama Bank</th>
                            <th>Nama Paket</th>
                            <th class="text-end">Jumlah Tagihan</th> 
                            <th class="text-center">Status Pembayaran</th>
                            <th class="text-center" style="min-width: 250px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customers as $c): 
                            // Persiapan data untuk notifikasi WA
                            $tagihan_rp = number_format($c->jumlah_tagihan, 0, ',', '.');
                            $pesan_wa = urlencode("Yth. Bapak/Ibu {$c->nama},\n\nTagihan layanan internet {$c->paket_layanan} untuk bulan ini sebesar Rp. {$tagihan_rp} telah jatuh tempo. Mohon segera melakukan pembayaran. \n\nTerima kasih.");
                            
                            // Menghilangkan karakter non-angka dari telepon untuk format WA
                            $telepon_wa = preg_replace('/[^0-9]/', '', $c->telepon);
                            
                            // Ganti awalan '0' menjadi '62'
                            if (substr($telepon_wa, 0, 1) == '0') {
                                $telepon_wa = '62' . substr($telepon_wa, 1);
                            }
                        ?>
                        <tr>
                            <td><?= $c->id_customer ?></td>
                            <td><?= $c->nama ?></td>
                            <td><?= $c->telepon ?></td>
                            <td><?= $c->rekening_pelanggan ?></td> 
                            <td><?= $c->bank_pelanggan ?></td>
                            <td><span class="badge bg-info text-dark"><?= $c->paket_layanan ?></span></td>
                            <td class="text-end"> 
                                <span class="badge bg-success py-2 px-3 fs-6">
                                    Rp. <?= $tagihan_rp ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if ($c->status_pembayaran == 'sudah_bayar'): ?>
                                    <span class="badge bg-success">Sudah Bayar</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Belum Bayar</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center action-btns"> 
                                
                                <a href="https://wa.me/<?= $telepon_wa ?>?text=<?= $pesan_wa ?>" target="_blank" class="btn **btn-success** **btn-sm**" title="Kirim Notifikasi Tagihan via WhatsApp">
                                    <small>Notif WA</small>
                                </a>

                                <?php if ($c->status_pembayaran != 'sudah_bayar'): ?>
                                    <a href="<?= site_url('customer/pay/'.$c->id_customer) ?>" class="btn **btn-primary** **btn-sm**" title="Tandai sebagai Sudah Bayar" onclick="return confirm('Tandai pembayaran #<?= $c->id_customer ?> telah lunas?')">
                                        <small>Bayar Otomatis</small>
                                    </a>
                                <?php endif; ?>

                                <a href="<?= site_url('customer/edit/'.$c->id_customer) ?>" class="btn **btn-warning** **btn-sm**" title="Edit Data">
                                    <small>Edit</small>
                                </a>
                                
                                <a href="<?= site_url('customer/delete/'.$c->id_customer) ?>" class="btn **btn-danger** **btn-sm**" title="Hapus Data Customer" onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini? Tindakan ini tidak dapat dibatalkan.')">
                                    <small>Hapus</small>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if (empty($customers)): ?>
                <div class="alert alert-warning text-center mt-3" role="alert">
                    Belum ada data customer yang tersedia. Silakan tambahkan data baru.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>