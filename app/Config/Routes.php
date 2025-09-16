<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->post('/skorPoudji/tambahpasien', 'skorPoudji::tambahPasien');
$routes->post('/skorPoudji/hapuspasien', 'skorPoudji::hapusPasien');
$routes->post('/skorPoudji/muatdatapasien', 'skorPoudji::muatdatapasien');
$routes->post('/skorPoudji/muattambahpasien', 'skorPoudji::muattambahpasien');
$routes->post('/skorPoudji/muatpasien', 'skorPoudji::muatPasien');
$routes->post('/skorPoudji/muatskor', 'skorPoudji::muatSkor');
$routes->post('/skorPoudji/ubahskor', 'skorPoudji::ubahSkor');
$routes->get('/skorPoudji/printskor/(:any)', 'skorPoudji::printSkor/$1');
$routes->get('/skorPoudji', 'skorPoudji::index');
$routes->get('/', 'dashboard::index');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/login/logout', 'Login::logout');


$routes->get('/user', 'User::index');
$routes->post('/user/muatData', 'User::muatData');
$routes->post('/user/tambah', 'User::tambah');
$routes->post('/user/hapus', 'User::hapus');
