<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Public
$routes->get('/', 'Index::index');
$routes->get('/produk', 'Produk::index');
$routes->get('/produk/kategori/(:segment)', 'Produk::kategori/$1');
$routes->get('/produk/(:segment)', 'Produk::detail/$1');
$routes->get('/berita', 'Berita::index');
$routes->get('/berita/(:segment)', 'Berita::detail/$1');
$routes->get('/galeri', 'Galeri::index');
$routes->get('/tentang', 'Tentang::index');
$routes->get('/kontak', 'Kontak::index');
$routes->post('/kontak', 'Kontak::kirim');

// Autentikasi
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::processLogin');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::processRegister');
$routes->get('/logout', 'Auth::logout');

// API - Format JSON 
$routes->get('/api/produk', 'Api::produk');
$routes->get('/api/produk/detail/(:segment)', 'Api::produkDetail/$1');
$routes->get('/api/kategori', 'Api::kategori');
$routes->get('/api/berita', 'Api::berita');
$routes->get('/api/berita/detail/(:segment)', 'Api::beritaDetail/$1');
$routes->get('/api/galeri', 'Api::galeri');

// Admin API (protected by auth)
$routes->group('api/admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Api\Admin::dashboard');
    $routes->get('produk', 'Api\Admin::produk');
    $routes->get('kategori', 'Api\Admin::kategori');
    $routes->get('berita', 'Api\Admin::berita');
    $routes->get('galeri', 'Api\Admin::galeri');
    $routes->get('pesan', 'Api\Admin::pesan');
    $routes->get('user', 'Api\Admin::user');
    $routes->get('produk/detail/(:num)', 'Api\Admin::produkDetail/$1');
    $routes->get('berita/detail/(:num)', 'Api\Admin::beritaDetail/$1');
});

// Panel Administrator
$routes->group('administrator', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Administrator\Dashboard::index');
    $routes->get('dashboard', 'Administrator\Dashboard::index');

    // Produk
    $routes->get('produk', 'Administrator\Produk::index');
    $routes->get('produk/tambah', 'Administrator\Produk::tambah');
    $routes->post('produk/simpan', 'Administrator\Produk::simpan');
    $routes->get('produk/edit/(:num)', 'Administrator\Produk::edit/$1');
    $routes->post('produk/update/(:num)', 'Administrator\Produk::update/$1');
    $routes->get('produk/hapus/(:num)', 'Administrator\Produk::hapus/$1');

    // Berita
    $routes->get('berita', 'Administrator\Berita::index');
    $routes->get('berita/tambah', 'Administrator\Berita::tambah');
    $routes->post('berita/simpan', 'Administrator\Berita::simpan');
    $routes->get('berita/edit/(:num)', 'Administrator\Berita::edit/$1');
    $routes->post('berita/update/(:num)', 'Administrator\Berita::update/$1');
    $routes->get('berita/hapus/(:num)', 'Administrator\Berita::hapus/$1');

    // Galeri
    $routes->get('galeri', 'Administrator\Galeri::index');
    $routes->get('galeri/tambah', 'Administrator\Galeri::tambah');
    $routes->post('galeri/simpan', 'Administrator\Galeri::simpan');
    $routes->get('galeri/hapus/(:num)', 'Administrator\Galeri::hapus/$1');

    // Kategori
    $routes->get('kategori', 'Administrator\Kategori::index');
    $routes->post('kategori/simpan', 'Administrator\Kategori::simpan');
    $routes->post('kategori/update/(:num)', 'Administrator\Kategori::update/$1');
    $routes->get('kategori/hapus/(:num)', 'Administrator\Kategori::hapus/$1');

    // Pesan Masuk
    $routes->get('pesan', 'Administrator\Pesan::index');
    $routes->get('pesan/hapus/(:num)', 'Administrator\Pesan::hapus/$1');

    // Kelola User
    $routes->get('user', 'Administrator\User::index');
    $routes->get('user/hapus/(:num)', 'Administrator\User::hapus/$1');
});
