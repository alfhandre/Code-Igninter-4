<?php

namespace App\Controllers;
use App\Models\M_pegawai;

class C_pegawai extends BaseController
{
    protected $M_pegawai;
    public function __construct()
    {
        $this->M_pegawai = new M_pegawai();
    }

    public function display()
    {
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        $search = $this->request->getGet('cari');
        if($search){
            $pegawai = $this->M_pegawai->getSearch($search);
        }else{
            $pegawai = $this->M_pegawai->getAll();
        }
        return view('v_display_pegawai', compact('pegawai'));
    }

    public function create(){
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        return view('v_create_pegawai');
    }

    public function save(){
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        // helper(['form']);
        $rules = [
            'NIM' => 'required|min_length[9]|max_length[9]',
            'nama' => 'required|alpha_space',
            'email' => 'required|valid_email',
            'telepon' => 'required|numeric|max_length[13]|min_length[10]',
            'gender' => 'required',
            'pendidikan' => 'required'
        ];

        $message = [   // Errors
            'nama' => [
                'required' => 'Nama harus diisi',
                'alpha_space' => 'Nama tidak boleh mengandung angka',
            ],
            'NIM' => [
                'required' => 'NIM harus diisi',
                'min_length' => 'NIM harus 9 digit',
                'max_length' => 'NIM harus 9 digit',
            ],
            'email' => [
                'required' => 'Email harus diisi',
                'valid_email' => 'Silahkan isi dengan Email yang valid',
            ],
            'telepon' => [
                'required' => 'No Telepon harus diisi',
                'numeric' => 'Harus diisi angka',
                'max_length' => 'Maximal digit adalah 13',
                'min_length' => 'Minimal digit adalah 10',
            ],
            'gender' => [
                'required' => 'Silahkan pilih gender',
            ],
            'pendidikan' => [
                'required' => 'Pendidikan harus diisi',
            ],
        ];
          
        if($this->validate($rules, $message)){
            $data['NIM'] = $this->request->getPost('NIM');
            $data['nama'] = $this->request->getPost('nama');
            $data['email'] = $this->request->getPost('email');
            $data['telepon'] = $this->request->getPost('telepon');
            $data['gender'] = $this->request->getPost('gender');
            $data['pendidikan'] = $this->request->getPost('pendidikan');
            $this->M_pegawai->saveData($data);
            session()->setFlashdata('msg', 'Berhasil menambahkan data pegawai');
            return redirect()->to('/pegawai');
        }else{
            $data['validation'] = $this->validator;
            return view('v_create_pegawai', $data);
        }
    }

    // public function detail($NIM){
    //     if(! session()->get('logged_in')){
    //         return redirect()->to('/login'); 
    //     }
    //     $mahasiswa = $this->M_mahasiswa->getOne($NIM);
    //     return view('v_detail_mahasiswa', compact('mahasiswa'));
    // }

    // public function edit($NIM){
    //     if(! session()->get('logged_in')){
    //         return redirect()->to('/login'); 
    //     }
    //     $mahasiswa = $this->M_mahasiswa->getOne($NIM);
    //     return view('v_edit_mahasiswa', compact('mahasiswa'));
    // }
    // public function update($NIM){
    //     if(! session()->get('logged_in')){
    //         return redirect()->to('/login'); 
    //     }
    //     $data['nama'] = $this->request->getPost('nama');
    //     $data['umur'] = $this->request->getPost('umur');
    //     $this->M_mahasiswa->updateData($data, $NIM);
    //     session()->setFlashdata('msg', 'Data mahasiswa berhasil di update');
    //     return redirect()->to('/mahasiswa');
    // }
}

