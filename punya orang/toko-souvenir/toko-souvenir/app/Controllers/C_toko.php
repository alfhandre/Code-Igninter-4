<?php

namespace App\Controllers;

use App\Models\M_souvenir;
use App\Models\M_transaksi;
use App\Models\M_item_transaksi;

class C_toko extends BaseController
{
    protected $M_souvenir;
    protected $M_transaksi;
    protected $M_item_transaksi;
    public function __construct()
    {
        $this->M_souvenir = new M_souvenir();
        $this->M_transaksi = new M_transaksi();
        $this->M_item_transaksi = new M_item_transaksi();
    }

    public function index()
    {
        $search = $this->request->getGet('cari');
        if($search){
            $souvenir = $this->M_souvenir->getSearch($search);
        }else{
            $souvenir = $this->M_souvenir->getAll();
        }
        return view('v_toko', compact('souvenir'));
    }

    public function checkout(){
        $session = session();
        $cart =  $session->get('cart');
        return view('v_checkout', compact('cart'));
    }

    public function storeCheckout(){
        $session = session();
        $cart =  $session->get('cart');
        if(!$cart){
            session()->setFlashdata('msg', 'Cart kosong silahkan pilih item terlebih dahulu');
            return redirect()->to('/');
        }
        $rules = [
            'nama' => 'required|alpha_space',
            'hp' => 'required|numeric|max_length[13]|min_length[10]',
            'alamat' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
        ];
        $message = [   // Errors
            'nama' => [
                'required' => 'Nama harus diisi',
                'alpha_space' => 'Nama tidak boleh mengandung angka',
            ],
            'hp' => [
                'required' => 'No Telepon harus diisi',
                'numeric' => 'Harus diisi angka',
                'max_length' => 'Maximal digit adalah 13',
                'min_length' => 'Minimal digit adalah 10',
            ],
            'alamat' => [
                'required' => 'Silahkan isi alamat anda',
            ],
            'kota' => [
                'required' => 'Silahkan isi kota anda',
            ],
            'kecamatan' => [
                'required' => 'Silahkan isi kecamatan anda',
            ],
        ];

        if($this->validate($rules, $message)){
            $data['nama'] = $this->request->getPost('nama');
            $data['hp'] = $this->request->getPost('hp');
            $data['alamat'] = $this->request->getPost('alamat');
            $data['kecamatan'] = $this->request->getPost('kecamatan');
            $data['kota'] = $this->request->getPost('kecamatan');
            $data['jumlah_total'] = $this->sumSubTotal();
            $transaksi = $this->M_transaksi->saveData($data);
            $this->storeItem($transaksi);
            session()->setFlashdata('msg', 'Transaksi Berhasil');
            return redirect()->to('/');
        }else{
            $data['validation'] = $this->validator;
            $data['cart'] =  session()->get('cart');
            return view('v_checkout', $data);
        }
    }

    private function storeItem($id_transaksi){
        $session = session();
        $cart =  $session->get('cart');
        foreach($cart as $c){
            $souvenir = $this->M_souvenir->getOne($c['idbrg']);
            if($souvenir->stok >= $c['kuantitas']){
                $this->M_item_transaksi->saveData($c, $id_transaksi);
                $this->M_souvenir->updateStok($c['idbrg'], $souvenir->stok - $c['kuantitas']);
            }
        }
        $session->destroy();
    }

    private function sumSubTotal(){
        $session = session();
        $cart =  $session->get('cart');
        $total = 0;
        foreach($cart as $c){
            $total += $c['kuantitas'] * $c['harga_diskon'];
        }
        return $total;
    }

}

