<!-- Berikan dari template.php -->
<?= $this->extend('layout/template'); ?>

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="my-2 text-center">
            <h1>Iuran Kas Warga</h1>
            <hr>
        </div>
        <div class="col-8 text-start">
            <a href="<?= base_url(); ?>/Iuran/create" class="btn btn-primary my-3">Tambah Iuran</a>
        </div>
        <!-- Search -->
        <!-- <div class="col-4 text-start">
            <form>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Cari Nama Warga" name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit" name="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div> -->
    </div>
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
                                    <?= angkaKeBulan($row['bulan']); ?> <!-- Menggunakan fungsi pemetaan -->
                                </td>
                                <td>
                                    <?= $row['tahun']; ?>
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
<?= $this->endSection(); ?>