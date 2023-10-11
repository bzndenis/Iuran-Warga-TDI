<?php

namespace App\Models;

use CodeIgniter\Model;

class WargaModel extends Model
{
    protected $table = 'warga';

    public function getWarga($id = false)
    {
        if ($id === false) {
            return $this->table('warga')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('warga')
                ->where('id', $id)
                ->get()
                ->getRowArray();
        }
    }

    public function hapus_warga($id)
    {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }

    public function tambah_warga($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function ubah_warga($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }

    public function search($keyword)
    {
        return $this->table('warga')->like('nama', $keyword);
    }
}
