<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends BaseController
{
  // menampilkan menu dashboard 
  public function index()
  {
    $session = session();

    $data = [
      'title' => 'dashboard',
      'nama' => $session->get('nama'),
      'role' => $session->get('role'),
    ];

    echo view('dashboard', $data);
  }

}