<?php

namespace App\Controllers;

use PhpParser\Node\Stmt\Echo_;
use TCPDF;

class Transaksi extends BaseController
{
    // protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
    protected $transaksiModel;
    protected $barangModel;
    protected $tempModel;
    protected $satuanModel;
    protected $stokMasukModel;
    protected $stokKeluarModel;
    protected $detailtransaksiModel;

    public function __construct()
    {
        // instansi model
        $this->transaksiModel = new \App\Models\TransaksiModel();
        $this->satuanModel = new \App\Models\SatuanModel();
        $this->barangModel = new \App\Models\BarangModel();
        $this->stokmasukModel = new \App\Models\StokMasukModel();
        $this->stokkeluarModel = new \App\Models\StokKeluarModel();
        $this->detailtransaksiModel = new \App\Models\DetailTransaksiModel();
        $this->temp = new \App\Models\TempDetailTransaksiModel();
        
    }

    
    // mengembalikan ke controller transaksi
    public function index()
    {
        return redirect()->to('/transaksi');
    }  

    
    // menampilkan tabel data satuan
    public function transaksi()
    {
        // mengecek hak mengakses 
		if (!$this->transaksiModel->checkAksesTransaksi()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

        // inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'         => 'Transaksi',
            'transaksi'     => $this->transaksiModel->getTransaksi(),
            'total_belanja' => $this->temp->getTotalBelanja(),
            'temp'          => $this->temp->findAll(),
            'last_id_temp'  => $this->temp->generatenewidTempTransaksi(),
            'barang'        => $this->barangModel->getBarang(),
            'detail_transaksi' => $this->detailtransaksiModel->getDetailTransaksi(),
            'last_id'       => $this->transaksiModel->generatenewidTransaksi(),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'validationbayar'    => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'          => $session->get('nama'),
            'username'      => $session->get('username'),
            'role'          => $session->get('role'),
        ];


        // menampilkan ke halaman satuan
        return view('transaksi/transaksi', $data);
    }


    // menampilkan tabel data listtransaksi
    public function listtransaksi()
    {
        // mengecek hak mengakses 
		if (!$this->transaksiModel->checkAksesTransaksi()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

        // inisiasi data $session
        $session = session();
        
        // inisiasi $data 
        $data = [
            'title'             => 'List Transaksi',
            'transaksi'         => $this->transaksiModel->getTransaksi(),
            'detail_transaksi'  => $this->detailtransaksiModel->getDetailTransaksi(),
            'barang'            => $this->barangModel->getBarang(),
            'last_id'           => $this->transaksiModel->generatenewidTransaksi(),
            'validation'        => \Config\Services::validation(), // didapet dari withInput() validation
            'nama'              => $session->get('nama'),
            'username'          => $session->get('username'),
            'role'              => $session->get('role'),
        ];

        // menampilkan ke halaman satuan
        return view('transaksi/listtransaksi', $data);
    }
    
    // menambah barang ke table temp
    public function tambahbarang()
    {
        // mengecek hak mengakses 
		if (!$this->transaksiModel->checkAksesTransaksi()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

        // penambahan barang tidak boleh melebihi jumlah stok yang ada
        $id = $this->request->getVar('id_barang');
        $barang = $this->barangModel->getBarang();
        $idbarang = 0;
        $stoktersedia = 0;
        foreach($barang as $a){
            if($id == $a['id_barang']){
                $idbarang = ($a['id_barang']);
                $stoktersedia = ($a['stok']);
            }
        }

        //mengecek kevalidan data
        if (!$this->validate([
            // validasi field jumlah barang
            // rules : harus lebih dari 0
            'id_barang' => [
                'rules' => 'greater_than[0]',
                'errors' => [
                    'greater_than' => '{field} harus lebih dari 0',
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
            // validasi field jumlah barang
            // rules : harus lebih dari 0 dan tidak boleh melebihi stok yang tersedia
            'jumlah_barang' => [
                'rules' => 'greater_than[0]|less_than_equal_to['.$stoktersedia.']',
                'errors' => [
                    'greater_than' => 'jumlah barang harus lebih dari 0',
                    'less_than_equal_to' => 'jumlah barang melebihi stok',
                ],
            ],
            ])
        ){
            // menyimpan data inputan ke $validation
            $validation = \Config\Services::validation();
            
            // menambahkan alert gagal
            session()->setFlashdata('danger', ($validation->getError('jumlah_barang')));

            // me-reload halaman ketika inputan belum valid
            return redirect()->to('/transaksi/transaksi')->withInput()->with('validation', $validation);
        }
        
        $jmlbarang = $stoktersedia-($this->request->getVar('jumlah_barang'));
        $barang = $this->barangModel->getBarang($idbarang);


        // jika barang yang akan ditambahkan tidak ada di tabel temp_detail_transaksi
        if(!$this->temp->cekBarangTempDetailTransaksi($idbarang)){
            $this->temp->save([
                'id_transaksi'  => $this->request->getVar('id_transaksi'),
                'id_barang'     => $this->request->getVar('id_barang'),
                'harga'         => $this->request->getVar('harga'),
                'jumlah_barang' => $this->request->getVar('jumlah_barang'),
                'total_harga'   => $this->request->getVar('total_harga'),
            ]);
        
        // jika barang yang akan ditambahkan ada di tabel temp_detail_transaksi
        }else{
            $exist = $this->temp->cekBarangTempDetailTransaksi($idbarang);
            $jumlah_barang_baru = $exist['jumlah_barang'] + $this->request->getVar('jumlah_barang');
            $total_harga_baru = $exist['total_harga'] + $this->request->getVar('total_harga');
            // mengupdate tabel
            $this->temp->save([
                'id_temp'       => $exist['id_temp'],
                'id_transaksi'  => $this->request->getVar('id_transaksi'),
                'id_barang'     => $this->request->getVar('id_barang'),
                'harga'         => $this->request->getVar('harga'),
                'jumlah_barang' => $jumlah_barang_baru,
                'total_harga'   => $total_harga_baru,
            ]); 
        };

        // update jumlah stok sekarang
        $this->barangModel->save([
            'id_barang' => $idbarang,
            'stok' => $jmlbarang,
        ]);
        
        // redirect ke controller transaksi
        return redirect()->to('/transaksi');
    }


    // menghapus barang dari tabel temp
    public function hapusbarang($id,$id_barang)
    {   
        // mengecek hak mengakses 
		if (!$this->transaksiModel->checkAksesTransaksi()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

        $tabel_barang = $this->barangModel->getBarang($id_barang);
        $barang_hapus = ($this->temp->getTempDetailTransaksi($id));
        $stok_tambah = $tabel_barang['stok'] + ($barang_hapus['jumlah_barang']);
        
        // menambahkan stok yang dihapus, ke dalam table barang lagi
        $inputdata = [
            'stok'=> $stok_tambah,
        ];

        // menyimpan data ke tabel
        $this->barangModel->updateBarang($tabel_barang['id_barang'], $inputdata);

        // menghapus data pegawai berdasarkan $id
        $this->temp->delete($id);
        
        // menambahkan alert berhasil
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        // redirect ke controller transaksi
        return redirect()->to('/transaksi');
    }


    // fungsi membayar transaksi
    public function bayar()
    {
        // mengecek hak mengakses 
		if (!$this->transaksiModel->checkAksesTransaksi()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

        $total = $this->request->getVar('total_belanja');
        $totalRule = "greater_than_equal_to[".$total."]";
        
        //mengecek kevalidan data
        if (!$this->validate([
            // validasi field jumlah barang
            // rules : harus lebih dari 0
            'total_bayar' => [
                'rules' => $totalRule,
                'errors' => [
                    'greater_than_equal_to' => 'pembayaran kurang',
                ],
            ],
            ])
        ){
            // menyimpan data inputan ke $validation
            $validationbayar = \Config\Services::validation();
            
            // me-reload halaman ketika inputan belum valid
            return redirect()->to('/transaksi/transaksi')->withInput()->with('validationbayar', $validationbayar);
        }

        $session = session();

        // menyimpan ke array
        $inputdata = [
            'username'          => $session->get('username'),
            'nama_kasir' 		=> $session->get('nama'),
            'total_harga'       => $this->request->getVar('total_belanja'),
            'total_bayar'       => $this->request->getVar('total_bayar'),
            'total_kembalian'   => $this->request->getVar('total_kembalian'),
        ];

        // menambahkan ke tabel
        $this->transaksiModel->insertTransaksi($inputdata);
        
        $temp = $this->temp->findAll();

        // perulangan memasukan data barang ke stok keluar
        foreach($temp as $a){
            // menyimpan ke array
            $inputdata = [
                'id_barang'         => $a['id_barang'],
                'jumlah'            => $a['jumlah_barang'],
                'harga'             => $a['harga'],
                'harga_total'       => $a['total_harga'],
                'keterangan'        => 'penjualan',
                'updator'           => $session->get('nama'),
            ];

            // menambahkan ke tabel
            $this->stokkeluarModel->insertStokKeluar($inputdata);
        };
        
        // perulangan memasukan data barang ke tabel detail transaksi
        foreach($temp as $a){
            // menyimpan ke array
            $inputdata = [
                'id_transaksi'      => $a['id_transaksi'],
                'id_barang'      => $a['id_barang'],
                'harga'      => $a['harga'],
                'jumlah_barang'      => $a['jumlah_barang'],
                'total_harga'      => $a['total_harga'],
            ];
            
            // menambahkan ke tabel
            $this->detailtransaksiModel->insertDetailTransaksi($inputdata);
        };
        
        // mengosongkan tabel temp
        $this->temp->truncateTable();

        // menambahkan alert
        session()->setFlashdata('pesan', 'transaksi berhasil');

        // redirect ke controller transaksi
		return redirect()->to('/transaksi');
        // mengokosongkan tabel temp
    }

    public function transaksi_delete($id)
	{
        // mengecek hak mengakses 
		if (!$this->transaksiModel->checkAksesTransaksi()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}
		
		// menghapus data transaksi sesuai $id
		$this->transaksiModel->delete($id);

		// menambahkan alert
		session()->setFlashdata('pesan', 'data berhasil dihapus');
		// redirect ke controller transaksi
		return redirect()->to('/transaksi/listtransaksi');
	}

    public function cetak_xls()
    {
        // mengecek hak mengakses 
		if (!$this->transaksiModel->checkAksesTransaksi()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

        $data = [
            'transaksi'     => $this->transaksiModel->getTransaksi(),
            'barang'        => $this->barangModel->getBarang(),
            'detail_transaksi' => $this->detailtransaksiModel->getDetailTransaksi(),
        ];

        return view('transaksi/cetak_xls', $data);
    }

    public function cetak_struk($id)
    {
        // mengecek hak mengakses 
		if (!$this->transaksiModel->checkAksesTransaksi()) {
			// mengembalikan ke halaman dashboard jika hak aksesnya tidak sesuai
			return redirect()->to('/dashboard');
		}

        $data = [
            'title'         => 'Transaksi',
            'transaksi'     => $this->transaksiModel->getTransaksi($id),
            'total_belanja' => $this->temp->getTotalBelanja(),
            'temp'          => $this->temp->findAll(),
            'last_id_temp'  => $this->temp->generatenewidTempTransaksi(),
            'barang'        => $this->barangModel->getBarang(),
            'detail_transaksi' => $this->detailtransaksiModel->getDetailTransaksi(),
            'last_id'       => $this->transaksiModel->generatenewidTransaksi(),
            'validation'    => \Config\Services::validation(), // didapet dari withInput() validation
            'validationbayar'    => \Config\Services::validation(), // didapet dari withInput() validation
        ];

        // menyimpan tampilan struk ke variable $html
        $html =  view('transaksi/cetak_struk', $data);
        
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A7', true, 'UTF-8', false);
        $pdf->AddPage();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $namafile = "struk_".$this->transaksiModel->getTransaksi($id)['id_transaksi'].".pdf";
        $pdf->SetTitle($namafile);
        $pdf->Output($namafile,'I');
    }
    

}