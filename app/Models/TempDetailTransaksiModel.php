<?php

namespace App\Models;

use CodeIgniter\Model;

class TempDetailTransaksiModel extends Model
{
    protected $table      = 'temp_detail_transaksi';    // nama tabel
    protected $primaryKey = 'id_temp';    // primary key tabel
    // protected $useTimestamps = true;    // otomatis mengisi field created_at dan updated_at
    protected $allowedFields = ['id_temp','id_transaksi','id_barang','harga','jumlah_barang','total_harga'];    // field yang bisa diisi
    protected $db;

    // mengambil data temp_detail_transaksi 
    public function getTempDetailTransaksi($id = false)
    {
        // mengembalikan semua data pada tabel 
        if($id == false){
            return $this->findAll(); 
         }
         // jika ada parameter id
         return $this->where(['id_temp' => $id])->first();
    }


    // mengecek apakah data dengan id_barang yg sama ada temp_detail_transaksi ata tidak
    public function cekBarangTempDetailTransaksi($id)
    {
         // jika ada parameter id
         return $this->where(['id_barang' => $id])->first();
    }


    public function getTotalBelanja()
    {
        // connect ke db
        $db = \Config\Database::connect();

        // query menjumlahkan kolom total harga 
        $query = $db->query('SELECT SUM(total_harga) as total FROM temp_detail_transaksi LIMIT 1');
        // mengambil hasil single array 
        $row   = $query->getRowArray();

        // mengembalikan nilai kolom total
        return $row['total'];
    }

    public function truncateTable()
    {
        // connect ke db
        $db = \Config\Database::connect();

        // query menjumlahkan kolom total harga 
        $db->query('TRUNCATE TABLE temp_detail_transaksi');
    }

    
    // mengenerate id satuan baru
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

    // mengenerate id satuan baru
    public function generatenewidTempTransaksi()
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
            $new_id = $last['id_temp']+1;
        }

        // mengembalikan nilai 
        return $new_id;
    }


    // Semua pegawai memiliki hak akses
    public function checkAksesSatuan()
    {
        // mengambil data role dari session yang sedang aktif
        $role = (session()->get('role'));

        // jika role  "Admin" / "Pegawai Kasir" / "Staff Gudang"
        if (($role==("Admin")) || ($role==("Pegawai Kasir")) || ($role==("Staff Gudang"))) {
            // mengembalikan nilai True 
            return True;
        }else{
            // mengembalikan nilai False 
            return False;
        }
    }

}

