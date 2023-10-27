<!-- Berikan dari template.php -->
<!-- <?= $this->extend('layout/android/template'); ?> -->

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="container pt-5">

            <div class="card">
                <div class="card-header bg-dark text-white"> <!-- Mengubah warna header menjadi hitam -->
                    <h4 class="card-title">Tampilkan Laporan Bulanan</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('laporan/total_android'); ?>">
                        <div class="form-group mb-2">
                            <label for="bulan" class="text-white">Bulan</label>

                            <select name="bulan" class="form-control">
                                <?php foreach ($getListBulan as $isi) { ?>
                                    <option value=<?= $isi['bulan'] ?>>
                                        <?php
                                        $monthNum = $isi['bulan'];
                                        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
                                        echo $monthName;
                                        ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="tahun" class="text-white">Tahun</label>

                            <select name="tahun" class="form-control">
                                <?php foreach ($getListTahun as $isi) { ?>
                                    <option>
                                        <?= $isi['tahun'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                        </div>
                        <button class="btn btn-success my-3">Tampilkan</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header bg-dark text-white"> <!-- Mengubah warna header menjadi hitam -->
                    <h4 class="card-title">Jumlah Kas Perbulan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-dark text-white">
                            <!-- Mengubah warna tabel menjadi hitam dan teks menjadi putih -->
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getLaporanBulan as $isi) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $monthNum = $isi['bulan'];
                                            $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
                                            echo $monthName;
                                            ?>
                                        </td>
                                        <td>
                                            <?= $isi['tahun']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $totalJumlah = isset($isi['total']) ? $isi['total'] : 0;
                                            echo "Rp " . number_format($totalJumlah, 0, ",", ".");
                                            ?>
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
                <div class="card-header bg-dark text-white"> <!-- Mengubah warna header menjadi hitam -->
                    <h4 class="card-title">Jumlah Kas Pertahun</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-dark text-white">
                            <!-- Mengubah warna tabel menjadi hitam dan teks menjadi putih -->
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getLaporanTahun as $isi) { ?>
                                    <tr>
                                        <td>
                                            <?= $isi['tahun']; ?>
                                        </td>
                                        <td>Semua Bulan</td>
                                        <td>
                                            <?php echo "Rp " . number_format($isi['SUM(jumlah)'], 0, ",", "."); ?>
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
                <div class="card-header bg-dark text-white"> <!-- Mengubah warna header menjadi hitam -->
                    <h4 class="card-title">Detail Warga Sudah Bayar</h4>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col">
                            <div class="container">
                                <?php
                                if (!empty(session()->getFlashdata('success'))) { ?>

                                    <div class="alert alert-success">
                                        <?php echo session()->getFlashdata('success'); ?>
                                    </div>

                                <?php } ?>
                                <?php if (!empty(session()->getFlashdata('info'))) { ?>

                                    <div class="alert alert-info">
                                        <?php echo session()->getFlashdata('info'); ?>
                                    </div>

                                <?php } ?>

                                <?php if (!empty(session()->getFlashdata('warning'))) { ?>

                                    <div class="alert alert-warning">
                                        <?php echo session()->getFlashdata('warning'); ?>
                                    </div>

                                <?php } ?>
                            </div>
                            <table id="dataTable" class="cell-border compact stripe">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">No Rumah</th>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <?php
                                function angkaKeBulan($angkaBulan)
                                {
                                    $bulan = [
                                        1 => 'Januari',
                                        2 => 'Februari',
                                        3 => 'Maret',
                                        4 => 'April',
                                        5 => 'Mei',
                                        6 => 'Juni',
                                        7 => 'Juli',
                                        8 => 'Agustus',
                                        9 => 'September',
                                        10 => 'Oktober',
                                        11 => 'November',
                                        12 => 'Desember',
                                    ];

                                    return $bulan[$angkaBulan] ?? '';
                                }
                                ?>
                                <tbody>
                                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                                    <?php if ($getIuran):
                                        foreach ($getIuran as $row): ?>
                                            <tr>
                                                <th scope="row">
                                                    <?= $i++; ?>
                                                </th>
                                                <?php if (!empty($row['nama_warga'])): ?>
                                                    <td>
                                                        <?= $row['nama_warga'] ?>
                                                        <?php if (strpos($row['keterangan'], '(Transfer)') !== false): ?>
                                                            <span class="text-primary">(Transfer)</span>
                                                        <?php elseif (strpos($row['keterangan'], '(Cash)') !== false): ?>
                                                            <span style="color: orange;">(Cash)</span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php else: ?>
                                                    <td>Data tidak tersedia</td>
                                                <?php endif; ?>
                                                <?php if (!empty($row['alamat_warga'])): ?>
                                                    <td>
                                                        <?= $row['alamat_warga'] ?>
                                                    </td>
                                                <?php else: ?>
                                                    <td>Data tidak tersedia</td>
                                                <?php endif; ?>
                                                <?php if (!empty($row['no_rumah_warga'])): ?>
                                                    <td>
                                                        <?= $row['no_rumah_warga'] ?>
                                                    </td>
                                                <?php else: ?>
                                                    <td>Data tidak tersedia</td>
                                                <?php endif; ?>
                                                <td>
                                                    <?= angkaKeBulan($row['bulan']); ?>
                                                    <!-- Menampilkan Angka Bulan ke Bulan -->
                                                </td>
                                                <td>
                                                    <?= $row['tahun']; ?>
                                                </td>
                                                <td>
                                                    <?= $row['tanggal']; ?>
                                                </td>
                                                <?php if (!empty($row['keterangan'])): ?>
                                                    <td>
                                                        <?= $row['keterangan'] ?>
                                                    </td>
                                                <?php else: ?>
                                                    <td>Data tidak tersedia</td>
                                                <?php endif; ?>
                                                <td>
                                                    <?php echo "Rp " . number_format($row['jumlah'], 0, ",", "."); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    else: ?>
                                        <tr>
                                            <td colspan="8" class="text-center">Belum ada data.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="col">
        <a href="/Iuran">
            <i class="fa fa-refresh" aria-hidden="true">Refresh</i>
        </a>
    </div> -->
                    <!-- <div class=" row justify-content-md-center my-2">
        <div class="col-8">
            <?php //$pager->links('iuran', 'warga_pagination'); ?>
        </div>
    </div> -->
                </div>
            </div>
        </div>

    </div>
</div>

<br><br>
<?= $this->endSection(); ?>