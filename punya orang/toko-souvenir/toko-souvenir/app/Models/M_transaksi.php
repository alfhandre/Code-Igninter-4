<?php

namespace App\Models;

use CodeIgniter\Model;

class M_transaksi extends Model
{
    public function getAll(){
        $query = $this->db->query("SELECT * FROM transpjl");
        return $query->getResult();
    }

    public function saveData($data){
        $hp = $data['hp'];
        $nama = $data['nama'];
        $alamat = $data['alamat'];
        $kecamatan = $data['kecamatan'];
        $kota = $data['kota'];
        $jumlah_total = $data['jumlah_total'];
        $this->db->query("INSERT INTO transpjl VALUES (NULL, '$nama', '$hp', '$alamat', '$kecamatan', '$kota', '$jumlah_total')");
        return $this->db->insertID();
        // return $this->db->table('barang')->insert($data);
    }
}
