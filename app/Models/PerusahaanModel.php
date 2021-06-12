<?php

namespace App\Models;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table = 'perusahaan';    // nama tabel
    protected $primaryKey = 'id_perusahaan';    // primary key tabel
    protected $useTimestamps = true;    // otomatis mengisi field created_at dan updated_at
    protected $allowedFields = ['id_perusahaan', 'nama' , 'alamat', 'email', 'no_telp']; // field yang bisa diisi

    
    // mengambil perusahaan berdasar id
    public function getPerusahaan($id = false)
    {
        // jika tidak ada parameter $id
    	if($id == false){
            // mengembalikan semua data pada tabel perusahaan
            return $this->findAll(); 
        }

        // mengembalikan data perusahaan sesuai $id
        return $this->where(['id_perusahaan' => $id])->first();
    }


    // mengenerate id perusahaan baru
    public function generatenewidPerusahaan()
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
            $new_id = $last['id_perusahaan']+1;
        }

        // mengembalikan nilai 
        return $new_id;
    }

    
    // Semua pegawai memiliki hak akses
    public function checkAksesPerusahaan()
    {
        // mengambil data role dari session yang sedang aktif
        $role = (session()->get('role'));

        // jika role  "Admin" / "Staff Gudang"
        if (($role==("Admin")) ||  ($role==("Staff Gudang"))) {
            // mengembalikan nilai True 
            return True;
        }else{
            // mengembalikan nilai False 
            return False;
        }
    }


    // menyimpan data Perusahaan ke tabel
    public function insertPerusahaan($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }
    

    // mengupdate data Perusahaan 
    public function updatePerusahaan($id,$data)
    {
        //menyimpan data ke tabel
        $this->update($id, $data);
    }

}

