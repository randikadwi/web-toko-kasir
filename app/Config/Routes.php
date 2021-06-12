<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');

$routes->get('/', 'Login::index');
$routes->get('/dashboard', 'Dashboard::index',['filter' => 'auth']);

// Satuan
$routes->get('/satuan', 'Satuan::satuan',['filter' => 'auth']);
$routes->get('/satuan/satuan', 'Satuan::satuan',['filter' => 'auth']);
$routes->add('/satuan/satuan_tambah', 'Satuan::satuan_tambah',['filter' => 'auth']);
$routes->match(['get', 'put'], '/satuan/satuan_ubah/(:num)', 'Satuan::satuan_ubah/$1',['filter' => 'auth']);
$routes->delete('/satuan/satuan_delete/(:num)', 'Satuan::satuan',['filter' => 'auth']);

// // barang
$routes->get('/barang', 'Barang::barang',['filter' => 'auth']);
$routes->get('/barang/barang', 'Barang::barang',['filter' => 'auth']);
$routes->add('/barang/barang_tambah', 'Barang::barang_tambah',['filter' => 'auth']);
$routes->match(['get', 'put'], '/barang/barang_ubah/(:num)', 'Barang::barang_ubah/$1',['filter' => 'auth']);
$routes->delete('/barang/barang_delete/(:num)', 'Barang::barang',['filter' => 'auth']);

// Kategori
$routes->get('/kategori', 'Kategori::kategori',['filter' => 'auth']);
$routes->add('/kategori/tambah', 'Kategori::tambah');
$routes->get('/kategori/kategori', 'Kategori::kategori',['filter' => 'auth']);
$routes->add('/kategori/kategori_tambah', 'Kategori::kategori_tambah',['filter' => 'auth']);
$routes->match(['get', 'put'], '/kategori/kategori_ubah/(:num)', 'Kategori::kategori_ubah/$1',['filter' => 'auth']);
$routes->delete('/kategori/kategori_delete/(:num)', 'Kategori::kategori',['filter' => 'auth']);

// Perusahaan
$routes->get('/perusahaan', 'Perusahaan::perusahaan',['filter' => 'auth']);
$routes->get('/perusahaan/perusahaan', 'Perusahaan::perusahaan',['filter' => 'auth']);
$routes->add('/perusahaan/perusahaan_tambah', 'Perusahaan::perusahaan_tambah',['filter' => 'auth']);
$routes->match(['get', 'put'], '/perusahaan/perusahaan_ubah/(:num)', 'Perusahaan::perusahaan_ubah/$1',['filter' => 'auth']);
$routes->delete('/perusahaan/perusahaan_delete/(:num)', 'Perusahaan::perusahaan',['filter' => 'auth']);

// Supplier
$routes->get('/supplier', 'Supplier::supplier',['filter' => 'auth']);
$routes->get('/supplier/supplier', 'Supplier::supplier',['filter' => 'auth']);
$routes->add('/supplier/supplier_tambah', 'Supplier::supplier_tambah',['filter' => 'auth']);
$routes->match(['get', 'put'], '/supplier/supplier_ubah/(:num)', 'Supplier::supplier_ubah/$1',['filter' => 'auth']);
$routes->delete('/supplier/supplier_delete/(:num)', 'Supplier::supplier',['filter' => 'auth']);

// Pegawai
$routes->get('/pegawai', 'Pegawai::pegawai',['filter' => 'auth']);
$routes->get('/pegawai/pegawai', 'Pegawai::pegawai',['filter' => 'auth']);
$routes->add('/pegawai/pegawai_tambah', 'Pegawai::pegawai_tambah',['filter' => 'auth']);
$routes->match(['get', 'put'], '/pegawai/pegawai_ubah/(:num)', 'Pegawai::pegawai_ubah/$1',['filter' => 'auth']);
$routes->delete('/pegawai/pegawai_delete/(:num)', 'Pegawai::pegawai',['filter' => 'auth']);


// Pegawai
$routes->get('/transaksi', 'Transaksi::transaksi',['filter' => 'auth']);
$routes->get('/transaksi/transaksi', 'transaksi::transaksi',['filter' => 'auth']);
$routes->add('/transaksi/tambahbarang', 'transaksi::tambahbarang',['filter' => 'auth']);
// $routes->match(['get', 'put'], '/transaksi/transaksi_ubah/(:num)', 'transaksi::transaksi_ubah/$1',['filter' => 'auth']);
// $routes->delete('/transaksi/transaksi_delete/(:num)', 'transaksi::transaksi',['filter' => 'auth']);




$routes->get('/laporan', 'Laporan::laporan',['filter' => 'auth']);
// $routes->delete('/transaksi/hapusbarang/(:num)/(:num)', 'transaksi::hapusbarang/$1/$2',['filter' => 'auth']);







// $routes->get('/admin', 'Admin::index',['filter' => 'auth']);
// $routes->get('admin/satuan_tambah', 'Admin::satuan_tambah');
// $routes->get('admin/satuan_ubah/(:segment)', 'Admin::satuan_ubah/$1');
// $routes->get('admin/satuan/(:any)/(:num)', 'Admin::satuan/$1');
// $routes->delete('admin/satuan/(:num)', 'Admin::satuan_delete/$1');

// $routes->delete('admin/kategori/(:num)', 'Admin::kategori_delete/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
