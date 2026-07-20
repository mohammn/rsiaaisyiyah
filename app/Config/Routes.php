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

$routes->post('/rm/hiv/hapus', 'Rm\Hiv::hapus');
$routes->get('/rm/hiv/cetak/(:any)', 'Rm\Hiv::cetak/$1');
$routes->post('/rm/hiv/simpan', 'Rm\Hiv::simpan');
$routes->get('/rm/hiv/(:any)', 'Rm\Hiv::index/$1');

$routes->post('/rm/tbAnak/ubahWaktu', 'Rm\TbAnak::ubahWaktu');
$routes->post('/rm/tbAnak/simpanTtd', 'Rm\TbAnak::simpanTtd');
$routes->post('/rm/tbAnak/hapus', 'Rm\TbAnak::hapus');
$routes->get('/rm/tbAnak/cetak/(:any)', 'Rm\TbAnak::cetak/$1');
$routes->post('/rm/tbAnak/simpan', 'Rm\TbAnak::simpan');
$routes->get('/rm/tbAnak/(:any)', 'Rm\TbAnak::index/$1');

$routes->post('/rm/rm4PermintaanMasuk/ubahWaktu', 'Rm\Rm4PermintaanMasuk::ubahWaktu');
$routes->post('/rm/rm4PermintaanMasuk/simpanTtd', 'Rm\Rm4PermintaanMasuk::simpanTtd');
$routes->post('/rm/rm4PermintaanMasuk/hapus', 'Rm\Rm4PermintaanMasuk::hapus');
$routes->get('/rm/rm4PermintaanMasuk/cetak/(:any)', 'Rm\Rm4PermintaanMasuk::cetak/$1');
$routes->post('/rm/rm4PermintaanMasuk/simpan', 'Rm\Rm4PermintaanMasuk::simpan');
$routes->get('/rm/rm4PermintaanMasuk/(:any)', 'Rm\Rm4PermintaanMasuk::index/$1');

$routes->post('/rm/rm26bRujukKeluar/ubahWaktu', 'Rm\Rm26bRujukKeluar::ubahWaktu');
$routes->post('/rm/rm26bRujukKeluar/simpanTtd', 'Rm\Rm26bRujukKeluar::simpanTtd');
$routes->post('/rm/rm26bRujukKeluar/hapus', 'Rm\Rm26bRujukKeluar::hapus');
$routes->post('/rm/rm26bRujukKeluar/hapusData', 'Rm\Rm26bRujukKeluar::hapusData');
$routes->get('/rm/rm26bRujukKeluar/cetak/(:any)', 'Rm\Rm26bRujukKeluar::cetak/$1');
$routes->post('/rm/rm26bRujukKeluar/simpanData', 'Rm\Rm26bRujukKeluar::simpanData');
$routes->post('/rm/rm26bRujukKeluar/muatData', 'Rm\Rm26bRujukKeluar::muatData');
$routes->post('/rm/rm26bRujukKeluar/simpan', 'Rm\Rm26bRujukKeluar::simpan');
$routes->get('/rm/rm26bRujukKeluar/(:any)', 'Rm\Rm26bRujukKeluar::index/$1');

$routes->post('/rm/rm26iPenyimpananBarang/ubahWaktu', 'Rm\Rm26iPenyimpananBarang::ubahWaktu');
$routes->post('/rm/rm26iPenyimpananBarang/simpanTtd', 'Rm\Rm26iPenyimpananBarang::simpanTtd');
$routes->post('/rm/rm26iPenyimpananBarang/hapus', 'Rm\Rm26iPenyimpananBarang::hapus');
$routes->post('/rm/rm26iPenyimpananBarang/hapusBarang', 'Rm\Rm26iPenyimpananBarang::hapusBarang');
$routes->get('/rm/rm26iPenyimpananBarang/cetak/(:any)', 'Rm\Rm26iPenyimpananBarang::cetak/$1');
$routes->post('/rm/rm26iPenyimpananBarang/simpanBarang', 'Rm\Rm26iPenyimpananBarang::simpanBarang');
$routes->post('/rm/rm26iPenyimpananBarang/muatData', 'Rm\Rm26iPenyimpananBarang::muatData');
$routes->post('/rm/rm26iPenyimpananBarang/simpan', 'Rm\Rm26iPenyimpananBarang::simpan');
$routes->get('/rm/rm26iPenyimpananBarang/(:any)', 'Rm\Rm26iPenyimpananBarang::index/$1');

$routes->post('/rm/rm26hKepercayaan/ubahWaktu', 'Rm\Rm26hKepercayaan::ubahWaktu');
$routes->post('/rm/rm26hKepercayaan/simpanTtd', 'Rm\Rm26hKepercayaan::simpanTtd');
$routes->post('/rm/rm26hKepercayaan/hapus', 'Rm\Rm26hKepercayaan::hapus');
$routes->get('/rm/rm26hKepercayaan/cetak/(:any)', 'Rm\Rm26hKepercayaan::cetak/$1');
$routes->post('/rm/rm26hKepercayaan/simpan', 'Rm\Rm26hKepercayaan::simpan');
$routes->get('/rm/rm26hKepercayaan/(:any)', 'Rm\Rm26hKepercayaan::index/$1');

$routes->post('/rm/rm26fKerohanian/ubahWaktu', 'Rm\Rm26fKerohanian::ubahWaktu');
$routes->post('/rm/rm26fKerohanian/simpanTtd', 'Rm\Rm26fKerohanian::simpanTtd');
$routes->post('/rm/rm26fKerohanian/hapus', 'Rm\Rm26fKerohanian::hapus');
$routes->get('/rm/rm26fKerohanian/cetak/(:any)', 'Rm\Rm26fKerohanian::cetak/$1');
$routes->post('/rm/rm26fKerohanian/simpan', 'Rm\Rm26fKerohanian::simpan');
$routes->get('/rm/rm26fKerohanian/(:any)', 'Rm\Rm26fKerohanian::index/$1');

$routes->post('/rm/rm26nIzinKeluar/ubahWaktu', 'Rm\Rm26nIzinKeluar::ubahWaktu');
$routes->post('/rm/rm26nIzinKeluar/simpanTtd', 'Rm\Rm26nIzinKeluar::simpanTtd');
$routes->post('/rm/rm26nIzinKeluar/hapus', 'Rm\Rm26nIzinKeluar::hapus');
$routes->get('/rm/rm26nIzinKeluar/cetak/(:any)', 'Rm\Rm26nIzinKeluar::cetak/$1');
$routes->post('/rm/rm26nIzinKeluar/simpan', 'Rm\Rm26nIzinKeluar::simpan');
$routes->get('/rm/rm26nIzinKeluar/(:any)', 'Rm\Rm26nIzinKeluar::index/$1');

$routes->post('/rm/rm26ePendapatLain/ubahWaktu', 'Rm\Rm26ePendapatLain::ubahWaktu');
$routes->post('/rm/rm26ePendapatLain/simpanTtd', 'Rm\Rm26ePendapatLain::simpanTtd');
$routes->post('/rm/rm26ePendapatLain/hapus', 'Rm\Rm26ePendapatLain::hapus');
$routes->get('/rm/rm26ePendapatLain/cetak/(:any)', 'Rm\Rm26ePendapatLain::cetak/$1');
$routes->post('/rm/rm26ePendapatLain/simpan', 'Rm\Rm26ePendapatLain::simpan');
$routes->get('/rm/rm26ePendapatLain/(:any)', 'Rm\Rm26ePendapatLain::index/$1');

$routes->post('/rm/rm3TataTertib/ubahWaktu', 'Rm\Rm3TataTertib::ubahWaktu');
$routes->post('/rm/rm3TataTertib/simpanTtd', 'Rm\Rm3TataTertib::simpanTtd');
$routes->post('/rm/rm3TataTertib/hapus', 'Rm\Rm3TataTertib::hapus');
$routes->get('/rm/rm3TataTertib/cetak/(:any)', 'Rm\Rm3TataTertib::cetak/$1');
$routes->post('/rm/rm3TataTertib/simpan', 'Rm\Rm3TataTertib::simpan');
$routes->get('/rm/rm3TataTertib/(:any)', 'Rm\Rm3TataTertib::index/$1');


$routes->post('/rm/rm20bUdds/muatJamSementara', 'Rm\Rm20bUdds::muatJamSementara');
$routes->post('/rm/rm20bUdds/hapusJamSementara', 'Rm\Rm20bUdds::hapusJamSementara');
$routes->post('/rm/rm20bUdds/simpanJamSementara', 'Rm\Rm20bUdds::simpanJamSementara');
$routes->post('/rm/rm20bUdds/simpanJam', 'Rm\Rm20bUdds::simpanJam');
$routes->post('/rm/rm20bUdds/hapusTgl', 'Rm\Rm20bUdds::hapusTgl');
$routes->post('/rm/rm20bUdds/muatTgl', 'Rm\Rm20bUdds::muatTgl');
$routes->post('/rm/rm20bUdds/simpanTgl', 'Rm\Rm20bUdds::simpanTgl');
$routes->post('/rm/rm20bUdds/hapus', 'Rm\Rm20bUdds::hapus');
$routes->get('/rm/rm20bUdds/cetak/(:any)', 'Rm\Rm20bUdds::cetak/$1');
$routes->post('/rm/rm20bUdds/tambahPaket', 'Rm\Rm20bUdds::tambahPaket');
$routes->post('/rm/rm20bUdds/hapusObat', 'Rm\Rm20bUdds::hapusObat');
$routes->post('/rm/rm20bUdds/lihat', 'Rm\Rm20bUdds::lihat');
$routes->post('/rm/rm20bUdds/muatObat', 'Rm\Rm20bUdds::muatObat');
$routes->post('/rm/rm20bUdds/simpanObat', 'Rm\Rm20bUdds::simpanObat');
$routes->post('/rm/rm20bUdds/simpan', 'Rm\Rm20bUdds::simpan');
$routes->get('/rm/rm20bUdds/(:any)', 'Rm\Rm20bUdds::index/$1');

$routes->post('/rm/rm0Sbar/hapus', 'Rm\Rm0Sbar::hapus');
$routes->post('/rm/rm0Sbar/hapusJudul', 'Rm\Rm0Sbar::hapusJudul');
$routes->get('/rm/rm0Sbar/cetak/(:any)/(:any)', 'Rm\Rm0Sbar::cetak/$1/$2');
$routes->post('/rm/rm0Sbar/muatData', 'Rm\Rm0Sbar::muatData');
$routes->post('/rm/rm0Sbar/verif', 'Rm\Rm0Sbar::verif');
$routes->post('/rm/rm0Sbar/lihat', 'Rm\Rm0Sbar::lihat');
$routes->post('/rm/rm0Sbar/simpan', 'Rm\Rm0Sbar::simpan');
$routes->post('/rm/rm0Sbar/simpanJudul', 'Rm\Rm0Sbar::simpanJudul');
$routes->get('/rm/rm0Sbar/(:any)/(:any)', 'Rm\Rm0Sbar::index/$1/$2');

$routes->post('/rm/rm27bKateter/hapus', 'Rm\Rm27bKateter::hapus');
$routes->get('/rm/rm27bKateter/cetak/(:any)', 'Rm\Rm27bKateter::cetak/$1');
$routes->post('/rm/rm27bKateter/simpan', 'Rm\Rm27bKateter::simpan');
$routes->get('/rm/rm27bKateter/(:any)', 'Rm\Rm27bKateter::index/$1');

$routes->post('/rm/rm27cPlebitis/hapus', 'Rm\Rm27cPlebitis::hapus');
$routes->get('/rm/rm27cPlebitis/cetak/(:any)', 'Rm\Rm27cPlebitis::cetak/$1');
$routes->post('/rm/rm27cPlebitis/simpan', 'Rm\Rm27cPlebitis::simpan');
$routes->get('/rm/rm27cPlebitis/(:any)', 'Rm\Rm27cPlebitis::index/$1');

$routes->post('/rm/lukaOperasi/hapus', 'Rm\LukaOperasi::hapus');
$routes->get('/rm/lukaOperasi/cetak/(:any)/(:any)', 'Rm\LukaOperasi::cetak/$1/$2');
$routes->post('/rm/lukaOperasi/simpan', 'Rm\LukaOperasi::simpan');
$routes->get('/rm/lukaOperasi/(:any)/(:any)', 'Rm\LukaOperasi::index/$1/$2');

$routes->post('/rm/lembarEdukasi/ubahWaktu', 'Rm\LembarEdukasi::ubahWaktu');
$routes->post('/rm/lembarEdukasi/simpanTtd', 'Rm\LembarEdukasi::simpanTtd');
$routes->post('/rm/lembarEdukasi/hapus', 'Rm\LembarEdukasi::hapus');
$routes->get('/rm/lembarEdukasi/cetak/(:any)', 'Rm\LembarEdukasi::cetak/$1');
$routes->post('/rm/lembarEdukasi/simpan', 'Rm\LembarEdukasi::simpan');
$routes->get('/rm/lembarEdukasi/(:any)', 'Rm\LembarEdukasi::index/$1');

$routes->post('/rm/persetujuanRanap/ubahWaktu', 'Rm\PersetujuanRanap::ubahWaktu');
$routes->post('/rm/persetujuanRanap/simpanTtd', 'Rm\PersetujuanRanap::simpanTtd');
$routes->post('/rm/persetujuanRanap/hapus', 'Rm\PersetujuanRanap::hapus');
$routes->get('/rm/persetujuanRanap/cetak/(:any)', 'Rm\PersetujuanRanap::cetak/$1');
$routes->post('/rm/persetujuanRanap/simpan', 'Rm\PersetujuanRanap::simpan');
$routes->get('/rm/persetujuanRanap/(:any)', 'Rm\PersetujuanRanap::index/$1');

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
