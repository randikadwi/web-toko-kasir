<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table      = 'kategori_barang';  // nama tabel
    protected $primaryKey = 'id_kategori';  // primary key tabel
    protected $useTimestamps = true;    // otomatis mengisi field created_at dan updated_at
    protected $allowedFields = ['id_kategori', 'nama']; // field yang bisa diisi


    // mengambil kategori berdasar id
    public function getKategori($id = false)
    {
        // jika tidak ada parameter $id
        if($id == false){
            // mengembalikan semua data pada tabel 
            return $this->findAll();  
        }

        // mengembalikan data sesuai $id
        return $this->where(['id_kategori' => $id])->first();
    }

    
    // mengenerate id kategori baru
    public function generatenewidKategori()
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
            $new_id = $last['id_kategori']+1;
        }

        // mengembalikan nilai 
        return $new_id;
    }


    // Semua pegawai memiliki hak akses
    public function checkAksesKategori()
    {
        // mengambil data role dari session yang sedang aktif
        $role = (session()->get('role'));

        // jika role  "Admin" / "Pegawai Kasir" / "Staff Gudang"
        if (($role==("Admin"))  || ($role==("Staff Gudang"))) {
            // mengembalikan nilai True 
            return True;
        }else{
            // mengembalikan nilai False 
            return False;
        }
    }

    // menyimpan data Kategori ke tabel
    public function insertKategori($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }

    // mengupdate data Kategori 
    public function updateKategori($id,$data)
    {
        //menyimpan data ke tabel
        $this->update($id, $data);
    }

}