<?php

namespace App\Controllers;
use App\Models\M_mahasiswa;

class C_home extends BaseController
{
    public function index()
    {
        if(! session()->get('logged_in')){
            return redirect()->to('/login'); 
        }
        $session = session();
        $username = $session->get('username');
        return view('v_home', compact('username'));
    }
}

