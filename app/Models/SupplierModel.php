<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{

    protected $table      = 'supplier';     //nama tabel 
    protected $primaryKey = 'id_supplier';  //nama primary key 
    protected $useTimestamps = true;        //menambahkan timesstamp agar mendeteksi waktu input dan waktu ubah
    protected $allowedFields = ['id_supplier', 'nama' , 'alamat', 'no_telp', 'id_perusahaan']; // field yang diperbolehkan untuk diisi pada form


    // mengambil supplier berdasar id
    public function getSupplier($id = false)
    {
        // jika tidak ada parameter id maka mereturn semua data
        if($id == false){
           return $this->findAll(); 
        }
        // jika ada parameter id
        return $this->where(['id_supplier' => $id])->first();
    }


    // mengenerate id supplier baru
    public function generatenewidSupplier()
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
            $new_id = $last['id_supplier']+1;
        }

        // mengembalikan nilai 
        return $new_id;
    }


    // Semua pegawai memiliki hak akses
    public function checkAksesSupplier()
    {
        // mengambil data role dari session yang sedang aktif
        $role = (session()->get('role'));

        // jika role  "Admin" / "Pegawai Kasir" / "Staff Gudang"
        if (($role==("Admin")) || ($role==("Staff Gudang"))) {
            // mengembalikan nilai True 
            return True;
        }else{
            // mengembalikan nilai False 
            return False;
        }
    }

    // menyimpan data Supplier ke tabel
    public function insertSupplier($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }

    // mengupdate data Supplier 
    public function updateSupplier($id,$data)
    {
        //menyimpan data ke tabel
        $this->update($id, $data);
    }
}

