<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mahasiswa extends Model
{
    protected $table            = 'mahasiswa';
    protected $primaryKey       = 'NIM';

    protected $useAutoIncrement = false;

    protected $returnType       = 'object';
    // protected $useSoftDeletes   = false;

    // protected $allowedFields    = ['NIM', 'nama', 'umur'];

    public function getAll(){
        $query = $this->db->query("SELECT * FROM mahasiswa");
        return $query->getResult();
    }

    public function getSearch($search){
        $query = $this->db->query("SELECT * FROM mahasiswa WHERE nama LIKE '%$search%'");
        return $query->getResult();
    }

    public function getOne($NIM){
        $query = $this->db->query("SELECT * FROM mahasiswa where NIM = '$NIM'");
        return $query->getRow();
    }

    public function saveData($data){
        $nim = $data['nim'];
        $nama = $data['nama'];
        $umur = $data['umur'];
        return $this->db->query("INSERT INTO mahasiswa VALUES ('$nim', '$nama', '$umur')");
        // return $this->db->table('mahasiswa')->insert($data);
    }
    public function updateData($data, $NIM){
        $nama = $data['nama'];
        $umur = $data['umur'];
        return $this->db->query("UPDATE mahasiswa SET nama='$nama', umur='$umur' WHERE NIM='$NIM'");
        // return $this->db->table('mahasiswa')->insert($data);
    }
}
