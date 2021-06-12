<?php

namespace App\Controllers;

class Kategori extends BaseController
{
    // protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
    protected $kategoriModel;
    protected $satuanModel;

    public function __construct()
    {
        // instansi model
        $this->kategoriModel = new \App\Models\KategoriModel();
        $this->satuanModel = new \App\Models\SatuanModel();
    }

    // mengembalikan ke controller kategori
    public function index()
    {
        return redirect()->to('/kategori');
    }


    // menampilkan tabel data kategori 
    public function kategori()
    {
        // mengecek hak mengakses 
        if (!$this->kategoriModel->checkAksesKategori()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();

        // inisiasi $data
        $data = [
            'title'     => 'Kategori',
            'kategori'  => $this->kategoriModel->findAll(),
            'last_id'   => $this->kategoriModel->generatenewidKategori(),
            'nama'      => $session->get('nama'),
            'role'      => $session->get('role')
        ];

        // menampilkan ke halaman kategori
        return view('kategori/kategori', $data);
    }

    // menambahkan data kategori baru ke tabel
    public function kategori_tambah()
    {
        // mengecek hak mengakses 
        if (!$this->kategoriModel->checkAksesKategori()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
        // inisiasi $data
        $data = [
            'title'         => 'Kategori',
            'subtitle'      => 'form tambah kategori',
            'kategori'      => $this->kategoriModel->getKategori(),
            'last_id'       => $this->kategoriModel->generatenewidKategori(),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role'),
        ];

        // menampilkan form tambah kategori
        return view('kategori/kategori_tambah', $data);
    }

    // memvalidasi data yang akan ditambah ke tabel
    public function kategori_save()
    {
        // mengecek hak mengakses 
        if (!$this->kategoriModel->checkAksesKategori()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // mengecek kevalidan data
        if (!$this->validate([
            // validasi field nama
            // rules : harus diisi dan harus unique
            'nama' => [
                'rules' => 'required|is_unique[kategori_barang.nama]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar',
                ],
            ],
        ])
        ){
            
            // menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();

            // me-reload halaman ketika inputan belum valid
            return redirect()->to('/kategori/kategori_tambah')->withInput()->with('validation', $validation);
        }

        // menyimpan data inputan ke array
        $inputdata = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama'      => $this->request->getVar('nama'),
        ];

        //menyimpan data ke tabel
        $this->kategoriModel->insertKategori($inputdata);


        // menambahkan alert berhasil
        session()->setFlashdata('pesan', 'data berhasil ditambahkan');
        // redirect ke controller kategori
        return redirect()->to('/kategori');
    }

    // menghapus data kategori
    public function kategori_delete($id)
    {
        // mengecek hak mengakses 
        if (!$this->kategoriModel->checkAksesKategori()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // menghapus data kategori sesuai $id
        $this->kategoriModel->delete($id);

        // menmbahkan alert
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        // redirect ke controller kategori
        return redirect()->to('/kategori');
    }


    // fungsi mengubah data kategori
    public function kategori_ubah($id)
    {
        // mengecek hak mengakses 
        if (!$this->kategoriModel->checkAksesKategori()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        
        // inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'         => 'Kategori',
            'subtitle'      => 'form ubah kategori', // didapet dari withInput() validation
            'kategori'      => $this->kategoriModel->getKategori($id),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role'),
        ];
        
        // menampilkan form ubah kategori berdasar $id
        return view('kategori/kategori_ubah', $data);
    }

    // mengubah data kategori
    public function kategori_update($id)
    {
        // mengecek hak mengakses 
        if (!$this->kategoriModel->checkAksesKategori()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi dengan mengambil data kategori sesuai $id
        $kategoriLama = $this->kategoriModel->getKategori($id);

        // cek validasi field nama
        // jika nama tidak diubah
        if ($kategoriLama['nama'] == $this->request->getVar('nama')) {
            $rules_nama = 'required';
        // jika nama diubah
        } else {
            $rules_nama = 'required|is_unique[kategori_barang.nama]';
        }

        // memvalidasi data 
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
        ])
        ){
            // menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();
            // me-reload halaman ketika inputan belum valid
            return redirect()->to('/kategori/kategori_ubah/' . $this->request->getVar('id_kategori'))->withInput()->with('validation', $validation);
        }

        // menyimpan data ke dalam array
        $inputdata = [
            'nama'      => $this->request->getVar('nama'),
        ];

        // menyimpan data ke tabel
        $this->kategoriModel->updateKategori($id, $inputdata);

        // menambahkan alert
        session()->setFlashdata('pesan', 'data berhasil diubah');
        // redirect ke controller kategori
        return redirect()->to('/kategori');
    }
}