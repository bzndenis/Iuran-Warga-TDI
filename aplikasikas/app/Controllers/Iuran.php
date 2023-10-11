<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\IuranModel;
use App\Models\WargaModel;

class Iuran extends BaseController
{
    protected $IuranModel;
    public function __construct()
    {
        $this->IuranModel = new IuranModel();
    }

    public function index()
    {
        // Cari
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $this->IuranModel->search($keyword);
        } else {
            $this->IuranModel->getIuran();
        }

        $currentPage = $this->request->getVar('page_iuran') ? $this->request->getVar('page_iuran') : 1;

        $model = new IuranModel;
        $data = [
            'title' => 'Data Iuran Kas',
            'getIuran' => $model->getIuran(),
            'iuran' => $this->IuranModel->paginate(10, 'iuran'),
            'pager' => $this->IuranModel->pager,
            'currentPage' => $currentPage
        ];
        return view('Iuran/index', $data);
    }

    public function create()
    {
        $model = new WargaModel;
        $data = [
            'title' => 'Tambah Data Iuran',
            'getWarga' => $model->getWarga()
        ];
        return view('Iuran/create', $data);
    }

    public function store()
    {
        $model = new IuranModel;
        $data = array(
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal' => $this->request->getPost('tanggal'),
            'bulan' => $this->request->getPost('bulan'),
            'tahun' => $this->request->getPost('tahun'),
            'jumlah' => $this->request->getPost('jumlah'),
            'warga_id' => $this->request->getPost('warga_id')
        );
        $model->tambah_iuran($data);

        if ($model) {
            session()->setFlashdata('success', 'Tambah Data Iuran Kas Berhasil');
            return redirect()->to('Iuran');
        }
    }

    public function edit($id)
    {
        // Mengambil data iuran berdasarkan ID
        $iuranModel = new IuranModel();
        $iuran = $iuranModel->find($id);

        // Memeriksa apakah data iuran ditemukan
        if (!$iuran) {
            // Redirect atau menampilkan pesan error jika data tidak ditemukan
            return redirect()->to('Iuran'); // Gantilah 'Iuran' dengan URL yang sesuai
        }

        $model = new WargaModel();
        $data = [
            'title' => 'Edit Data Iuran',
            'iuran' => $iuran,
            // Mengirim data iuran ke view
            'getWarga' => $model->getWarga()
        ];

        return view('Iuran/edit', $data);
    }

    public function delete($id)
    {
        $model = new IuranModel;
        $model->deleteIuran($id);

        if ($model) {
            session()->setFlashdata('success', 'Data Iuran Kas berhasil dihapus');
            return redirect()->to('Iuran');
        }
    }

    public function getNamaWarga()
    {
        $model = new WargaModel(); // Ganti dengan model yang sesuai
        $data['getNamaWarga'] = $model->findAll(); // Mengambil semua data nama warga dari model

        return $this->response->setJSON($data); // Mengirimkan data dalam bentuk JSON
    }

}