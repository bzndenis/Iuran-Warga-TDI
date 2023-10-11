<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'iuran';

    public function getLaporanTahun()
    {
        $builder = $this->db->query('(SELECT tahun, SUM(jumlah) FROM iuran GROUP BY tahun)', false);
        return $builder->getResultArray();
    }

    public function getLaporanBulan()
    {
        $builder = $this->db->query('(SELECT bulan, tahun, SUM(jumlah) as total FROM iuran GROUP BY bulan, tahun)', false);
        return $builder->getResultArray();
    }
    

    public function getListBulan()
    {
        $builder = $this->db->query('(SELECT DISTINCT bulan FROM iuran)', false);
        return $builder->getResultArray();
    }

    public function getListTahun()
    {
        $builder = $this->db->query('(SELECT DISTINCT tahun FROM iuran)', false);
        return $builder->getResultArray();
    }
}