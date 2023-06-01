<?php

namespace App\Controllers;

use App\Models\M_souvenir;

class C_souvenir extends BaseController
{
    protected $M_souvenir;
    public function __construct()
    {
        $this->M_souvenir = new M_souvenir();
    }

    public function save(){
        $session = session();
        $rules = [
            'namabrg' => 'required|alpha_space',
            'harga' => 'required|greater_than[0]',
            'diskon' => 'required',
            'stok' => 'required|greater_than[0]',
            'namafile' => 'uploaded[namafile]|mime_in[namafile,image/jpg,image/jpeg,image/gif,image/png]|max_size[namafile,2048]'
        ];
        $message = [   // Errors
            'namabrg' => [
                'required' => 'Nama harus diisi',
                'alpha_space' => 'Nama tidak boleh mengandung angka',
            ],
        ];

        if($this->validate($rules, $message)){
            $data['namabrg'] = $this->request->getPost('namabrg');
            $data['harga'] = $this->request->getPost('harga');
            $data['stok'] = $this->request->getPost('stok');
            $data['diskon'] = $this->request->getPost('diskon');
            $file = $this->request->getFile('namafile');
		    $data['namafile'] = $file->getRandomName();
            $this->M_souvenir->saveData($data);
            $file->move('image/', $data['namafile']);
            session()->setFlashdata('msg', 'Souvenir berhasil ditambah');
            return redirect()->to('/home');
        }else{
            $data['username'] = $session->get('username');
            $data['validation'] = $this->validator;
            return view('v_home', $data);
        }
    }

}

