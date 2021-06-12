<?php

namespace App\Controllers;


class Satuan extends BaseController
{
    // protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
    protected $satuanModel;

    public function __construct()
    {
        // instansi model
        $this->satuanModel = new \App\Models\SatuanModel();
    }


    // mengembalikan ke controller satuan
    public function index()
    {
        return redirect()->to('/satuan');
    }
    

    // menampilkan tabel data satuan
    public function satuan()
    {
        // mengecek hak mengakses 
        if (!$this->satuanModel->checkAksesSatuan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'     => 'Satuan',
            'satuan'    => $this->satuanModel->findAll(),
            'last_id'   => $this->satuanModel->generatenewidSatuan(),
            'nama'      => $session->get('nama'),
            'role'      => $session->get('role')
        ];

        // menampilkan ke halaman satuan
        return view('satuan/satuan', $data);
    }


    // menambahkan data satuan baru ke tabel
    public function satuan_tambah()
    {
        // mengecek hak mengakses 
        if (!$this->satuanModel->checkAksesSatuan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'         => 'Satuan',
            'subtitle'      => 'form tambah satuan',
            'satuan'        => $this->satuanModel->getSatuan(),
            'last_id'       => $this->satuanModel->generatenewidSatuan(),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role')
        ];

        // menampilkan form tambah satuan
        return view('satuan/satuan_tambah', $data);
    }


    // memvalidasi data yang akan ditambah ke tabel
    public function satuan_save()
    {
        // mengecek hak mengakses 
        if (!$this->satuanModel->checkAksesSatuan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        //mengecek kevalidan data
        if (!$this->validate([
            // validasi field nama
            // rules : harus diisi dan harus unique
            'nama' => [
                'rules' => 'required|is_unique[satuan_barang.nama]',
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
            return redirect()->to('/satuan/satuan_tambah')->withInput()->with('validation', $validation);
        }


        // menyimpan data inputan ke array
        $inputdata = [
            'id_satuan' => $this->request->getVar('id_satuan'),
            'nama'      => $this->request->getVar('nama'),
        ];

        //menyimpan data ke tabel
        $this->satuanModel->insertSatuan($inputdata);

        
        // menambahkan alert
        session()->setFlashdata('pesan', 'data berhasil ditambahkan');
        // redirect ke controller satuan
        return redirect()->to('/satuan');
    }


    // menghapus data satuan
    public function satuan_delete($id)
    {
        // mengecek hak mengakses 
        if (!$this->satuanModel->checkAksesSatuan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // menghapus data satuan sesuai $id
        $this->satuanModel->delete($id);

        // menambahkan alert
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        // redirect ke controller satuan
        return redirect()->to('/satuan');
    }

    // fungsi mengubah data satuan
    public function satuan_ubah($id)
    {
        // mengecek hak mengakses 
        if (!$this->satuanModel->checkAksesSatuan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

        // inisiasi data $session
        $session = session();
        // inisiasi $data 
        $data = [
            'title'         => 'Satuan',
            'subtitle'      => 'form ubah satuan', // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'role'          => $session->get('role'),
            'satuan'        => $this->satuanModel->getSatuan($id),
            'validation'    => \Config\Services::validation()// didapet dari withInput() validation
        ];
        
        // menampilkan form ubah satuan berdasar $id
        return view('satuan/satuan_ubah', $data);
    }

    // memvalidasi data satuan yang akan diupdate
    public function satuan_update($id)
    {
        // mengecek hak mengakses 
        if (!$this->satuanModel->checkAksesSatuan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }
        
        // inisiasi $satuanLama dengan data satuan sesuai $id 
        $satuanLama = $this->satuanModel->getSatuan($id);


        // cek validasi field nama
        // jika nama tidak diubah
        if ($satuanLama['nama'] == $this->request->getVar('nama')) {
            $rules_nama = 'required';
        // jika nama diubah
        } else {
            $rules_nama = 'required|is_unique[satuan_barang.nama]';
        }

        // mengecek kevalidan data
        if (!$this->validate([
            // validasi field nama
            // rules : harus diisi dan unique
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
            return redirect()->to('/satuan/satuan_ubah/' . $this->request->getVar('id_satuan'))->withInput()->with('validation', $validation);
        }

        // menyimpan data ke dalam array
        $inputdata = [
            'nama'      => $this->request->getVar('nama'),
        ];

        // menyimpan data ke tabel
        $this->satuanModel->updateSatuan($id, $inputdata);
        
        // menambahkan alert berhasil
        session()->setFlashdata('pesan', 'data berhasil diubah');
        // redirect ke controller satuan
        return redirect()->to('/satuan');
    }

}