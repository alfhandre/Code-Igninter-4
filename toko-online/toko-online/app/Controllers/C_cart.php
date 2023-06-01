<?php

namespace App\Controllers;

use App\Models\M_barang;
use App\Models\M_cart;

class C_cart extends BaseController
{
    protected $M_barang;
    public function __construct()
    {
        $this->M_barang = new M_barang();
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
            // ambil data barang by kode_barang
            $barang = $this->M_barang->getOne($this->request->getPost('kode_barang'));
            // ambil sessin cart
            $cart =  $session->get('cart');
            // check ada ga cart nya
            if($cart){
                $arr = array_search($this->request->getPost('kode_barang'), array_column($cart, 'kode_barang'));
                // check yang dicari ada ga kalau ada lakuin update kuantitas aja
                if($arr !== false){
                    $cart[$arr]['kuantitas'] = $cart[$arr]['kuantitas'] + 1;
                    $session->set('cart', $cart);
                    session()->setFlashdata('msg', 'Berhasil menambahkan cart');
                    return redirect()->to('/');    
                }
            }
            // nambah ke cart kalau tidak ada kode_barang yang sama
            $cart[] = [
                'kode_barang' => $this->request->getPost('kode_barang'),
                'nama_barang' => $barang->nama_barang,
                'kuantitas' => 1,
                'harga' => $barang->harga,
            ];
            $session->set('cart', $cart);
            // $this->M_cart->saveData($data);
            // $this->M_barang->kurangiStock($data['kode_barang'], $barang->stok - 1);
            session()->setFlashdata('msg', 'Berhasil menambahkan cart');
            return redirect()->to('/');
    }

    public function delete($id){
        $session = session();
        $cart =  $session->get('cart');
        array_splice($cart, $id-1, 1);
        $session->set('cart', $cart);
        session()->setFlashdata('msg', 'Berhasil menghapus item');
        return redirect()->to('/cart');
    }

}

