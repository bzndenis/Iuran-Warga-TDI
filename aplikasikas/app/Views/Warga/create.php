<!-- berikan dari template.php -->
<?= $this->extend('layout/template'); ?>

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-md-center">
        <h1 class="my-3 text-center">Formulir Data Warga</h1>
        <div class="col-8">
            <form action="<?= ('/Warga/store'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : ''; ?>" id="nik" name="nik" value="<?= old('nik') ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nik'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jkelamin" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="jkelamin" required>
                            <option selected disabled>Open this select menu</option>
                            <option value="1" <?php if (old('jkelamin') == "1") echo 'selected="selected"'; ?>>Laki-Laki</option>
                            <option value="2" <?php if (old('jkelamin') == "2") echo 'selected="selected"'; ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= old('alamat') ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="no_rumah" class="col-sm-2 col-form-label">No. Rumah</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="no_rumah" name="no_rumah" value="<?= old('no_rumah') ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="status" name="status" value="<?= old('status') ?>" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mx-3 px-4">Kirim</button>
                    <a href="<?= ('/Warga'); ?>" class="btn btn-dark mx-3 px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>