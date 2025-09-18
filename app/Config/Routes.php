<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->post('/skorPoudji/tambahpasien', 'SkorPoudji::tambahPasien');
$routes->post('/skorPoudji/hapuspasien', 'SkorPoudji::hapusPasien');
$routes->post('/skorPoudji/muatdatapasien', 'SkorPoudji::muatDataPasien');
$routes->post('/skorPoudji/muattambahpasien', 'SkorPoudji::muatTambahPasien');
$routes->post('/skorPoudji/muatpasien', 'SkorPoudji::muatPasien');
$routes->post('/skorPoudji/muatskor', 'SkorPoudji::muatSkor');
$routes->post('/skorPoudji/ubahskor', 'SkorPoudji::ubahSkor');
$routes->get('/skorPoudji/printskor/(:any)', 'SkorPoudji::printSkor/$1');
$routes->get('/skorPoudji', 'SkorPoudji::index');
$routes->get('/', 'Dashboard::index');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/login/logout', 'Login::logout');


$routes->get('/user', 'User::index');
$routes->post('/user/muatData', 'User::muatData');
$routes->post('/user/tambah', 'User::tambah');
$routes->post('/user/hapus', 'User::hapus');
