<?php

namespace App\Controllers;


class Laporan extends BaseController
{
    // protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
    protected $transaksiModel;
    protected $stokmasukModel;
    protected $stokkeluarModel;

    public function __construct()
    {
        // instansi model
        $this->transaksiModel = new \App\Models\TransaksiModel();
        $this->stokmasukModel = new \App\Models\StokMasukModel();
        $this->stokkeluarModel = new \App\Models\StokKeluarModel();
    }


    // mengembalikan ke controller laporan
    public function index()
    {
        return redirect()->to('/laporan');
    }
    

    // menampilkan tabel data laporan
    public function laporan()
    {
        // // mengecek hak mengakses 
        // if (!$this->laporanModel->checkAkseslaporan()) {
        //     // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
        //     return redirect()->to('/dashboard');
        // }

        // inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'     => 'Laporan Keuangan',
            'transaksi'    => $this->transaksiModel->findAll(),
            'stokmasuk'    => $this->stokmasukModel->findAll(),
            'stokkeluar'    => $this->stokkeluarModel->findAll(),
            'nama'      => $session->get('nama'),
            'role'      => $session->get('role')
        ];

        // menampilkan ke halaman laporan
        return view('/laporan', $data);
    }

}