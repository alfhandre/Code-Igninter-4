<?php

namespace App\Controllers;

use App\Models\M_souvenir;
use App\Models\M_cart;

class C_cart extends BaseController
{
    protected $M_souvenir;
    public function __construct()
    {
        $this->M_souvenir = new M_souvenir();
    }

    public function index()
    {
        $session = session();
        $cart =  $session->get('cart');
        return view('v_cart', compact('cart'));
    }
    public function save(){
            // declare session
            $session = session();
            // ambil data barang by idbrg
            $souvenir = $this->M_souvenir->getOne($this->request->getPost('idbrg'));
            // ambil sessin cart
            $cart =  $session->get('cart');
            // check ada ga cart nya
            // nambah ke cart kalau tidak ada idbrg yang sama
            $cart[] = [
                'idbrg' => $this->request->getPost('idbrg'),
                'namabrg' => $souvenir->namabrg,
                'kuantitas' => 1,
                'harga' => $souvenir->harga,
                'diskon' => $souvenir->diskon,
                'harga_diskon' => $souvenir->harga - (($souvenir->diskon/100) * $souvenir->harga),
            ];
            $session->set('cart', $cart);
            session()->setFlashdata('msg', 'Berhasil menambahkan cart');
            return redirect()->to('/');
    }

    public function delete(){
        $session = session();
        $session->destroy();
        return redirect()->to('/cart');
    }

}

