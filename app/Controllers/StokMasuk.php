<?php

namespace App\Controllers;

class StokMasuk extends BaseController
{
    // protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
    protected $stokmasukModel;
    protected $barangModel;
    protected $kategoriModel;
    protected $satuanModel;
    protected $supplierModel;

        
    public function __construct()
    {
        // instansi model
        $this->stokmasukModel = new \App\Models\StokMasukModel();
        $this->barangModel = new \App\Models\BarangModel();
        $this->kategoriModel = new \App\Models\KategoriModel();
        $this->satuanModel = new \App\Models\SatuanModel();
        $this->supplierModel = new \App\Models\SupplierModel();
    }


    // mengembalikan ke controller stok masuk
    public function index()
    {
        return redirect()->to('/stokmasuk/stokmasuk');
    }


    // menampilkan tabel data Stok Masuk
    public function stokmasuk()
    {
        // mengecek hak mengakses 
        if (!$this->stokmasukModel->checkAksesStokMasuk()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
            
        // inisiasi $data 
        $data = [
            'title'         => 'Stok Masuk',
            'stokmasuk'     => $this->stokmasukModel->getStokMasuk(),
            'barang'        => $this->barangModel->getBarang(),
            'kategori'      => $this->kategoriModel->getKategori(),
            'satuan'        => $this->satuanModel->getSatuan(),
            'supplier'      => $this->supplierModel->getSupplier(),
            'last_id'       => $this->stokmasukModel->generatenewidStokMasuk(),
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role')
        ];
        
        // menampilkan ke halaman data stok masuk
        return view('stokmasuk/stokmasuk', $data);
    }


    // menghapus data stokmasuk
    public function stokmasuk_delete($id)
    {
        // mengecek hak mengakses 
        if (!$this->stokmasukModel->checkAksesStokMasuk()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // menghapus data stokmasuk sesuai $id
        $this->stokmasukModel->delete($id);

        // menambahkan alert
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        
        // redirect ke controller stokmasuk
        return redirect()->to('/stokmasuk');
    }

    public function cetak_xls()
    {
        // mengecek hak mengakses 
        if (!$this->stokmasukModel->checkAksesStokMasuk()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        $data = [
            'stokmasuk'     => $this->stokmasukModel->getStokMasuk(),
            'barang'        => $this->barangModel->getBarang(),
            'kategori'      => $this->kategoriModel->getKategori(),
            'satuan'        => $this->satuanModel->getSatuan(),
            'supplier'      => $this->supplierModel->getSupplier(),
        ];

        return view('stokmasuk/cetak_xls', $data);
    }
}