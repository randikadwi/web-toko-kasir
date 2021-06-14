<?php

namespace App\Models;

use CodeIgniter\Model;

class SatuanModel extends Model
{
    protected $table      = 'satuan_barang';    // nama tabel
    protected $primaryKey = 'id_satuan';    // primary key tabel
    protected $useTimestamps = true;    // otomatis mengisi field created_at dan updated_at
    protected $allowedFields = ['id_satuan','nama'];    // field yang bisa diisi


    // mengambil satuan berdasar id
    public function getSatuan($id = false)
    {
        // jika tidak ada parameter $id
        if($id == false){
            // mengembalikan semua data pada tabel 
          return $this->findAll();  
        }

        // mengembalikan data sesuai $id
        return $this->where(['id_satuan' => $id])->first();
    }

    // mengenerate id satuan baru
    public function generatenewidSatuan()
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
            $new_id = $last['id_satuan']+1;
        }

        // mengembalikan nilai 
        return $new_id;
    }


    // Semua pegawai memiliki hak akses
    public function checkAksesSatuan()
    {
        // mengambil data role dari session yang sedang aktif
        $role = (session()->get('role'));

        // jika role  "Admin" / "Staff Gudang"
        if (($role==("Admin"))  || ($role==("Staff Gudang"))) {
            // mengembalikan nilai True 
            return True;
        }else{
            // mengembalikan nilai False 
            return False;
        }
    }

    // menyimpan data satuan ke tabel
    public function insertSatuan($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }

    // mengupdate data satuan 
    public function updateSatuan($id,$data)
    {
        //menyimpan data ke tabel
        $this->update($id, $data);
    }
}

