<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table      = 'barang';   // nama tabel
    protected $primaryKey = 'id_barang';    // primary key tabel
    protected $useTimestamps = true;    // otomatis mengisi field created_at dan updated_at
    protected $allowedFields = ['id_barang','nama','id_kategori','harga','stok','id_satuan'];   // field yang bisa diisi


    // mengambil barang berdasar id
    public function getBarang($id = false)
    {
        // jika tidak ada parameter $id
        if($id == false){
            // mengembalikan semua data pada tabel 
    	    return $this->findAll();	
        }

        // mengembalikan data sesuai $id
        return $this->where(['id_barang' => $id])->first();
    }


    // mengenerate id barang baru
    public function generatenewidBarang()
    {
        // mengambil seluruh isi tabel
        $temp = $this->findAll();
        // mengambil row terakhir   
    	$last = end($temp);     

        // jika $last kosong (jika tabel masih kosong)
        if ($last == Null){
            // mengenerate id baru dengan nilai 1
            $new_id = 1;
        }else{
            // mengenerate id baru dengan nilai id terakhir + 1
            $new_id = $last['id_barang']+1;
        }

        // mengembalikan nilai 
        return $new_id;
    }


    // mengkalkulasi stok yang akan ditambahkan
    public function calculateStok($id, $stokbaru)
    {
        // mengambil data berdasarkan id
        $stoklama = $this->where(['id_barang' => $id])->first();
        // menginisialisasi dengan nilai stok yang ada
        $stoklama = $stoklama['stok'];
        
        //mengembalikan nilai stoklama ditambah stokbaru
        return $stoklama = $stoklama + $stokbaru;
    }

    
    // Semua pegawai memiliki hak akses
    public function checkAksesBarang()
    {
        // mengambil data role dari session yang sedang aktif
        $role = (session()->get('role'));

        // jika role  "Admin"  / "Staff Gudang"
        if (($role==("Admin"))  || ($role==("Staff Gudang"))) {
            // mengembalikan nilai True 
            return True;
        }else{
            // mengembalikan nilai False 
            return False;
        }
    }

    // menyimpan data Barang ke tabel
    public function insertBarang($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }

    // mengupdate data Barang 
    public function updateBarang($id,$data)
    {
        //menyimpan data ke tabel
        $this->update($id, $data);
    }

}

