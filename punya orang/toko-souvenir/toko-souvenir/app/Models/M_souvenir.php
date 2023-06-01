<?php

namespace App\Models;

use CodeIgniter\Model;

class M_souvenir extends Model
{
    public function getAll(){
        $query = $this->db->query("SELECT * FROM souvenir");
        return $query->getResult();
    }
    public function getSearch($search){
        $query = $this->db->query("SELECT * FROM souvenir WHERE namabrg LIKE '%$search%'");
        return $query->getResult();
    }
    public function getOne($idbrg){
        $query = $this->db->query("SELECT * FROM souvenir where idbrg = '$idbrg'");
        return $query->getRow();
    }
    public function updateStok($idbrg, $stok){
        return $this->db->query("UPDATE souvenir SET stok='$stok'WHERE idbrg='$idbrg'");
    }
    public function saveData($data){
        $namabrg = $data['namabrg'];
        $harga = $data['harga'];
        $diskon = $data['diskon'];
        $stok = $data['stok'];
        $namafile = $data['namafile'];
        return $this->db->query("INSERT INTO souvenir VALUES (NULL, '$namabrg', '$harga', '$diskon', '$stok', '$namafile')");
    }
}
