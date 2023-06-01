<?php

namespace App\Models;

use CodeIgniter\Model;

class M_ongkir extends Model
{
    // protected $table            = 'mahasiswa';
    // protected $primaryKey       = 'NIM';

    // protected $useAutoIncrement = false;

    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;

    // protected $allowedFields    = ['NIM', 'nama', 'umur'];

    public function getAll(){
        $query = $this->db->query("SELECT * FROM ongkir");
        return $query->getResult();
    }

    public function getOne($kode_pos_tujuan){
        $query = $this->db->query("SELECT * FROM ongkir where kode_pos_tujuan = '$kode_pos_tujuan'");
        return $query->getRow();
    }
}
