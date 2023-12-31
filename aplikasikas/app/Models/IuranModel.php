<?php

namespace App\Models;

use CodeIgniter\Model;

class IuranModel extends Model
{
    protected $table = 'iuran';
    protected $primaryKey = 'id';

    public function getIuran($id = false)
    {
        $query = $this->table('iuran')
            ->select('iuran.*,             
            warga.nama as nama_warga, 
            warga.nik as nik_warga, 
            warga.alamat as alamat_warga, 
            warga.no_rumah as no_rumah_warga, 
            iuran.keterangan as keterangan,
            iuran.tanggal as tanggal
            ')
            ->join('warga', 'warga.id = iuran.warga_id');

        if ($id === false) {
            return $query->get()->getResultArray();
        } else {
            return $query->where('iuran.id', $id)->get()->getRowArray();
        }
    }

    public function tambah_iuran($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function ubah_iuran($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }

    public function search($keyword)
    {
        return $this->table('iuran')
            ->select('iuran.*, warga.nama as nama_warga, warga.nik as nik_warga')
            ->join('warga', 'warga.id = iuran.warga_id')
            ->like('warga.nama', $keyword) // Menambahkan kondisi pencarian berdasarkan nama warga
            ->orLike('warga.nik', $keyword) // Menambahkan kondisi pencarian berdasarkan NIK warga
            ->get()
            ->getResultArray();
    }

    public function isAlreadyPaid($warga_id, $bulan, $tahun)
    {
        $builder = $this->db->table('iuran');
        $builder->where('warga_id', $warga_id);
        $builder->where('bulan', $bulan);
        $builder->where('tahun', $tahun);

        return $builder->countAllResults() > 0;
    }
}