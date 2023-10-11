<!-- Berikan dari template.php -->
<?= $this->extend('layout/template'); ?>

<!-- Jadikan bagian konten -->
<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="row">
        <div class="my-2 text-center">
            <h1 class="text-white">Data Warga</h1>
            <hr class="bg-white">
        </div>
        <div class="col-8 text-start">
            <a href="<?= ('Warga/create'); ?>" class="btn btn-primary my-3">Tambah Data</a>
        </div>
        <!-- Search -->
        <div class="col-4 text-start">
            <form>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control bg-dark text-white" placeholder="Cari Nama Warga"
                        name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit" name="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="container">
                <?php
                if (!empty(session()->getFlashdata('success'))) { ?>

                    <div class="alert alert-success bg-dark text-white">
                        <?php echo session()->getFlashdata('success'); ?>
                    </div>

                <?php } ?>
                <?php if (!empty(session()->getFlashdata('info'))) { ?>

                    <div class="alert alert-info bg-dark text-white">
                        <?php echo session()->getFlashdata('info'); ?>
                    </div>

                <?php } ?>

                <?php if (!empty(session()->getFlashdata('warning'))) { ?>

                    <div class="alert alert-warning bg-dark text-white">
                        <?php echo session()->getFlashdata('warning'); ?>
                    </div>

                <?php } ?>
            </div>
            <table class="table table-hover table-dark text-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No.Rumah</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                    <?php if ($warga):
                        foreach ($warga as $row): ?>
                            <tr>
                                <th scope="row">
                                    <?= $i++; ?>
                                </th>
                                <td>
                                    <?= $row['nama']; ?>
                                </td>
                                <td>
                                    <?= $row['nik']; ?>
                                </td>
                                <td>
                                    <?= $row['jkelamin']; ?>
                                </td>
                                <td>
                                    <?= $row['alamat']; ?>
                                </td>
                                <td>
                                    <?= $row['no_rumah']; ?>
                                </td>
                                <td>
                                    <a class="btn btn-warning p-1 btn-sm"
                                        href="<?= base_url(); ?>/Warga/detail/<?= $row['slug']; ?>">Aktif</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm m-1"
                                        href="<?= base_url('/Warga/edit/' . $row['id']); ?>"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-danger btn-sm m-1" href="<?= base_url('/Warga/delete/' . $row['id']); ?>"
                                        onclick="return confirm('Yakin menghapus data <?= $row['nama']; ?>?');"><i
                                            class="fa-solid fa-trash"></i></a>
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
    <div class="col">
        <a href="Warga" class="text-white">
            <i class="fa fa-refresh" aria-hidden="true">Refresh</i>
        </a>
    </div>
    <div class=" row justify-content-md-center my-2">
        <div class="col-8">
            <?= $pager->links('warga', 'warga_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>