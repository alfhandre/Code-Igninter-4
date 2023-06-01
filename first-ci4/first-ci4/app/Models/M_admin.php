<?php

namespace App\Models;

use CodeIgniter\Model;

class M_admin extends Model
{
    // protected $table            = 'mahasiswa';
    // protected $primaryKey       = 'NIM';

    // protected $useAutoIncrement = false;

    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;

    // protected $allowedFields    = ['NIM', 'nama', 'umur'];

    public function getWhere($where){
        $username = $where['username'];
        $password = $where['password'];
        $admin  = $this->db->query("SELECT * FROM admin where username = '$username' and `password` = '$password'")->getRow();
        return $admin;
    }
}
