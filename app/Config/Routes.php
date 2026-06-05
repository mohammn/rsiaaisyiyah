<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->post('/rm/skorPoudji/tambahSkor', 'Rm\SkorPoudji::tambahSkor');
$routes->post('/rm/skorPoudji/ubahskor', 'Rm\SkorPoudji::ubahSkor');
$routes->post('/rm/skorPoudji/hapus', 'Rm\SkorPoudji::hapus');
$routes->get('/rm/skorPoudji/printskor/(:any)', 'Rm\SkorPoudji::printSkor/$1');
$routes->get('/rm/skorPoudji/muatskor/(:any)', 'Rm\SkorPoudji::muatSkor/$1');
$routes->get('/rm/skorPoudji/(:any)/(:any)', 'Rm\SkorPoudji::index/$1/$2');

$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');
$routes->post('/dashboard/pasienPerBulan', 'Dashboard::pasienPerBulan');

$routes->get('/log/muatLog/(:any)', 'Log::muatLog/$1');
$routes->get('/log', 'Log::index');

$routes->get('/ranap', 'Ranap::index');
$routes->post('/ranap/muatData', 'Ranap::muatData');

$routes->get('/rajal', 'Rajal::index');
$routes->post('/rajal/muatData', 'Rajal::muatData');

$routes->get('/igd', 'Igd::index');
$routes->post('/igd/muatData', 'Igd::muatData');


$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/login/logout', 'Login::logout');

$routes->get('/user', 'User::index');
$routes->post('/user/muatData', 'User::muatData');
$routes->post('/user/tambah', 'User::tambah');
$routes->post('/user/hapus', 'User::hapus');

$routes->get('/rm/persetujuanRajal/jalankanMigrasiTtd', 'Rm\PersetujuanRajal::jalankanMigrasiTtd');
$routes->post('/rm/persetujuanRajal/ubahWaktu', 'Rm\PersetujuanRajal::ubahWaktu');
$routes->post('/rm/persetujuanRajal/simpanTtd', 'Rm\PersetujuanRajal::simpanTtd');
$routes->post('/rm/persetujuanRajal/hapus', 'Rm\PersetujuanRajal::hapus');
$routes->post('/rm/persetujuanRajal/edit', 'Rm\PersetujuanRajal::edit');
$routes->get('/rm/persetujuanRajal/cetak/(:any)', 'Rm\PersetujuanRajal::cetak/$1');
$routes->post('/rm/persetujuanRajal/tambah', 'Rm\PersetujuanRajal::tambah');
$routes->get('/rm/persetujuanRajal/(:any)', 'Rm\PersetujuanRajal::index/$1');

$routes->post('/rm/icPembiusanLokal/ubahWaktu', 'Rm\IcPembiusanLokal::ubahWaktu');
$routes->post('/rm/icPembiusanLokal/simpanTtd', 'Rm\IcPembiusanLokal::simpanTtd');
$routes->post('/rm/icPembiusanLokal/hapus', 'Rm\IcPembiusanLokal::hapus');
$routes->get('/rm/icPembiusanLokal/cetak/(:any)', 'Rm\IcPembiusanLokal::cetak/$1');
$routes->post('/rm/icPembiusanLokal/simpan', 'Rm\IcPembiusanLokal::simpan');
$routes->get('/rm/icPembiusanLokal/(:any)', 'Rm\IcPembiusanLokal::index/$1');

$routes->post('/rm/icSesar/ubahWaktu', 'Rm\IcSesar::ubahWaktu');
$routes->post('/rm/icSesar/simpanTtd', 'Rm\IcSesar::simpanTtd');
$routes->post('/rm/icSesar/hapus', 'Rm\IcSesar::hapus');
$routes->get('/rm/icSesar/cetak/(:any)', 'Rm\IcSesar::cetak/$1');
$routes->post('/rm/icSesar/simpan', 'Rm\IcSesar::simpan');
$routes->get('/rm/icSesar/(:any)', 'Rm\IcSesar::index/$1');

$routes->post('/rm/icDarah/ubahWaktu', 'Rm\IcDarah::ubahWaktu');
$routes->post('/rm/icDarah/simpanTtd', 'Rm\IcDarah::simpanTtd');
$routes->post('/rm/icDarah/hapus', 'Rm\IcDarah::hapus');
$routes->get('/rm/icDarah/cetak/(:any)', 'Rm\IcDarah::cetak/$1');
$routes->post('/rm/icDarah/simpan', 'Rm\IcDarah::simpan');
$routes->get('/rm/icDarah/(:any)', 'Rm\IcDarah::index/$1');

$routes->post('/rm/icPembiusan/ubahWaktu', 'Rm\IcPembiusan::ubahWaktu');
$routes->post('/rm/icPembiusan/simpanTtd', 'Rm\IcPembiusan::simpanTtd');
$routes->post('/rm/icPembiusan/hapus', 'Rm\IcPembiusan::hapus');
$routes->get('/rm/icPembiusan/cetak/(:any)', 'Rm\IcPembiusan::cetak/$1');
$routes->post('/rm/icPembiusan/simpan', 'Rm\IcPembiusan::simpan');
$routes->get('/rm/icPembiusan/(:any)', 'Rm\IcPembiusan::index/$1');

$routes->post('/rm/icGeneral/ubahWaktu', 'Rm\IcGeneral::ubahWaktu');
$routes->post('/rm/icGeneral/simpanTtd', 'Rm\IcGeneral::simpanTtd');
$routes->post('/rm/icGeneral/hapus', 'Rm\IcGeneral::hapus');
$routes->get('/rm/icGeneral/cetak/(:any)', 'Rm\IcGeneral::cetak/$1');
$routes->post('/rm/icGeneral/simpan', 'Rm\IcGeneral::simpan');
$routes->get('/rm/icGeneral/(:any)', 'Rm\IcGeneral::index/$1');

$routes->post('/rm/dpjp/ubahWaktu', 'Rm\Dpjp::ubahWaktu');
$routes->post('/rm/dpjp/simpanTtd', 'Rm\Dpjp::simpanTtd');
$routes->post('/rm/dpjp/hapus', 'Rm\Dpjp::hapus');
$routes->get('/rm/dpjp/cetak/(:any)', 'Rm\Dpjp::cetak/$1');
$routes->post('/rm/dpjp/tambah', 'Rm\Dpjp::tambah');
$routes->get('/rm/dpjp/(:any)', 'Rm\Dpjp::index/$1');

$routes->post('/rm/rekonsiliasiObat/tambahPaket', 'Rm\RekonsiliasiObat::tambahPaket');
$routes->post('/rm/rekonsiliasiObat/hapusObat', 'Rm\RekonsiliasiObat::hapusObat');
$routes->get('/rm/rekonsiliasiObat/muatDataObat/(:any)', 'Rm\RekonsiliasiObat::muatDataObat/$1');
$routes->post('/rm/rekonsiliasiObat/simpanObat', 'Rm\RekonsiliasiObat::simpanObat');
$routes->get('/rm/rekonsiliasiObat/dataObat/(:any)', 'Rm\RekonsiliasiObat::dataObat/$1');

$routes->get('/rm/rekonsiliasiObat/cetak/(:any)', 'Rm\RekonsiliasiObat::cetak/$1');
$routes->post('/rm/rekonsiliasiObat/hapus', 'Rm\RekonsiliasiObat::hapus');
$routes->post('/rm/rekonsiliasiObat/simpan', 'Rm\RekonsiliasiObat::simpan');
$routes->get('/rm/rekonsiliasiObat/muatData/(:any)', 'Rm\RekonsiliasiObat::muatData/$1');
$routes->get('/rm/rekonsiliasiObat/(:any)', 'Rm\RekonsiliasiObat::index/$1');

$routes->get('/rm/(:any)', 'Rm::Index/$1');

$routes->get('/pasien', 'Pasien::Index');
$routes->post('/pasien/lihatPj', 'Pasien::lihatPj');
$routes->post('/pasien/simpanPj', 'Pasien::simpanPj');

$routes->get('/pengaturan', 'Pengaturan::Index');
$routes->post('/pengaturan/ubahWaktu', 'Pengaturan::ubahWaktu');
