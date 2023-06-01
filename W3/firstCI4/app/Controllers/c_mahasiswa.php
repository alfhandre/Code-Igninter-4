<?php

namespace App\Controllers;
// use CodeIgniter\Controller;

class c_mahasiswa extends BaseController
{
    public function template()
    {
        return view('display');
    }
    protected $model;

    public function __construct()
    {
        $this->model = new \App\Models\m_Mahasiswa();
    }
    // public function display(){
    //     $data = [
    //         'name' => 'andre',
    //         'title' => 'mahasiswa'
    //     ];
        
    //     return view('mahasiswa_view', $data);
    // 
        
    public function display()
    {
        $model = new \App\Models\m_Mahasiswa();
        $data = [
            'mahasiswa' => $model->getAll(),
            'title' => 'mahasiswa'
        ];
        return view('v_mahasiswa_display', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Mahasiswa'
        ];
        return view('v_mahasiswa_create', $data);
    }

    public function store()
    {
        // if (!$this->validate([
        //     'NIM' => [
        //         'label' => 'NIM',
        //         'rules' => 'required|numeric|min_length[9]|max_length[9]|is_unique[mahasiswa.NIM]',
        //         'errors' => [
        //             'required' => '{field} harus diisi',
        //             'numeric' => '{field} harus berupa angka',
        //             'min_length' => '{field} harus berjumlah 9 karakter',
        //             'max_length' => '{field} harus berjumlah 9 karakter',
        //             'is_unique' => '{field} sudah terdaftar'
        //         ]
        //     ],
        //     'Nama' => [
        //         'label' => 'Nama',
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => '{field} harus diisi'
        //         ]
        //     ],
        //     'Umur' => [
        //         'label' => 'Umur',
        //         'rules' => 'required|numeric',
        //         'errors' => [
        //             'required' => '{field} harus diisi',
        //             'numeric' => '{field} harus berupa angka'
        //         ]]]));
        
        $data = [
            'NIM' => $this->request->getPost('NIM'),
            'Nama' => $this->request->getPost('Nama'),
            'Umur' => $this->request->getPost('Umur')
        ];

        $this->model->mahasiswa_store($data);
        return redirect()->to('/mahasiswa');
    }
}
