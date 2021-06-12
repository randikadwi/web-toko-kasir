<?php
 
namespace App\Controllers;

// supplier mengextend dari base controller
class Supplier extends BaseController
{

	// protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
	protected $supplierModel;
	protected $perusahaanModel;


	// agar setiap method bisa mengakses model yang dibutuhkan
	public function __construct()
	{
		// instansi model
		$this->supplierModel = new \App\Models\SupplierModel();
		$this->perusahaanModel = new \App\Models\PerusahaanModel();
	}


	// mengembalikan ke controller supplier
	public function index()
	{
		return redirect()->to('/supplier');
	}


	// menampilkan tabel data supplier
	public function supplier()
	{
		// mengecek hak mengakses 
        if (!$this->supplierModel->checkAksesSupplier()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }
		
		// inisiasi data $session
        $session = session();
        
        // inisiasi $data 
		$data = [
			'title' 		=> 'Supplier',
			'supplier' 		=> $this->supplierModel->getSupplier(),
			'last_id' 		=> $this->supplierModel->generatenewidSupplier(),
			'perusahaan' 	=> $this->perusahaanModel->getPerusahaan(),
			'nama' 			=> $session->get('nama'),
			'role' 			=> $session->get('role'),
		];

		// menampilkan ke halaman supplier
		return view('supplier/supplier', $data);
	}


	// menambahkan data supplier baru ke tabel
	public function supplier_tambah()
	{
		// mengecek hak mengakses 
        if (!$this->supplierModel->checkAksesSupplier()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// inisiasi data $session
		$session = session();
				
		// inisiasi $data 
		$data = [
			'title' 		=> 'Supplier',
			'subtitle' 		=> 'form tambah supplier',
			'supplier' 		=> $this->supplierModel->getSupplier(),
			'perusahaan' 	=> $this->perusahaanModel->getPerusahaan(),
			'last_id' 		=> $this->supplierModel->generatenewidSupplier(),
			'validation' 	=> \Config\Services::validation(), // didapet dari withInput() validation
			'nama' 			=> $session->get('nama'),
			'role' 			=> $session->get('role')
		];
		
		// menampilkan ke halaman form tambah supplier
		return view('supplier/supplier_tambah', $data);
	}


	// memvalidasi data yang akan ditambah ke tabel
	public function supplier_save()
	{
		// mengecek hak mengakses 
        if (!$this->supplierModel->checkAksesSupplier()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// mengecek kevalidan data   
		if (!$this->validate([
			// validasi field nama
            // rules : harus diisi dan unique
			'nama' => [
				'rules' => 'required|is_unique[supplier.nama]',
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
			// validasi field perusahaan
            // rules :harus lebih  dari 0
			'id_perusahaan' => [
				'rules' => 'greater_than[0]',
				'errors' => [
					'greater_than' => 'harus pilih perusahaan',
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
		) {
			// menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();
            // me-reload halaman ketika inputan belum valid
			return redirect()->to('/supplier/supplier_tambah')->withInput()->with('validation', $validation);
		}
		
		// jika data valid

		// menyimpan data inputan ke array
		$inputdata = [
			'id_supplier' 	=> $this->request->getVar('id_supplier'),
			'nama' 			=> $this->request->getVar('nama'),
			'no_telp' 		=> $this->request->getVar('no_telp'),
			'alamat' 		=> $this->request->getVar('alamat'),
			'id_perusahaan' => $this->request->getVar('id_perusahaan')
		];

        //menyimpan data ke tabel
        $this->supplierModel->insertSupplier($inputdata);

			
		// menambahkan alert
		session()->setFlashdata('pesan', 'data berhasil ditambahkan');
		// redirect ke controller supplier
		return redirect()->to('/supplier');
	}


	// mengubah data supplier berdasarkan id
	public function supplier_ubah($id)
	{
		// mengecek hak mengakses 
        if (!$this->supplierModel->checkAksesSupplier()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// inisiasi data $session
        $session = session();
        
        // inisiasi $data 
		$data = [
			'title' 		=> 'Supplier',
			'subtitle' 		=> 'form ubah supplier',
			'supplier' 		=> $this->supplierModel->getsupplier($id),
			'perusahaan' 	=> $this->perusahaanModel->getPerusahaan(),
			'validation' 	=> \Config\Services::validation(),
			'nama' 			=> $session->get('nama'),
			'role' 			=> $session->get('role')
		];

		// menampilkan ke halaman form ubah data supplier berdasarkan $id
		return view('supplier/supplier_ubah', $data);
	}


	// memvalidasi data satuasupplier yang akan diupdate
	public function supplier_update($id)
	{
		// mengecek hak mengakses 
        if (!$this->supplierModel->checkAksesSupplier()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }
			
		// menampilkan data supplier sebelumnya yang gagal di submit
		$supplierLama = $this->supplierModel->getsupplier(
			$this->request->getVar('id_supplier')
		);

		// kondisi field untuk menentukan rules nama
		// jika nama tidak diubah
		if ($supplierLama['nama'] == $this->request->getVar('nama')) {
			$rules_nama = 'required';
		// jika nama diubah
		} else {
			$rules_nama = 'required|is_unique[supplier.nama]';
		}
		
		//   memvalidasi rules untuk tiap field
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
			// validasi field perusahaan
            // rules :harus lebih  dari 0
			'id_perusahaan' => [
				'rules' => 'greater_than[0]',
				'errors' => [
					'greater_than' => 'harus pilih perusahaan',
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
		) 
		{
			// menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();
            // me-reload halaman ketika inputan belum valid
			return redirect()->to('/supplier/supplier_ubah/' . $this->request->getVar('id_supplier'))->withInput()->with('validation', $validation);
		}

		// menyimpan data ke dalam array
        $inputdata = [
			'id_supplier' 	=> $id,
			'nama' 			=> $this->request->getVar('nama'),
			'alamat' 		=> $this->request->getVar('alamat'),
			'id_perusahaan' => $this->request->getVar('id_perusahaan'),
			'no_telp' 		=> $this->request->getVar('no_telp')
		];

		
        // menyimpan data ke tabel
        $this->supplierModel->updateSupplier($id, $inputdata);
        
			
		// menmbahkan alert
		session()->setFlashdata('pesan', 'data berhasil diubah');
		// redirect ke controller supplier
		return redirect()->to('/supplier');
	}

	// menghapus data
	public function supplier_delete($id)
	{
		// mengecek hak mengakses 
        if (!$this->supplierModel->checkAksesSupplier()) {
            // mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
            return redirect()->to('/dashboard');
        }

		// menghapus data supplier sesuai $id
		$this->supplierModel->delete($id);

		// menambahkan alert
		session()->setFlashdata('pesan', 'data berhasil dihapus');
		// redirect ke controller supplier
		return redirect()->to('/supplier');
	}
}
