<?php

namespace App\Controllers;

use App\Models\M_barang;
use App\Models\M_transaksi;
use App\Models\M_item_transaksi;
use App\Models\M_ongkir;

class C_toko extends BaseController
{
    protected $M_barang;
    protected $M_ongkir;
    protected $M_transaksi;
    protected $M_item_transaksi;
    public function __construct()
    {
        $this->M_barang = new M_barang();
        $this->M_ongkir = new M_ongkir();
        $this->M_transaksi = new M_transaksi();
        $this->M_item_transaksi = new M_item_transaksi();
    }

    public function index()
    {
        $search = $this->request->getGet('cari');
        if($search){
            $barang = $this->M_barang->getSearch($search);
        }else{
            $barang = $this->M_barang->getAll();
        }
        return view('v_toko', compact('barang'));
    }

    public function checkout(){
        $session = session();
        $cart =  $session->get('cart');
        $berat_barang = 0;
        foreach($cart as $c){
            $barang = $this->M_barang->getOne($c['kode_barang']);
            if($barang->stok >= $c['kuantitas']){
                $berat_barang += $c['kuantitas'] * $barang->berat;
            }
        }
        $berat_kg = $berat_barang / 1000;
        $berat_kg_int = intdiv($berat_barang, 1000);
        if($berat_kg <= 1){
            $berat_barang = 1;
        }else{
            if($berat_kg - $berat_kg_int > 0.3){
                $berat_barang = $berat_kg_int + 1;
            }else{
                $berat_barang = $berat_kg_int;
            }
        }
        $kode_pos = $this->M_ongkir->getAll();
        return view('v_checkout', compact('cart', 'kode_pos', 'berat_barang'));
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
            'no_hp' => 'required|numeric|max_length[13]|min_length[10]',
            'alamat' => 'required',
            'kode_pos' => 'required|numeric|max_length[5]|min_length[5]'
        ];
        $message = [   // Errors
            'nama' => [
                'required' => 'Nama harus diisi',
                'alpha_space' => 'Nama tidak boleh mengandung angka',
            ],
            'no_hp' => [
                'required' => 'No Telepon harus diisi',
                'numeric' => 'Harus diisi angka',
                'max_length' => 'Maximal digit adalah 13',
                'min_length' => 'Minimal digit adalah 10',
            ],
            'kode_pos' => [
                'required' => 'Kode Pos harus diisi',
                'numeric' => 'Harus diisi angka',
                'max_length' => 'kode post terdiri dari 5 digit',
                'min_length' => 'kode post terdiri dari 5 digit',
            ],
            'alamat' => [
                'required' => 'Silahkan isi alamat anda',
            ],
        ];

        if($this->validate($rules, $message)){
            $data['nama'] = $this->request->getPost('nama');
            $data['no_hp'] = $this->request->getPost('no_hp');
            $data['alamat'] = $this->request->getPost('alamat');
            $data['kode_pos'] = $this->request->getPost('kode_pos');
            $data['jumlah_total'] = 0;
            $data['ongkir'] = 0;
            // if(!$this->checkStock()){
            //     session()->setFlashdata('msg', 'Transaksi Gagal Stock Tidak mencukupi');
            //     return redirect()->to('/cart');    
            // }
            $berat_barang = 0;
            $total = 0;
            $transaksi = $this->M_transaksi->saveData($data);
            $cart =  $session->get('cart');
            foreach($cart as $c){
                $barang = $this->M_barang->getOne($c['kode_barang']);
                if($barang->stok >= $c['kuantitas']){
                    $total += $c['kuantitas'] * $c['harga'];
                    $berat_barang += $c['kuantitas'] * $barang->berat;
                    $this->M_item_transaksi->saveData($c, $transaksi);
                    $this->M_barang->kurangiStock($c['kode_barang'], $barang->stok - $c['kuantitas']);
                }
            }
            $session->destroy();
            $ongkir = $this->ongkir($berat_barang, $data['kode_pos']);
            $this->M_transaksi->updateData(['jumlah_total' => $total, 'ongkir' => $ongkir ], $transaksi);
            session()->setFlashdata('msg', 'Transaksi Berhasil');
            return redirect()->to('/');
        }else{
            $cart =  $session->get('cart');
            $berat_barang = 0;
            foreach($cart as $c){
                $barang = $this->M_barang->getOne($c['kode_barang']);
                if($barang->stok >= $c['kuantitas']){
                    $berat_barang += $c['kuantitas'] * $barang->berat;
                }
            }
            $berat_kg = $berat_barang / 1000;
            $berat_kg_int = intdiv($berat_barang, 1000);
            // dd($berat_kg_int);
            if($berat_kg <= 1){
                $berat_barang = 1;
            }else{
                if($berat_kg - $berat_kg_int > 0.3){
                    $berat_barang = $berat_kg_int + 1;
                }else{
                    $berat_barang = $berat_kg_int;
                }
            }
            $kode_pos = $this->M_ongkir->getAll();
            $validation = $this->validator;
            return view('v_checkout', compact('cart', 'kode_pos', 'berat_barang', 'validation'));
            // $data['cart'] =  session()->get('cart');
            // return view('v_checkout', $data);
        }
    }

    private function ongkir($berat, $kode_pos){
        $ongkir = $this->M_ongkir->getOne($kode_pos);
        $berat_kg = $berat / 1000;
        $berat_kg_int = intdiv($berat, 1000);
        if($berat_kg <= 1){
            return $ongkir->harga;
        }else{
            if($berat_kg - $berat_kg_int > 0.3){
                return $ongkir->harga * ($berat_kg_int + 1);
            }else{
                return $ongkir->harga * ($berat_kg_int);
            }
        }
    }
    
    // private function checkStock(){
    //     $session = session();
    //     $cart =  $session->get('cart');
    //     foreach($cart as $c){
    //         $barang = $this->M_barang->getOne($c['kode_barang']);
    //         if($barang->stok < $c['kuantitas']){
    //             return false;
    //         }
    //     }
    //     return true;
    // }

    // private function sumSubTotal(){
    //     $session = session();
    //     $cart =  $session->get('cart');
    //     $total = 0;
    //     foreach($cart as $c){
    //         $total += $c['kuantitas'] * $c['harga'];
    //     }
    //     return $total;
    // }

}

