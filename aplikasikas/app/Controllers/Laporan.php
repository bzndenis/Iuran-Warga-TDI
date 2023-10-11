<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LaporanModel;

class Laporan extends BaseController
{
    public function index()
    {
        $model = new LaporanModel;
        $data['title'] = 'Laporan Iuran';
        $data['getLaporanTahun'] = $model->getLaporanTahun();
        $data['getLaporanBulan'] = $model->getLaporanBulan(); // Pastikan metode ini mengembalikan data yang diperlukan


        $data['getListBulan'] = $model->getListBulan();
        $data['getListTahun'] = $model->getListTahun();

        echo view('Laporan/index', $data);
    }

    public function total()
    {
        $model = new LaporanModel;
        $data['title'] = 'Laporan Iuran Bulan dan Tahun';
        $db = \Config\Database::connect();
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        // Builder 1: Menghitung total jumlah iuran
        $builder1 = $db->query("(SELECT sum(jumlah),bulan,tahun FROM iuran WHERE bulan='$bulan' and tahun='$tahun')", false);
        $data['total'] = $builder1->getResultArray();

        // Builder 2: Mengambil nama warga yang belum membayar
        $builder2 = $db->query("
            SELECT warga.nama, warga.no_rumah, warga.alamat
            FROM warga
            WHERE NOT EXISTS (
                SELECT warga_id FROM iuran WHERE warga.id = iuran.warga_id AND bulan = '$bulan' AND tahun = '$tahun'
            )
        ", false);
        $data['belumbayar'] = $builder2->getResultArray();

        // Builder 3: Mengambil nama warga yang sudah membayar dan no_rumah
        $builder3 = $db->query("
            SELECT warga.nama, warga.no_rumah, warga.alamat
            FROM warga
            INNER JOIN iuran ON warga.id = iuran.warga_id
            WHERE iuran.bulan = '$bulan' AND iuran.tahun = '$tahun'
        ", false);
        $data['sudahbayar'] = $builder3->getResultArray();

        echo view('Laporan/detail', $data);
    }

}