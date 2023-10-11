<!-- Berikan dari template.php -->
<?= $this->extend('layout/android/template'); ?>

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="container pt-5">
            <a href="<?= base_url('Laporan/android'); ?>" class="btn btn-secondary mb-2">Kembali</a>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title">Jumlah Kas Perbulan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="dataTable" class="cell-border compact stripe">
                            <thead>
                                <tr>

                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($total as $isi) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $monthNum = $isi['bulan'];
                                            $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
                                            echo $monthName;
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $isi['tahun']; ?>
                                        </td>
                                        <td>
                                            <?php echo "Rp " . number_format($isi['sum(jumlah)'], 0, ",", "."); ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="card-title">Data Warga Belum Bayar</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-hover display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Rumah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($belumbayar as $isi) { ?>
                                    <tr>
                                        <td>
                                            <?= $no; ?>
                                        </td>
                                        <td>
                                            <?= $isi['nama']; ?>
                                        </td>
                                        <td>
                                            <?= $isi['alamat']; ?>
                                        </td>
                                        <td>
                                            <?= $isi['no_rumah']; ?>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>            
            <br>

            

            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="card-title">Data Warga Sudah Bayar</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example" class="table table-hover display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Rumah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($sudahbayar as $isi) { ?>
                                    <tr>
                                        <td>
                                            <?= $no; ?>
                                        </td>
                                        <td>
                                            <?= $isi['nama']; ?>
                                        </td>
                                        <td>
                                            <?= $isi['alamat']; ?>
                                        </td>
                                        <td>
                                            <?= $isi['no_rumah']; ?>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>