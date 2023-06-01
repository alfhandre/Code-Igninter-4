<?php

namespace App\Models;

use CodeIgniter\Model as CodeIgniterModel;

class m_Mahasiswa extends CodeIgniterModel
{
    protected $table      = 'mahasiswa';
    protected $primaryKey = 'NIM';
    protected $returnType = 'array';

    public function getAll()
    {
        $sql = "SELECT * FROM mahasiswa";

        $db = db_connect();
        $data = $db->query("SELECT * FROM {$this->table}");

        return $data->getResultArray();
    }

    public function __construct()
    {
        $this->db = db_connect();
    }

    public function mahasiswa_store($data)
    {
        return $this->db->query("INSERT INTO {$this->table} (NIM, Nama, Umur) VALUES ('{$data['NIM']}', '{$data['Nama']}', '{$data['Umur']}')");
    }
}