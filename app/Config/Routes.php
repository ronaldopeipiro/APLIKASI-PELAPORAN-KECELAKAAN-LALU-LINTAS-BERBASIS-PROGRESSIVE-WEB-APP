<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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

$routes->get('/', 'Home::index', ['filter' => 'auth_not_login_pelapor']);
$routes->get('/', 'Home::index', ['filter' => 'auth_not_login_personil']);
$routes->get('/choose-user', 'Home::choose_user', ['filter' => 'auth_not_login_pelapor']);
$routes->get('/choose-user', 'Home::choose_user', ['filter' => 'auth_not_login_personil']);
$routes->get('/offline-page', 'Home::offline');


// Pelapor
$routes->get('/pelapor/sign-in', 'Pelapor\Login::index', ['filter' => 'auth_not_login_pelapor']);
$routes->get('/pelapor', 'Pelapor\Dashboard::index', ['filter' => 'auth_pelapor']);

$routes->get('/pelapor/laporan', 'Pelapor\Laporan::index', ['filter' => 'auth_pelapor']);
$routes->get('/pelapor/laporan/detail/(:any)', 'Pelapor\Laporan::detail/$1', ['filter' => 'auth_pelapor']);

$routes->get('/pelapor/history', 'Pelapor\Laporan::history', ['filter' => 'auth_pelapor']);
$routes->get('/pelapor/history/detail/(:any)', 'Pelapor\Laporan::detail_history/$1', ['filter' => 'auth_pelapor']);

$routes->get('/pelapor/fasilitas-kesehatan', 'Pelapor\FasilitasKesehatan::index', ['filter' => 'auth_pelapor']);
$routes->get('/pelapor/fasilitas-kesehatan/peta', 'Pelapor\FasilitasKesehatan::peta', ['filter' => 'auth_pelapor']);
$routes->get('/pelapor/fasilitas-kesehatan/detail/(:any)', 'Pelapor\FasilitasKesehatan::detail/$1', ['filter' => 'auth_pelapor']);

$routes->get('/pelapor/daerah-rawan', 'Pelapor\DaerahRawan::index', ['filter' => 'auth_pelapor']);
$routes->get('/pelapor/pengaturan', 'Pelapor\Pengaturan::index', ['filter' => 'auth_pelapor']);

$routes->get('/pelapor/logout', 'Logout::pelapor', ['filter' => 'auth_pelapor']);

// End Pelapor


// Personil

$routes->get('/personil/sign-in', 'Personil\Login::index', ['filter' => 'auth_not_login_personil']);
$routes->post('/personil/auth-login-personil', 'Personil\Login::auth', ['filter' => 'auth_not_login_personil']);
$routes->get('/personil/sign-up', 'Personil\Login::sign_up', ['filter' => 'auth_not_login_personil']);
$routes->post('/personil/create-account', 'Personil\Login::sign_up_account', ['filter' => 'auth_not_login_personil']);
$routes->get('/personil/lupa-password', 'Personil\Login::lupa_password', ['filter' => 'auth_not_login_personil']);
$routes->get('/personil/reset-password/(:any)', 'Personil\Login::reset_password/$1', ['filter' => 'auth_not_login_personil']);

$routes->get('/personil', 'Personil\Dashboard::index', ['filter' => 'auth_personil']);

$routes->get('/personil/laporan', 'Personil\Laporan::index', ['filter' => 'auth_personil']);
$routes->get('/personil/laporan/maps', 'Personil\Laporan::maps', ['filter' => 'auth_personil']);
$routes->get('/personil/laporan/detail/(:any)', 'Personil\Laporan::detail/$1', ['filter' => 'auth_personil']);

$routes->get('/personil/history', 'Personil\Laporan::history', ['filter' => 'auth_personil']);
$routes->get('/personil/history/detail/(:any)', 'Personil\Laporan::detail_history/$1', ['filter' => 'auth_personil']);

$routes->get('/personil/fasilitas-kesehatan', 'Personil\FasilitasKesehatan::index', ['filter' => 'auth_personil']);
$routes->get('/personil/fasilitas-kesehatan/peta', 'Personil\FasilitasKesehatan::peta', ['filter' => 'auth_personil']);
$routes->get('/personil/fasilitas-kesehatan/detail/(:any)', 'Personil\FasilitasKesehatan::detail/$1', ['filter' => 'auth_personil']);

$routes->get('/personil/daerah-rawan', 'Personil\DaerahRawan::index', ['filter' => 'auth_personil']);

$routes->get('/personil/logout', 'Logout::personil', ['filter' => 'auth_personil']);

// End Personil



// Administrator

$routes->get('/admin/sign-in', 'Admin\Login::index', ['filter' => 'auth_not_login_admin']);
$routes->post('/admin/auth-login-admin', 'Admin\Login::auth', ['filter' => 'auth_not_login_admin']);

$routes->get('/admin', 'Admin\Dashboard::index', ['filter' => 'auth_admin']);

$routes->get('/admin/laporan', 'Admin\Laporan::index', ['filter' => 'auth_admin']);
$routes->get('/admin/personil', 'Admin\Personil::index', ['filter' => 'auth_admin']);
$routes->get('/admin/pelapor', 'Admin\Pelapor::index', ['filter' => 'auth_admin']);

$routes->get('/admin/data-master/kategori-korban', 'Admin\DataMaster::kategori_korban', ['filter' => 'auth_admin']);
$routes->get('/admin/data-master/kategori-kecelakaan', 'Admin\DataMaster::kategori_kecelakaan', ['filter' => 'auth_admin']);
$routes->get('/admin/data-master/kategori-laporan', 'Admin\DataMaster::kategori_laporan', ['filter' => 'auth_admin']);
$routes->get('/admin/data-master/jenis-tindakan-personil', 'Admin\DataMaster::jenis_tindakan_personil', ['filter' => 'auth_admin']);
$routes->get('/admin/data-master/satuan-kerja-personil', 'Admin\DataMaster::satker_personil', ['filter' => 'auth_admin']);
$routes->get('/admin/data-master/pangkat-personil', 'Admin\DataMaster::pangkat_personil', ['filter' => 'auth_admin']);

$routes->get('/admin/pengaturan', 'Admin\Pengaturan::index', ['filter' => 'auth_admin']);
$routes->post('/admin/pengaturan/ubah-data-akun', 'Admin\Pengaturan::ubah_data_akun', ['filter' => 'auth_admin']);
$routes->post('/admin/pengaturan/ubah-password', 'Admin\Pengaturan::ubah_password', ['filter' => 'auth_admin']);

$routes->get('/admin/logout', 'Logout::admin', ['filter' => 'auth_admin']);

// End Administrator

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

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
