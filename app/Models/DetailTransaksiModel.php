<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksiModel extends Model
{
// 
    protected $table      = 'detail_transaksi';     //nama tabel  
    // protected $useTimestamps = true;        //menambahkan timesstamp agar mendeteksi waktu input dan waktu ubah
    protected $allowedFields = ['id_transaksi', 'id_barang' , 'harga', 'jumlah_barang', 'total_harga']; // field yang diperbolehkan untuk diisi pada form


    // mengambil supplier berdasar id
    public function getDetailTransaksi($id = false)
    {
        // jika tidak ada parameter id maka mereturn semua data
        if($id == false){
            return $this->findAll(); 
        }
        // jika ada parameter id
        // return $this->findAll(); 
        return $this->where(['id_barang' => $id])->findAll();
    }
    

    // menyimpan data DetailTransaksi ke tabel
    public function insertDetailTransaksi($data)
    {
        //menyimpan data ke tabel
        $this->insert($data);
    }
}

