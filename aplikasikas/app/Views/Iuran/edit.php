<!-- Berikan dari template.php -->
<?= $this->extend('layout/template'); ?>

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-md-center">
        <h1 class="my-3 text-center">Formulir Edit Iuran Warga</h1>
        <div class="col-8">
        <form action="<?= base_url('Iuran/edit/' . $iuran['id']); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="nik" name="nik" value="<?= $iuran['nik']; ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $iuran['nama']; ?>" disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $iuran['keterangan']; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $iuran['tanggal']; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="bulan" required>
                            <option value="1" <?= ($iuran['bulan'] == 1) ? 'selected' : ''; ?>>Januari</option>
                            <option value="2" <?= ($iuran['bulan'] == 2) ? 'selected' : ''; ?>>Februari</option>
                            <!-- Lanjutkan untuk bulan-bulan lainnya -->
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="tahun" name="tahun" value="<?= $iuran['tahun']; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $iuran['jumlah']; ?>" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mx-3 px-4">Simpan Perubahan</button>
                    <a href="<?= base_url('Iuran'); ?>" class="btn btn-dark mx-3 px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
