<?php

namespace App\Models;

use CodeIgniter\Model;

class StokKeluarModel extends Model
{
    protected $table      = 'stok_keluar';   // nama tabel
    protected $primaryKey = 'id_stok_keluar';    // primary key tabel
    protected $useTimestamps = true;    // otomatis mengisi field created_at dan updated_at
    protected $allowedFields = ['id_stok_keluar','id_barang','harga','jumlah','harga_total','keterangan','updator'];    // field yang bisa diisi


    // mengambil stok Keluar berdasar id
    public function getStokKeluar($id = false)
    {
        // jika tidak ada parameter $id
        if($id == false){
            // mengembalikan semua data pada tabel 
        return $this->findAll();  
        }
        
        // mengembalikan data sesuai $id
        return $this->where(['id_stok_keluar' => $id])->first();
    }


    // mengenerate id stok Keluar baru
    public function generatenewidStokKeluar()
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
            $new_id = $last['id_stok_keluar']+1;
        }

        // mengembalikan nilai 
        return $new_id;
    }


    // Semua pegawai memiliki hak akses
    public function checkAksesStokKeluar()
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

    // menyimpan data StokKeluar ke tabel
    public function insertStokKeluar($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }

}

