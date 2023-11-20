<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::index');
$routes->get('/auth', 'Auth::index');
$routes->post('/auth', 'Auth::login');
$routes->get('/home', 'Home::index');


$routes->get('/admin', 'Admin::index');
$routes->get('/admin/tambah', 'Admin::tambah');
$routes->post('/admin/tambah', 'Admin::tambah_simpan');
$routes->get('/admin/edit/(:segment)', 'Admin::edit/$1');
$routes->post('/admin/edit/(:segment)', 'Admin::edit_simpan/$1');
$routes->get('/admin/hapus/(:segment)', 'Admin::hapus/$1');


$routes->get('/satuan', 'Satuan::index');
$routes->get('/satuan/tambah', 'Satuan::tambah');
$routes->post('/satuan/tambah', 'Satuan::tambah_simpan');
$routes->get('/satuan/edit/(:segment)', 'Satuan::edit/$1');
$routes->post('/satuan/edit/(:segment)', 'Satuan::edit_simpan/$1');
$routes->get('/satuan/hapus/(:segment)', 'Satuan::hapus/$1');


$routes->get('/kategori', 'Kategori::index');
$routes->get('/kategori/tambah', 'Kategori::tambah');
$routes->post('/kategori/tambah', 'Kategori::tambah_simpan');
$routes->get('/kategori/edit/(:segment)', 'Kategori::edit/$1');
$routes->post('/kategori/edit/(:segment)', 'Kategori::edit_simpan/$1');
$routes->get('/kategori/hapus/(:segment)', 'Kategori::hapus/$1');

$routes->get('/produk', 'Produk::index');
$routes->get('/produk/tambah', 'Produk::tambah');
$routes->post('/produk/tambah', 'Produk::tambah_simpan');
$routes->get('/produk/edit/(:segment)', 'Produk::edit/$1');
$routes->post('/produk/edit/(:segment)', 'Produk::edit_simpan/$1');
$routes->get('/produk/hapus/(:segment)', 'Produk::hapus/$1');


$routes->get('/beli', 'Beli::index');
$routes->get('/beli/produk', 'Beli::produk');
$routes->get('/beli/tambah', 'Beli::tambah');
$routes->post('/beli/tambah', 'Beli::tambah_simpan');
$routes->get('/beli/edit/(:segment)', 'Beli::edit/$1');
$routes->post('/beli/edit/(:segment)', 'Beli::edit_simpan/$1');
$routes->get('/beli/hapus/(:segment)', 'Beli::hapus/$1');
$routes->get('/beli/nota/(:segment)', 'Beli::nota/$1');


$routes->get('/jual', 'Jual::index');
$routes->get('/jual/produk', 'Jual::produk');
$routes->get('/jual/tambah', 'Jual::tambah');
$routes->post('/jual/tambah', 'Jual::tambah_simpan');
$routes->get('/jual/edit/(:segment)', 'Jual::edit/$1');
$routes->post('/jual/edit/(:segment)', 'Jual::edit_simpan/$1');
$routes->get('/jual/hapus/(:segment)', 'Jual::hapus/$1');
$routes->get('/jual/nota/(:segment)', 'Jual::nota/$1');