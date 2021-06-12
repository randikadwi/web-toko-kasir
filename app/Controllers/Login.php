<?php namespace App\Controllers;

use App\Models\PegawaiModel;
use CodeIgniter\Controller;

class Login extends BaseController
{
    // protected, berarti property atau method tersebut tidak bisa diakses dari luar class, 
    // namun bisa diakses oleh class itu sendiri atau turunan class tersebut.
    protected $tempModel;

    public function __construct()
    {
        // instansi model
        $this->temp = new \App\Models\TempDetailTransaksiModel();
    }
    // mengarahkan ke page login
    public function index()
    {
        helper(['form']);
        echo view('login');
    }

    // fungsi autentikasi login
    public function auth()
    {
        $session = session();
        $model = new PegawaiModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if ($data) {
        $pass = $data['password'];
        $verify_pass = password_verify($password, $pass);

        // mengecek jenis role
        $role = $data['role'];
        if ($role == 1) {
            $role = 'Admin';
        } elseif ($role == 2) {
            $role = 'Pegawai Kasir';
        } elseif ($role == 3) {
            $role = 'Staff Gudang';
        }
        if ($verify_pass) {
            $ses_data = [
            'id_pegawai' => $data['id_pegawai'],
            'username' => $data['username'],
            'nama' => $data['nama'],
            'role' => $role,
            'logged_in' => true,
            ];
            $session->set($ses_data);
            return redirect()->to('/dashboard');
        } else {
            // menambahkan alert salah password
            $session->setFlashdata('msg', 'Wrong Password');
            return redirect()->to('/login');
        }
        } else {
        // menambahkan alert username tidak ditemukan
        $session->setFlashdata('msg', 'Username not Found');
        return redirect()->to('/login');
        }
    }

    // fungsi logout 
    public function logout()
    {

        // mengokosongkan tabel temp
        // $this->temp->truncateTable();

        
        $session = session();
        // menghapus session yang ada
        $session->destroy();
        return redirect()->to('/login');
    }
}