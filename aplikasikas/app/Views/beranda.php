<!-- Berikan dari template.php -->
<?= $this->extend('layout/template'); ?>

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5 pt-3">
    <h1>Dashboard</h1>
    <div class="row">
        <!-- Tambah Data -->
        <div class="col-md-4">
            <div class="card text-bg-primary m-3">
                <a href="<?= base_url();?>/Warga/create" class="text-light text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title text-center py-4 text-white">Tambah Data</h5>
                    </div>
                </a>
            </div>
        </div>

        <!-- Tambah Iuran -->
        <div class="col-md-4">
            <div class="card text-bg-success m-3">
                <a href="<?= base_url();?>/iuran/create" class="text-light text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title text-center py-4 text-white">Tambah Iuran</h5>
                    </div>
                </a>
            </div>
        </div>

        <!-- Laporan Kas -->
        <div class="col-md-4">
            <div class="card text-bg-warning m-3">
                <a href="<?= base_url();?>/laporan" class="text-light text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title text-center py-4 text-white">Total Kas Tahunan</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
