<?php

namespace App\Controllers;

use App\Models\M_barang;

class C_sparepart extends BaseController
{
    protected $M_barang;
    public function __construct()
    {
       $this->M_barang = new M_barang();
    }

    public function save(){
        $session = session();
        $rules = [
            'namabarang' => 'required',
            'stok' => 'required|greater_than[0]',
            'harga' => 'required|greater_than[0]',
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar,2048]',
            'berat' => 'required|greater_than[0]'
        ];
        $message = [   // Errors
            'namabarang' => [
                'required' => 'Nama harus diisi'
            ],
        ];

        if($this->validate($rules, $message)){
            $data['namabarang'] = $this->request->getPost('namabarang');
            $data['stok'] = $this->request->getPost('stok');
            $data['harga'] = $this->request->getPost('harga');
            $data['berat'] = $this->request->getPost('berat');
            $file = $this->request->getFile('gambar');
		    $data['gambar'] = $file->getRandomName();
            $this->M_barang->saveData($data);
            $file->move('image/', $data['gambar']);
            session()->setFlashdata('msg', 'Sparepart berhasil ditambah');
            return redirect()->to('/home');
        }else{
            $data['username'] = $session->get('username');
            $data['validation'] = $this->validator;
            return view('v_home', $data);
        }
    }

}

