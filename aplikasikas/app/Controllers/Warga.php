<?php

namespace App\Controllers;

use App\Models\WargaModel;
use CodeIgniter\HTTP\Request;

class Warga extends BaseController
{
    protected $WargaModel;
    public function __construct()
    {
        $this->WargaModel = new WargaModel();
    }

    public function index()
    {
        // Cari
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $this->WargaModel->search($keyword);
        } else {
            $this->WargaModel->getWarga();
        }

        $currentPage = $this->request->getVar('page_warga') ? $this->request->getVar('page_warga') : 1;
        $data = [
            'title' => 'Data Warga',
            //'warga' => $this->WargaModel->getWarga()
            'warga' => $this->WargaModel->paginate(10, 'warga'),
            'pager' => $this->WargaModel->pager,
            'currentPage' => $currentPage
        ];
        return view('Warga/index', $data);
    }

    public function detail($slug)
    {
        $model = new WargaModel();
        $warga = $model->where([
            'slug' => $slug
        ])->first();
        // Menampilkan error apabila data tidak ada.
        if (!$warga) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Nama ' . $slug . ' tidak ditemukan.');
        }
        $title = $warga['nama'];
        return view('Warga/detail', compact('warga', 'title'));
    }

    public function delete($id)
    {
        $hapus = $this->WargaModel->hapus_warga($id);

        if ($hapus) {
            session()->setFlashdata('warning', 'Hapus Data Warga Berhasil');
            return redirect()->to('/Warga');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah data Warga',
            'validation' => \Config\Services::validation()
        ];
        return view('Warga/create', $data);
    }

    public function store()
    {
        //validasi nik
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|is_unique[warga.nik]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah tersedia'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('Warga/create')->withInput()->with('validation', $validation);
        }

        $nik = $this->request->getPost('nik');
        $nama = $this->request->getPost('nama');
        $jkelamin = $this->request->getPost('jkelamin');
        $alamat = $this->request->getPost('alamat');
        $no_rumah = $this->request->getPost('no_rumah');
        $slug = url_title($this->request->getPost('nama'));


        $data = [
            'nik' => $nik,
            'nama' => $nama,
            'jkelamin' => $jkelamin,
            'alamat' => $alamat,
            'no_rumah' => $no_rumah,
            'slug' => $slug
        ];

        $simpan = $this->WargaModel->tambah_warga($data);

        if ($simpan) {
            session()->setFlashdata('success', 'Tambah Data Warga Berhasil');

            return redirect()->to('Warga');
        }
    }

    public function edit($id)
    {
        // ambil data lama
        $data = [
            'title' => 'Edit Warga',
            'warga' => $this->WargaModel->getWarga($id)
        ];
        return view('Warga/edit', $data);
    }

    public function update($id)
    {

        $nik = $this->request->getPost('nik');
        $nama = $this->request->getPost('nama');
        $jkelamin = $this->request->getPost('jkelamin');
        $alamat = $this->request->getPost('alamat');
        $no_rumah = $this->request->getPost('no_rumah');
        $status = $this->request->getPost('status');
        $slug = url_title($this->request->getPost('nama'));


        $data = [
            'nik' => $nik,
            'nama' => $nama,
            'jkelamin' => $jkelamin,
            'alamat' => $alamat,
            'no_rumah' => $no_rumah,
            'status' => $status,
            'slug' => $slug
        ];

        $ubah = $this->WargaModel->ubah_warga($data, $id);

        if ($ubah) {
            session()->setFlashdata('info', 'Ubah Data Warga Berhasil');
            return redirect()->to('/Warga');
        }
    }
    //--------------------------------------------------------------------
}
