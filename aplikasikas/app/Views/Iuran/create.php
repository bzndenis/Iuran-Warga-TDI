<!-- berikan dari template.php -->
<?= $this->extend('layout/template'); ?>

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-md-center">
        <h1 class="my-3 text-center">Formulir Data Iuran Kas</h1>
        <div class="col-8">
            <form action="<?= base_url();?>/Iuran/store" method="post">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="warga_id" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input list="warga_list" name="warga_id" class="form-control" id="nama" required>
                        <datalist id="warga_list">
                            <<?php foreach ($getWarga as $row) {
                                echo "<option value=" . $row['id'] . ">" . $row['nama'] . "</option>";
                            }
                            ?>
                        </datalist>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="Pembayaran Iuran Warga" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="<?= date('Y-m-d'); ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="bulan" class="col-sm-2 col-form-label">Bulan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="bulan" name="bulan" value="<?= date('n'); ?>"
                            required>
                    </div>
                </div>
                <div class="row mb-3" style="display: none;">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tahun" name="tahun" value="<?= date('Y'); ?>"
                            required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jumlah" name="jumlah" value="75000" readonly>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mx-3 px-4">Kirim</button>
                    <a href="<?= base_url();?>/Iuran" class="btn btn-dark mx-3 px-4">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Inisialisasi select2 untuk input "Nama"
        $('#nama').select2({
            placeholder: 'Pilih Nama',
            ajax: {
                url: 'localhost:8080/Iuran/getnamawarga', // Pastikan URL ini sesuai dengan rute yang benar
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data.getNamaWarga, function (item) {
                            return {
                                text: item.nama,
                                id: item.nama
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>

<?= $this->endSection(); ?>