<?php

namespace App\Controllers;

class Barang extends BaseController
{
    // protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
    protected $barangModel;
    protected $satuanModel;
    protected $kategoriModel;
    protected $stokmasukModel;
    protected $supplierModel;
    protected $perusahaanModel;


    public function __construct()
    {
        // instansi model
        $this->barangModel = new \App\Models\BarangModel();
        $this->satuanModel = new \App\Models\SatuanModel();
        $this->kategoriModel = new \App\Models\KategoriModel();
        $this->stokmasukModel = new \App\Models\StokMasukModel();
        $this->supplierModel = new \App\Models\SupplierModel();
        $this->perusahaanModel = new \App\Models\PerusahaanModel();
    }


    // mengembalikan ke controller barang
    public function index()
    {
        return redirect()->to('/barang');
    }


    // menampilkan tabel data barang
    public function barang()
    {
        // mengecek hak akses 
        if (!$this->barangModel->checkAksesBarang()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'     => 'Barang',
            'barang'    => $this->barangModel->getBarang(),
            'satuan'    => $this->satuanModel->getSatuan(),
            'kategori'  => $this->kategoriModel->getKategori(),
            'last_id'   => $this->barangModel->generatenewidBarang(),
            'nama'      => $session->get('nama'),
            'role'      => $session->get('role')
        ];
        
        // menampilkan ke halaman barang
        return view('barang/barang', $data);
    }


    // menambahkan data barang baru ke tabel
    public function barang_tambah()
    {
        // mengecek hak akses 
        if (!$this->barangModel->checkAksesBarang()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'         => 'Barang',
            'barang'        => $this->barangModel->getBarang(),
            'satuan'        => $this->satuanModel->getSatuan(),
            'kategori'      => $this->kategoriModel->getKategori(),
            'last_id'       => $this->barangModel->generatenewidBarang(),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role')
        ];

        // menampilkan ke halaman form tambah barang
        return view('barang/barang_tambah', $data);
    }


    // memvalidasi data yang akan ditambah ke tabel
    public function barang_save()
    {
        // mengecek hak akses 
        if (!$this->barangModel->checkAksesBarang()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // mengecek kevalidan data
        if (!$this->validate([
            // validasi field nama
            // rules : harus diisi dan harus unique
            'nama' => [
                'rules' => 'required|is_unique[barang.nama]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar',
                ],
            ],
            // validasi field id_kategori
            // rules : harus lebih dari 0
            'id_kategori' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => 'harus pilih kategori',
                ],
            ],
            // validasi field id_satuan
            // rules : harus lebih dari 0
            'id_satuan' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => 'harus pilih satuan',
                ],
            ],
            // validasi field harga
            // rules : harus lebih dari 0
            'harga' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => '{field} harus lebih dari 0',
                ],
            ],
        ])
        ){
            // menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();

            // me-reload halaman ketika inputan belum valid
            return redirect()->to('/barang/barang_tambah')->withInput()->with('validation', $validation);
        }

        // jika data valid

        // menyimpan data ke dalam array
        $inputdata = [
            'id_barang'     => $this->request->getVar('id_barang'),
            'stok'          => $this->request->getVar('stok'),
            'nama'          => $this->request->getVar('nama'),
            'id_kategori'   => $this->request->getVar('id_kategori'),
            'id_satuan'     => $this->request->getVar('id_satuan'),
            'harga'         => $this->request->getVar('harga'),
        ];

        // menyimpan data ke tabel
        $this->barangModel->insertBarang($inputdata);
        
        // menambahkan alert
        session()->setFlashdata('pesan', 'data berhasil ditambahkan');
        
        // jika sukses menambahkan pegawai, maka redirect ke controller barang
        return redirect()->to('/barang');
    }


    // mengubah data berdasarkan id
	public function barang_ubah($id)
	{
		// mengecek hak mengakses 
        if (!$this->barangModel->checkAksesBarang()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'         => 'Barang',
            'barang'        => $this->barangModel->getBarang($id),
            'satuan'        => $this->satuanModel->getSatuan(),
            'kategori'      => $this->kategoriModel->getKategori(),
            'last_id'       => $this->barangModel->generatenewidBarang(),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role')
        ];

        // menampilkan ke halaman form tambah barang
        return view('barang/barang_ubah', $data);
	}
    

    // memvalidasi data yang akan ditambah ke tabel
    public function barang_update($id)
    {
        // mengecek hak akses 
        if (!$this->barangModel->checkAksesBarang()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi dengan mengambil data perusahan berdasar $id
		$barangLama = $this->barangModel->getBarang($id);
		
		// cek validasi field nama
        // jika nama tidak diubah
		if ($barangLama['nama'] == $this->request->getVar('nama')) {
			$rules_nama = 'required';
        // jika nama diubah
		} else {
			$rules_nama = 'required|is_unique[barang.nama]';
		}

        // mengecek kevalidan data
        if (!$this->validate([
            // validasi field nama
            // rules : harus diisi dan harus unique
            'nama' => [
                'rules' => $rules_nama,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar',
                ],
            ],
            // validasi field id_kategori
            // rules : harus lebih dari 0
            'id_kategori' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => 'harus pilih kategori',
                ],
            ],
            // validasi field id_satuan
            // rules : harus lebih dari 0
            'id_satuan' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => 'harus pilih satuan',
                ],
            ],
            // validasi field harga
            // rules : harus lebih dari 0
            'harga' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => '{field} harus lebih dari 0',
                ],
            ],
        ])
        ){
            // menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();

            // me-reload halaman ketika inputan belum valid
            return redirect()->to('/barang/barang_ubah/' . $this->request->getVar('id_barang'))->withInput()->with('validation', $validation);
        }

        // jika data valid

        // menyimpan data ke dalam array
        $inputdata = [
            'id_barang'     => $id,
            'nama'          => $this->request->getVar('nama'),
            'id_kategori'   => $this->request->getVar('id_kategori'),
            'id_satuan'     => $this->request->getVar('id_satuan'),
            'harga'         => $this->request->getVar('harga'),
        ];

        // menyimpan data ke tabel
        $this->barangModel->updateBarang($id, $inputdata);

        // menambahkan alert
        session()->setFlashdata('pesan', 'data berhasil diubah');
        
        // jika sukses menambahkan pegawai, maka redirect ke controller barang
        return redirect()->to('/barang');
    }

    // menambahkan stok barang baru ke tabel barang dan 
    // menambahkan data stok masuk ke tabel stok masuk
    public function barang_tambah_stok($id)
    {
        // mengecek hak akses 
        if (!$this->barangModel->checkAksesBarang()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
        
        // inisiasi $data
        $data = [
            'title'         => 'Barang',
            'subtitle'      => 'form tambah stok baru',
            'barang'        => $this->barangModel->getBarang($id),
            'stokmasuk'     => $this->stokmasukModel->getStokMasuk(),
            'last_id'       => $this->stokmasukModel->generatenewidStokMasuk(),
            'kategori'      => $this->kategoriModel->getKategori(),
            'satuan'        => $this->satuanModel->getSatuan(),
            'supplier'      => $this->supplierModel->getSupplier(),
            'perusahaan'    => $this->perusahaanModel->getPerusahaan(),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role')
        ];

        // menampilkan halaman form tambah stok
        return view('barang/barang_tambah_stok', $data);
    }


    // memvalidasi data yang akan ditambah ke tabel
    public function barang_stok_save($id)
    {
        // mengecek hak akses 
        if (!$this->barangModel->checkAksesBarang()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // mengmbil data dari session
        $session = session();

        // mengecek kevalidan data
        if (!$this->validate([
            // validasi field stok
            // rules : harus diisi dan harus lebih dari 0
            'stok' => [
                'rules' => 'required|greater_than[0]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'greater_than' => '{field} harus lebih dari 0',
                ],
            ],
            // validasi field harga
            // rules : harus diisi dan harus lebih dari 0
            'harga' => [
                'rules' => 'required|greater_than[0]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'greater_than' => '{field} harus lebih dari 0',
                ],
            ],
            // validasi field id_supplier
            // rules : harus lebih dari 0
            'id_supplier' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => 'harus pilih supplier',
                ],
            ],
        ])
        ){
            // menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();
            
            // me-reload halaman ketika inputan belum valid
            return redirect()->to('/barang/barang_tambah_stok/' . $this->request->getVar('id_barang'))->withInput()->with('validation', $validation);
        }

        // jika inputan valid
        
        // inisiasi $stoktambahan
        $stoktambahan = $this->request->getVar('stok');

        // memanggil fungsi calculateStok() untuk menghitung stokterbaru
        $stokbaru = $this->barangModel->calculateStok($id,$stoktambahan);
        
        //menyimpan data ke tabel barang
        $inputdata = [
            'id_barang' => $id,
            'stok' => $stokbaru,
        ];

        // menyimpan data ke tabel
        $this->barangModel->updateBarang($id, $inputdata);

        // menyimpan data ke tabel stokmasuk
        $inputandata = [
            'id_stok_masuk' => $this->request->getVar('id_stok_masuk'),
            'id_barang'     => $id,
            'nama_barang'   => $this->request->getVar('nama_barang'),
            'id_kategori'   => $this->request->getVar('id_kategori'),
            'id_satuan'     => $this->request->getVar('id_satuan'),
            'id_supplier'   => $this->request->getVar('id_supplier'),
            'harga'         => $this->request->getVar('harga'),
            'jumlah'        => $this->request->getVar('stok'),
            'harga_total'   => $this->request->getVar('harga_total'),
            'updator'       => $session->get('nama')
        ];
        
        // menyimpan ke tabel
        $this->stokmasukModel->insertStokMasuk($inputandata);

        // menambahkan alert berhasil
        session()->setFlashdata('pesan', 'data berhasil ditambahkan');
        // redirect ke controller barang
        return redirect()->to('/barang');
    }


    // menghapus data barang
    public function barang_delete($id)
    {
        // mengecek hak akses 
        if (!$this->barangModel->checkAksesBarang()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // menghapus data sesuai $id
        $this->barangModel->delete($id);

        // menmbahkan alert berhasil
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        
        // redirect ke halaman barang
        return redirect()->to('/barang');
    }

    public function cetak_xls()
    {
        $data = [
            'barang' => $this->barangModel->getBarang(),
            'kategori' => $this->kategoriModel->getKategori(),
            'satuan' => $this->satuanModel->getSatuan(),
        ];

        return view('barang/cetak_xls', $data);
    }
}