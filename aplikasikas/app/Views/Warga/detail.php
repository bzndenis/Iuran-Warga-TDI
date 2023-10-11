<!-- Berikan dari template.php -->
<?= $this->extend('layout/template'); ?>

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-md-center">
        <h1 class="my-3 text-center">Data Warga</h1>
        <div class="col-8">
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true">Data Warga</li>
                <li class="list-group-item">Nama Lengkap: <?= $warga['nama']; ?></li>
                <li class="list-group-item">NIK: <?= $warga['nik']; ?></li>
                <li class="list-group-item">Jenis Kelamin: <?= $warga['jkelamin']; ?>
                </li>
                <li class="list-group-item">Alamat: <?= $warga['alamat']; ?></li>
                <li class="list-group-item">Nomor Rumah: <?= $warga['no_rumah']; ?></li>
            </ul>
        </div>
        <div class="col-8 my-3">
            <a href="<?= ('/Warga'); ?>" class="btn btn-dark">Kembali</a>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>