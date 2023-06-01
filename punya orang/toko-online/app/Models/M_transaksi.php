<?php

namespace App\Models;

use CodeIgniter\Model;

class M_transaksi extends Model
{
    public function getAll(){
        $query = $this->db->query("SELECT * FROM transaksi");
        return $query->getResult();
    }

    public function saveData($data){
        $no_hp = $data['no_hp'];
        $nama = $data['nama'];
        $ongkir = $data['ongkir'];
        $alamat = $data['alamat'];
        $kode_pos = $data['kode_pos'];
        $jumlah_total = $data['jumlah_total'];
        $tanggal = date('Y-m-d');
        $this->db->query("INSERT INTO transaksi VALUES (NULL, '$nama', '$no_hp', '$alamat', '$kode_pos', '$tanggal', '$jumlah_total', '$ongkir')");
        return $this->db->insertID();
        // return $this->db->table('barang')->insert($data);
    }

    public function updateData($data, $id){
        $ongkir = $data['ongkir'];
        $jumlah_total = $data['jumlah_total'];
        return $this->db->query("UPDATE transaksi SET ongkir='$ongkir', jumlah_total='$jumlah_total' WHERE id='$id'");
        // return $this->db->table('barang')->insert($data);
    }
}
