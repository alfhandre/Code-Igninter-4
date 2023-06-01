<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pegawai extends Model
{
    // protected $table            = 'mahasiswa';
    // protected $primaryKey       = 'NIM';

    // protected $useAutoIncrement = false;

    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;

    // protected $allowedFields    = ['NIM', 'nama', 'umur'];

    public function getAll(){
        $query = $this->db->query("SELECT * FROM pegawai");
        return $query->getResult();
    }

    public function getSearch($search){
        $query = $this->db->query("SELECT * FROM pegawai WHERE nama LIKE '%$search%'");
        return $query->getResult();
    }

    public function getOne($NIM){
        $query = $this->db->query("SELECT * FROM pegawai where NIM = '$NIM'");
        return $query->getRow();
    }

    public function saveData($data){
        $NIM = $data['NIM'];
        $nama = $data['nama'];
        $gender = $data['gender'];
        $email = $data['email'];
        $telepon = $data['telepon'];
        $pendidikan = $data['pendidikan'];
        return $this->db->query("INSERT INTO pegawai VALUES ('$NIM', '$nama', '$gender', '$email', '$pendidikan', '$telepon')");
    }
    public function updateData($data, $NIM){
        $nama = $data['nama'];
        $umur = $data['umur'];
        return $this->db->query("UPDATE mahasiswa SET nama='$nama', umur='$umur' WHERE NIM='$NIM'");
        // return $this->db->table('mahasiswa')->insert($data);
    }
}
