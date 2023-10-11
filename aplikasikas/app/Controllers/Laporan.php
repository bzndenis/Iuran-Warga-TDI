<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LaporanModel;
use App\Models\IuranModel;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->IuranModel = new IuranModel();
    }
    public function index()
    {
        $modelLaporan = new LaporanModel;
        $modelIuran = new IuranModel;

        $data['title'] = 'Laporan Iuran';
        $data['getLaporanTahun'] = $modelLaporan->getLaporanTahun();
        $data['getLaporanBulan'] = $modelLaporan->getLaporanBulan();
        $data['getListBulan'] = $modelLaporan->getListBulan();
        $data['getListTahun'] = $modelLaporan->getListTahun();


        $currentPage = $this->request->getVar('page_iuran') ? $this->request->getVar('page_iuran') : 1;
        $dataIuran = [
            'getIuran' => $this->IuranModel->getIuran(),
            'currentPage' => $currentPage
            
        ];

        echo view('Laporan/index', $data + $dataIuran); // Menggabungkan kedua array data
    }

    public function android()
    {
        $modelLaporan = new LaporanModel;
        $modelIuran = new IuranModel;

        $data['title'] = 'Laporan Iuran';
        $data['getLaporanTahun'] = $modelLaporan->getLaporanTahun();
        $data['getLaporanBulan'] = $modelLaporan->getLaporanBulan();
        $data['getListBulan'] = $modelLaporan->getListBulan();
        $data['getListTahun'] = $modelLaporan->getListTahun();


        $currentPage = $this->request->getVar('page_iuran') ? $this->request->getVar('page_iuran') : 1;
        $dataIuran = [
            'getIuran' => $this->IuranModel->getIuran(),
            'currentPage' => $currentPage
            
        ];

        echo view('Laporan/android', $data + $dataIuran); // Menggabungkan kedua array data
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

    public function total_android()
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

        echo view('Laporan/detail_android', $data);
    }

}