<?php

namespace App\Models;

use CodeIgniter\Model;

class M_barang extends Model
{
    // protected $table            = 'mahasiswa';
    // protected $primaryKey       = 'NIM';

    // protected $useAutoIncrement = false;

    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;

    // protected $allowedFields    = ['NIM', 'nama', 'umur'];

    public function getAll(){
        $query = $this->db->query("SELECT * FROM barang");
        return $query->getResult();
    }

    public function getSearch($search){
        $query = $this->db->query("SELECT * FROM barang WHERE nama_barang LIKE '%$search%'");
        return $query->getResult();
    }

    public function getOne($kode_barang){
        $query = $this->db->query("SELECT * FROM barang where kode_barang = '$kode_barang'");
        return $query->getRow();
    }

    public function kurangiStock($kode_barang, $stok){
            return $this->db->query("UPDATE barang SET stok='$stok'WHERE kode_barang='$kode_barang'");
    }

    // public function saveData($data){
    //     $nim = $data['nim'];
    //     $nama = $data['nama'];
    //     $umur = $data['umur'];
    //     return $this->db->query("INSERT INTO barang VALUES ('$nim', '$nama', '$umur')");
    //     // return $this->db->table('barang')->insert($data);
    // }
    // public function updateData($data, $NIM){
    //     $nama = $data['nama'];
    //     $umur = $data['umur'];
    //     return $this->db->query("UPDATE barang SET nama='$nama', umur='$umur' WHERE NIM='$NIM'");
    //     // return $this->db->table('barang')->insert($data);
    // }
}
