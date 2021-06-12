<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table      = 'transaksi';    // nama tabel
    protected $primaryKey = 'id_transaksi';    // primary key tabel
    protected $useTimestamps = true;    // otomatis mengisi field created_at dan updated_at
    protected $allowedFields = ['id_transaksi','username','nama_kasir','total_harga','total_bayar','total_kembalian'];    // field yang bisa diisi


    // mengambil Transaksi berdasar id
    public function getTransaksi($id = false)
    {
        // jika tidak ada parameter $id
        if($id == false){
            // mengembalikan semua data pada tabel 
          return $this->findAll();  
        }

        // mengembalikan data sesuai $id
        return $this->where(['id_transaksi' => $id])->first();
    }

    // mengenerate id Transaksi baru
    public function generatenewidTransaksi()
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
            $new_id = $last['id_transaksi']+1;
        }

        // mengembalikan nilai 
        return $new_id;
    }


    // Semua pegawai memiliki hak akses
    public function checkAksesTransaksi()
    {
        // mengambil data role dari session yang sedang aktif
        $role = (session()->get('role'));

        // jika role  "Admin" / "Pegawai Kasir"
        if (($role==("Admin")) || ($role==("Pegawai Kasir"))) {
            // mengembalikan nilai True 
            return True;
        }else{
            // mengembalikan nilai False 
            return False;
        }
    }


    // menyimpan data Transaksi ke tabel
    public function insertTransaksi($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }

}

