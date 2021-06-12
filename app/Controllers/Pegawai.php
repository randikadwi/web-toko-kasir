<?php
// DONE 100% and commented

namespace App\Controllers;

class Pegawai extends BaseController
{
	// protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
	// namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
	protected $pegawaiModel;
	protected $satuanModel;

	public function __construct()
	{
		// instansi model
		$this->pegawaiModel = new \App\Models\PegawaiModel();
		$this->satuanModel = new \App\Models\SatuanModel();
	}


	// mengembalikan ke controller pegawai
	public function index()
	{
		return redirect()->to('/pegawai');
	}


	// menampilkan data pegawai
	public function Pegawai()
	{
		// mengecek hak mengakses 
		if (!$this->pegawaiModel->checkAksesPegawai()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}
		
		// inisiasi data $session
		$session = session();

		// inisiasi $data
		$data = [
			'title' 	=> 'Pegawai',
			'pegawai' 	=> $this->pegawaiModel->getPegawai(),
			'nama' 		=> $session->get('nama'),
			'role' 		=> $session->get('role'),
		];

		// menampilkan ke halaman pegawai
		return view('pegawai/pegawai', $data);
	}


	// menambahkan data pegawai baru ke tabel
	public function pegawai_tambah()
	{
		// mengecek hak mengakses 
		if (!$this->pegawaiModel->checkAksesPegawai()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

		// inisiasi data $session
		$session = session();

		// inisiasi $data
		$data = [
			'title' 		=> 'Pegawai',
			'subtitle' 		=> 'form tambah pegawai',
			'pegawai' 		=> $this->pegawaiModel->getPegawai(),
			'last_id' 		=> $this->pegawaiModel->generatenewidPegawai(),
			'validation' 	=> \Config\Services::validation(), // didapat dari withInput() validation
			'nama' 			=> $session->get('nama'),
			'role' 			=> $session->get('role')
		];

		// menampilkan ke halaman form tambah pegawai
		return view('pegawai/pegawai_tambah', $data);
	}

	 
  	// memvalidasi data yang akan ditambahkan ke tabel pegawai
	public function pegawai_save()
	{
		// mengecek hak mengakses 
		if (!$this->pegawaiModel->checkAksesPegawai()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

		// mengecek kevalidan data
		if (!$this->validate([
			// validasi field username
			// rules : harus unique dan minimal 5 karakter
			'username' => [
				'rules' => 'is_unique[pegawai.username]|min_length[5]|alpha_numeric',
				'errors' => [
					'is_unique' => '{field} sudah terdaftar',
					'min_length' => '{field} minimal 5 karakter',
					'alpha_numeric' => '{field} tidak boleh menggunakan spasi',
				],
			],
			// validasi field password
			// rules : harus diisi dan minimal 8 karakter
			'password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => '{field} harus diisi',
					'min_length' => '{field} minimal 8 karakter',
				],
			],
			// validasi field nama
			// rules : harus diisi 
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi',
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
			// validasi field no_telp
			// rules : harus diisi
			'no_telp' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi',
				],
			],
		])
		) {
			// menyimpan data inputan ke $validation
			$validation = \Config\Services::validation();

			// me-reload halaman ketika inputan belum valid
			return redirect()->to('/pegawai/pegawai_tambah')->withInput()->with('validation', $validation);
		}

		// menyimpan data inputan ke array
		$inputdata = [
			'id_pegawai' 	=> $this->request->getVar('id_pegawai'),
			'username'		=> $this->request->getVar('username'),
			'password' 		=> password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
			'role'			=> $this->request->getVar('role'),
			'nama'			=> $this->request->getVar('nama'),
			'alamat'		=> $this->request->getVar('alamat'),
			'no_telp'		=> $this->request->getVar('no_telp'),
		];


        //menyimpan data ke tabel
        $this->pegawaiModel->insertPegawai($inputdata);

		
		// menambahkan alert berhasil
		session()->setFlashdata('pesan', 'data berhasil ditambahkan');

		// jika sukses menambahkan pegawai, maka redirect ke controller pegawai
		return redirect()->to('/pegawai');
	}

	// fungsi mengubah data pegawai berdasarkan id
	public function pegawai_ubah($id)
	{
		// mengecek hak mengakses 
		if (!$this->pegawaiModel->checkAksesPegawai()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

		// inisiasi data $session
		$session = session();

		// inisiasi $data
		$data = [
			'title' 		=> 'Pegawai',
			'subtitle' 		=> 'form ubah pegawai',
			'pegawai' 		=> $this->pegawaiModel->getPegawai($id),
			'validation' 	=> \Config\Services::validation(), // didapet dari withInput() validation
			'nama' 			=> $session->get('nama'),
			'role' 			=> $session->get('role')
		];

		// menampilkan halaman form ubah data pegawai
		return view('pegawai/pegawai_ubah', $data);
	}

	
 	// memvalidasi data satuan yang akan diupdate
	public function pegawai_update($id)
	{
		// mengecek hak mengakses 
		if (!$this->pegawaiModel->checkAksesPegawai()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

		// inisiasi $pegawaiLama
		$pegawaiLama = $this->pegawaiModel->getPegawai(
			$this->request->getVar('id_pegawai')
		);

		// cek validasi field username
		// jika username tidak diubah
		if ($pegawaiLama['username'] == $this->request->getVar('username')) {
			$rules_username = 'min_length[5]|alpha_numeric';
		// jika username diubah
		} else {
			$rules_username = 'is_unique[pegawai.username]|min_length[5]|alpha_numeric';
		}

		// mengecek kevalidan data
		if (!$this->validate([
			// validasi field username
			// rules : harus unique dan minimal 5 karakter
			'username' => [
				'rules' => $rules_username,
				'errors' => [
					'is_unique' => '{field} sudah terdaftar',
					'min_length' => '{field} minimal 5 karakter',
					'alpha_numeric' => '{field} tidak boleh menggunakan spasi',
				],
			],
			// validasi field nama
			// rules : harus diisi
			'nama' => [
				'rules' => 'required',
				'errors' => [
					'required' => '{field} harus diisi',
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
			// validasi field no_telp
			// rules : harus diisi
			'no_telp' => [
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
			return redirect()->to('/pegawai/pegawai_ubah/' . $this->request->getVar('id_pegawai'))->withInput()->with('validation', $validation);
		}
		
		// jika data sudah valid

		// menyimpan data ke dalam array
		$inputdata = [
			'id_pegawai' 	=> $id,
			'username' 		=> $this->request->getVar('username'),
			'role' 			=> $this->request->getVar('role'),
			'nama' 			=> $this->request->getVar('nama'),
			'alamat' 		=> $this->request->getVar('alamat'),
			'no_telp' 		=> $this->request->getVar('no_telp'),
		];

        // menyimpan data ke tabel
        $this->pegawaiModel->updatePegawai($id, $inputdata);
		
		// menambahkan alert berhasil
		session()->setFlashdata('pesan', 'data berhasil diubah');
		// jika sukses menambahkan pegawai, maka redirect ke controller pegawai
		return redirect()->to('/pegawai');
	}


	// memvalidasi data satuan yang akan diupdate
	public function pegawai_update_password($id)
	{
		// mengecek hak mengakses 
		if (!$this->pegawaiModel->checkAksesPegawai()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

		// mengecek kevalidan data
		if (!$this->validate([
			// validasi field password
			// rules : harus diisi dan minimal 8 karakter
			'password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => '{field} harus diisi',
					'min_length' => '{field} minimal 8 karakter',
				],
			],
			// validasi field konfirmasipassword
			// rules : harus diisi dan minimal 8 karakter dan harus cocok dengan isi field password
			'konfirmasipassword' => [
				'rules' => 'required|min_length[8]|matches[password]',
				'errors' => [
					'required' => 'konfirmasi password harus diisi',
					'min_length' => 'password minimal 8 karakter',
					'matches' => 'password tidak cocok',
				],
			]
		])
		){
			// menyimpan data inputan ke $validation
			$validation = \Config\Services::validation();

			// me-reload halaman ketika inputan belum valid
			return redirect()->to('/pegawai/pegawai_ubah/' . $this->request->getVar('id_pegawai'))->withInput()->with('validation', $validation);
		}
		
		// jika data sudah valid

		// menyimpan data ke dalam array
		$inputdata = [
			'id_pegawai' 	=> $id,
			'password' 		=> password_hash($this->request->getVar('password'),PASSWORD_DEFAULT),
		];

        // menyimpan data ke tabel
        $this->pegawaiModel->updatePegawai($id, $inputdata);
		
		// menambahkan alert berhasil
		session()->setFlashdata('pesan', 'data berhasil diubah');
		// jika sukses mengubah data pegawai, maka redirect ke controller pegawai
		return redirect()->to('/pegawai');
	}

	// menghapus data pegawai
	public function pegawai_delete($id)
	{
		// mengecek hak mengakses 
		if (!$this->pegawaiModel->checkAksesPegawai()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

		// menghapus data pegawai berdasarkan $id
		$this->pegawaiModel->delete($id);

		// menambahkan alert berhasil
		session()->setFlashdata('pesan', 'data berhasil dihapus');
		// redirect ke controller pegawai
		return redirect()->to('/pegawai');
	}

}
