<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_admin;

class C_auth extends BaseController
{
    protected $M_admin;
    public function __construct()
    {
        $this->M_admin = new M_admin();
    }

    public function index(){
        return view('v_login');
    }

    public function login(){
        $session = session();
        $nip = $this->request->getVar('nip');
        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));
        $where = ['username' => $username, 'password' => $password, 'nip' => $nip];
        $data = $this->M_admin->getWhere($where);
        if($data){
            $ses_data = [
                'username'     => $data->username,
                'logged_in'     => true
            ];
            $session->set($ses_data);
            return redirect()->to('/home');
        }else{
            $session->setFlashdata('msg', 'NIP, Username atau password salah');
            return redirect()->to('/login');
        }
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
