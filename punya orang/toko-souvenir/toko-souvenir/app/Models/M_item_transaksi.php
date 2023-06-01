<?php

namespace App\Models;

use CodeIgniter\Model;

class M_item_transaksi extends Model
{
    // protected $table            = 'mahasiswa';
    // protected $primaryKey       = 'NIM';

    // protected $useAutoIncrement = false;

    // protected $returnType       = 'array';
    // protected $useSoftDeletes   = false;

    // protected $allowedFields    = ['NIM', 'nama', 'umur'];

    
    public function saveData($data, $idtrans){
        $idbrg = $data['idbrg'];
        $kuantitas = $data['kuantitas'];
        $harga = $data['harga_diskon'];
        return $this->db->query("INSERT INTO detailjual VALUES ('$idtrans', '$idbrg', '$harga', '$kuantitas')");
    }

}
