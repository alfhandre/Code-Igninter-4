<?php

namespace App\Controllers;
use App\Models\M_mahasiswa;

class C_info extends BaseController
{
    public function index()
    {
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        return view('v_info');
    }
}

