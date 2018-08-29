<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pembeli';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// AUTH
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';

// PRODUK
$route['admin/produk/tambah'] = 'admin/tambah';
$route['admin/produk/lihat/(:any)'] = 'admin/lihat/$1';
$route['admin/produk/edit/(:any)'] = 'admin/edit/$1';
$route['admin/produk/hapus/(:any)'] = 'admin/hapus/$1';
$route['admin/produk/kategori'] = 'admin/kategori';
$route['admin/produk/editkategori/(:any)'] = 'admin/editkategori/$1';

// HOME
$route['post/(:any)'] = 'pembeli/post/$1';

$route['masuk'] = 'auth/masuk';
$route['daftar'] = 'auth/daftar';