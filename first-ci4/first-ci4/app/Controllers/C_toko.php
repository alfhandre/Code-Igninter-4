<?php

namespace App\Controllers;

use App\Models\M_barang;

class C_toko extends BaseController
{
    protected $M_barang;
    public function __construct()
    {
        $this->M_barang = new M_barang();
    }

    public function display_barang()
    {
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        $search = $this->request->getGet('cari');
        if($search){
            $barang = $this->M_barang->getSearch($search);
        }else{
            $barang = $this->M_barang->getAll();
        }
        return view('v_toko', compact('barang'));
    }
}

