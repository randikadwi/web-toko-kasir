<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table      = 'pegawai';     // nama tabel
    protected $primaryKey = 'id_pegawai';   // primary key tabel
    protected $useTimestamps = true;    // otomatis mengisi field created_at dan updated_at
    protected $allowedFields = ['id_pegawai', 'username', 'password', 'role', 'nama', 'alamat', 'no_telp'];

    
    // mengambil pegawai berdasar id
    public function getPegawai($id = false)
    {
        // jika tidak ada parameter $id
        if($id == false){
            // mengembalikan semua data pada tabel 
          return $this->findAll();  
        }

        // mengembalikan data sesuai $id
        return $this->where(['id_pegawai' => $id])->first();
    }


    // mengenerate id pegawai baru
    public function generatenewidPegawai()
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
            $new_id = $last['id_pegawai']+1;
        }

        // mengembalikan nilai 
        return $new_id;;
    }

    
    // Hanya pegawai dengan role admin yang memiliki hak akses
    public function checkAksesPegawai()
    {
        // mengambil data role dari session yang sedang aktif
        $role = (session()->get('role'));

        // jika role  "Admin"
        if (($role==("Admin"))) {
            // mengembalikan nilai True 
            return True;
        }else{
            // mengembalikan nilai False 
            return False;
        }
    }

    // menyimpan data Pegawai ke tabel
    public function insertPegawai($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }
    

    // mengupdate data Pegawai 
    public function updatePegawai($id,$data)
    {
        //menyimpan data ke tabel
        $this->update($id, $data);
    }
}

