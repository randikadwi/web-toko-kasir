<?php

namespace App\Controllers;

class Perusahaan extends BaseController
{
	// protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
  	// namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
	protected $perusahaanModel;

	
	public function __construct()
	{
		// instansi model
		$this->perusahaanModel = new \App\Models\PerusahaanModel();
	}


	// mengembalikan ke controller perusahaan
	public function index()
	{
		return redirect()->to('/perusahaan');
	}


	// menampilkan tabel data perusahaan
	public function perusahaan()
	{
		// mengecek hak mengakses 
        if (!$this->perusahaanModel->checkAksesPerusahaan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }
		
		// inisiasi data $session
		$session = session();
		// inisiasi $data 
		$data = [
			'title' 		=> 'Perusahaan',
			'perusahaan' 	=> $this->perusahaanModel->getPerusahaan(),
			'last_id' 		=> $this->perusahaanModel->generatenewidPerusahaan(),
			'nama' 			=> $session->get('nama'),
			'role' 			=> $session->get('role'),
		];

		// menampilkan ke halaman data perusahaan
		return view('perusahaan/perusahaan', $data);
	}

	
    // menambahkan data perusahaan baru ke tabel
	public function perusahaan_tambah()
	{
		// mengecek hak mengakses 
        if (!$this->perusahaanModel->checkAksesPerusahaan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// inisiasi data $session
        $session = session();
        
        // inisiasi $data 
		$data = [
			'title' 		=> 'Perusahaan',
			'subtitle' 		=> 'form tambah perusahaan',
			'perusahaan' 	=> $this->perusahaanModel->getPerusahaan(),
			'last_id' 		=> $this->perusahaanModel->generatenewidPerusahaan(),
			'validation' 	=> \Config\Services::validation(), // didapet dari withInput() validation
			'nama' 			=> $session->get('nama'),
			'role' 			=> $session->get('role'),
		];

		// menampilkan ke halaman form tambah perusahaan
		return view('perusahaan/perusahaan_tambah', $data);
	}
	

	// memvalidasi data yang akan ditambah ke tabel
	public function perusahaan_save()
	{
		// mengecek hak mengakses 
        if (!$this->perusahaanModel->checkAksesPerusahaan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		//   cek validasi data
		if (!$this->validate([
			// validasi field nama
            // rules : harus diisi dan harus unique	
			'nama' => [
				'rules' => 'required|is_unique[perusahaan.nama]',
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah terdaftar',
				],
			],
			// validasi field alamat
            // rules : harus diisi 
			'alamat' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi',
				],
			],
			// validasi field email
            // rules : harus diisi dan harus unique
			'email' => [
				'rules' => 'required|is_unique[perusahaan.email]',
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah terdaftar',
				],
			],
			// validasi field no_telp
            // rules : harus diisi 
			'no_telp' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'no telepon harus diisi',
				],
			],
			])
		){
			// menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();
            
            // me-reload halaman ketika inputan belum valid
			return redirect()->to('/perusahaan/perusahaan_tambah') ->withInput() ->with('validation', $validation);
		}
		
		// jika data valid

		// menyimpan data inputan ke array
		$inputdata = [
			'id_perusahaan' => $this->request->getVar('id_perusahaan'),
			'nama' 			=> $this->request->getVar('nama'),
			'alamat' 		=> $this->request->getVar('alamat'),
			'email' 		=> $this->request->getVar('email'),
			'no_telp' 		=> $this->request->getVar('no_telp')
		];

        //menyimpan data ke tabel
        $this->perusahaanModel->insertPerusahaan($inputdata);

	
		// menambahkan alert
		session()->setFlashdata('pesan', 'data berhasil ditambahkan');
		// redirect ke controller perusahaan
		return redirect()->to('/perusahaan');
	}
  

	// menghapus data perusahaan
	public function perusahaan_delete($id)
	{
		// mengecek hak mengakses 
        if (!$this->perusahaanModel->checkAksesPerusahaan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// menghapus data perusahaan berdasarkan $id
		$this->perusahaanModel->delete($id);
	
		//   menambahkan alert
		session()->setFlashdata('pesan', 'data berhasil dihapus');
		return redirect()->to('/perusahaan');
	}
  

	// mengubah data berdasarkan id
	public function perusahaan_ubah($id)
	{
		// mengecek hak mengakses 
        if (!$this->perusahaanModel->checkAksesPerusahaan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// inisiasi data $session
        $session = session();
        
        // inisiasi $data 
		$data = [
			'title' 		=> 'Perusahaan',
			'subtitle' 		=> 'form ubah perusahaan',
			'perusahaan' 	=> $this->perusahaanModel->getPerusahaan($id),
			'validation' 	=> \Config\Services::validation(),
			'nama' 			=> $session->get('nama'),
			'role' 			=> $session->get('role'),
		];

		// menampikan ke halaman form ubah data perusahaan berdasarkan $id 
		return view('perusahaan/perusahaan_ubah', $data);
	}
  

	// memvalidasi data perusahaan yang akan diupdate
	public function perusahaan_update($id)
	{
		// mengecek hak mengakses 
        if (!$this->perusahaanModel->checkAksesPerusahaan()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// inisiasi dengan mengambil data perusahan berdasar $id
		$perusahaanLama = $this->perusahaanModel->getPerusahaan($id);
		
		// cek validasi field nama
        // jika nama tidak diubah
		if ($perusahaanLama['nama'] == $this->request->getVar('nama')) {
			$rules_nama = 'required';
        // jika nama diubah
		} else {
			$rules_nama = 'required|is_unique[perusahaan.nama]';
		}

		// cek validasi field email
        // jika email tidak diubah
		if ($perusahaanLama['email'] == $this->request->getVar('email')) {
			$rules_email = 'required';
        // jika email diubah
		} else {
			$rules_email = 'required|is_unique[perusahaan.email]';
		}

		//   cek validasi data
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
			// validasi field alamat
            // rules : harus diisi 
			'alamat' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi',
				],
			],
			// validasi field email
            // rules : harus diisi dan unique
			'email' => [
				'rules' => $rules_email,
				'errors' => [
				'required' => '{field} harus diisi',
				'is_unique' => '{field} sudah terdaftar',
				],
			],
			// validasi field no_telp
            // rules : harus diisi 
			'no_telp' => [
				'rules' => 'required',
				'errors' => [
				'required' => 'no telepon harus diisi',
				],
			],
			])
		){
			// menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();
            // me-reload halaman ketika inputan belum valid
			return redirect()->to('/perusahaan/perusahaan_ubah/' . $this->request->getVar('id_perusahaan'))->withInput()->with('validation', $validation);
		}
		
		// jika data valid
		
		// menyimpan data ke dalam array
		$inputdata = [
			'id_perusahaan' => $id,
			'nama' 			=> $this->request->getVar('nama'),
			'alamat' 		=> $this->request->getVar('alamat'),
			'email' 		=> $this->request->getVar('email'),
			'no_telp' 		=> $this->request->getVar('no_telp'),
		];

        // menyimpan data ke tabel
        $this->perusahaanModel->updatePerusahaan($id, $inputdata);
		
		// menambahkan alert berhasil
		session()->setFlashdata('pesan', 'data berhasil diubah');
		// redirect ke controller perusahaan
		return redirect()->to('/perusahaan');
	}
}
