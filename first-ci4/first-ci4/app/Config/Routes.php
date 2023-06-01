<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/home', 'C_home::index');
$routes->get('/info', 'C_info::index');
$routes->get('/mahasiswa', 'C_mahasiswa::display');
$routes->get('/mahasiswa/create', 'C_mahasiswa::create');
$routes->post('/mahasiswa/save', 'C_mahasiswa::save');
$routes->get('/mahasiswa/detail/(:segment)', 'C_mahasiswa::detail/$1');
$routes->get('/mahasiswa/(:segment)/edit/', 'C_mahasiswa::edit/$1');
$routes->post('/mahasiswa/(:segment)/update/', 'C_mahasiswa::update/$1');

$routes->get('/mahasiswa/display/import', 'C_mahasiswa::displayImport');
$routes->post('/mahasiswa/import/simpan', 'C_mahasiswa::saveImport');
$routes->get('/mahasiswa/convert/pdf', 'C_mahasiswa::convertPDF');

$routes->get('/pegawai', 'C_pegawai::display');
$routes->get('/pegawai/create', 'C_pegawai::create');
$routes->post('/pegawai/save', 'C_pegawai::save');

$routes->get('/toko', 'C_toko::display_barang');

$routes->get('/login', 'C_auth::index');
$routes->post('/login', 'C_auth::login');
$routes->get('/logout', 'C_auth::logout');

// $routes->get('/param/(:num)', 'Home::param/$1');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
