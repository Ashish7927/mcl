<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/About', 'Home::About');
$routes->get('/Team', 'Home::Team');
$routes->get('/Careers', 'Home::Careers');
$routes->get('/Sitemap', 'Home::Sitemap');
$routes->get('/Beds', 'Home::Beds');
$routes->get('/Blog', 'Home::Blog');
$routes->get('/listing/', 'Home::listing');
$routes->get('/single_blog/(:num)', 'Home::Single_blog');
$routes->get('/FAQ', 'Home::FAQ');
$routes->get('/TermAndCondition', 'Home::TermAndCondition');
$routes->get('/PrivacyPolicy', 'Home::PrivacyPolicy');
$routes->get('/single_center/(:num)', 'Home::center');
$routes->get('/Membership', 'Home::Membership');
$routes->get('/BecomeAPartner', 'Home::BecomeAPartner');


$routes->get('/Profile', 'Home::Profile');



$routes->get('/admin', 'Admin::index');
$routes->post('/admin/login', 'Admin::loginAuth');


$routes->get('/Partner', 'Partner::index');
$routes->post('/Partner/login', 'Partner::loginAuth');



// API routes Start 
$routes->get('api/checkApi', 'ApiController::index');
$routes->get('api/masterData', 'ApiController::masterData');
$routes->post('api/register', 'ApiController::register');
$routes->post('api/sendOtpForLogin', 'ApiController::sendOtpForLogin');
$routes->post('api/verifyOtpForLogin', 'ApiController::verifyOtpForLogin');
$routes->post('api/updateProfile', 'ApiController::updateProfile');
$routes->post('api/updatePassword', 'ApiController::updatePassword');
$routes->post('api/createPost', 'ApiController::createPost');
$routes->get('api/getGeneralPost', 'ApiController::getGeneralPost');
$routes->get('api/getPresidentPost', 'ApiController::getPresidentPost');
$routes->get('api/memeberListForApproval', 'ApiController::memeberListForApproval');
$routes->post('api/approveMemebr', 'ApiController::approveMemebr');
$routes->get('api/globalMemberList', 'ApiController::globalMemberList');
$routes->post('api/localMemberList', 'ApiController::localMemberList');
$routes->post('api/getProfileDetails', 'ApiController::getProfileDetails');






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
