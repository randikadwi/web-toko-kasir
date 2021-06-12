<?php

namespace App\Controllers;

class StokKeluar extends BaseController
{
    // protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
    protected $stokkeluarModel;
    protected $barangModel;

        
    public function __construct()
    {
        // instansi model
        $this->stokkeluarModel = new \App\Models\StokkeluarModel();
        $this->barangModel = new \App\Models\BarangModel();
        
    }


    // mengembalikan ke controller stok keluar
    public function index()
    {
        return redirect()->to('/stokkeluar/stokkeluar');
    }


    // menampilkan tabel data Stok keluar
    public function stokkeluar()
    {
        // mengecek hak mengakses 
        if (!$this->stokkeluarModel->checkAksesStokKeluar()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
            
        // inisiasi $data 
        $data = [
            'title'         => 'Stok Keluar',
            'stokkeluar'     => $this->stokkeluarModel->getStokKeluar(),
            'barang'        => $this->barangModel->getBarang(),
            'last_id'       => $this->stokkeluarModel->generatenewidStokKeluar(),
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role')
        ];
        
        // menampilkan ke halaman data stok keluar
        return view('stokkeluar/stokkeluar', $data);
    }


    // menambahkan data stokkeluar baru ke tabel
    public function stokkeluar_tambah()
    {
        // mengecek hak mengakses 
        if (!$this->stokkeluarModel->checkAksesStokkeluar()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }
        
        // inisiasi data $session
        $session = session();
            
        // inisiasi $data 
        $data = [
            'title'         => 'Stokkeluar',
            'subtitle'      => 'form tambah stok baru',
            'stokkeluar'     => $this->stokkeluarModel->getStokKeluar(),
            'barang'        => $this->barangModel->getBarang(),
            'last_id'       => $this->stokkeluarModel->generatenewidStokkeluar(),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role')
        ];

        // menampilkan ke halaman form tambah stok keluar
        return view('stokkeluar/stokkeluar_tambah', $data);
    }


    // memvalidasi data yang akan ditambah ke tabel
	public function stokkeluar_save()
	{
		// mengecek hak mengakses 
        if (!$this->stokkeluarModel->checkAksesStokKeluar()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }
        
		//   cek validasi data
		if (!$this->validate([
			// validasi field id_barang
            // rules : harus diisi dan harus unique	
			'id_barang' => [
				'rules' => 'greater_than[0]',
				'errors' => [
					'greater_than' => 'harus pilih',
				],
			],
			// validasi field harga
            // rules : harus diisi 
			'harga' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi',
				],
			],
			// validasi field jumlah
            // rules : harus diisi dan harus unique
			'jumlah' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi',
				],
			],
			// validasi field keterangan
            // rules : harus diisi 
			'keterangan' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi',
				],
			],
			])
		){
			// menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();
            
            // me-reload halaman ketika inputan belum valid
			return redirect()->to('/stokkeluar/stokkeluar_tambah') ->withInput() ->with('validation', $validation);
		}
		
		// jika data valid

        $session = session();

		// menyimpan ke array
		$inputandata = [
			'id_barang'     => $this->request->getVar('id_barang'),
			'harga' 		=> $this->request->getVar('harga'),
			'jumlah' 		=> $this->request->getVar('jumlah'),
			'harga_total' 	=> $this->request->getVar('harga_total'),
			'keterangan' 	=> $this->request->getVar('keterangan'),
			'updator' 		=> $session->get('nama'),
		];

        // menambahkan ke table stokkeluar
        $this->stokkeluarModel->insertStokKeluar($inputandata);
	
		// menambahkan alert
		session()->setFlashdata('pesan', 'data berhasil ditambahkan');
		// redirect ke controller stokkeluar
		return redirect()->to('/stokkeluar');
	}

    // menghapus data stokkeluar
    public function stokkeluar_delete($id)
    {
        // mengecek hak mengakses 
        if (!$this->stokkeluarModel->checkAksesStokKeluar()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // menghapus data stokkeluar sesuai $id
        $this->stokkeluarModel->delete($id);

        // menambahkan alert
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        // redirect ke controller stokkeluar
        return redirect()->to('/stokkeluar');
    }


    // cetak data ke file xls
    public function cetak_xls()
    {
        // mengecek hak mengakses 
        if (!$this->stokkeluarModel->checkAksesStokKeluar()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        $data = [
            'stokkeluar'     => $this->stokkeluarModel->getStokKeluar(),
            'barang'        => $this->barangModel->getBarang(),
        ];

        return view('stokkeluar/cetak_xls', $data);
    }
}