<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Snapp');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
$routes->match(['get','post'],'login','Users::login',['filter' => 'withoutauth']);
$routes->match(['get','post'],'register','Users::register',['filter' => 'withoutauth']);
$routes->add('logout','Users::logout');
$routes->add('/','Snapp::activity');
$routes->add('activity_nearby','Snapp::activity_nearby');
$routes->add('(:any)','Snapp::$1',['filter'=>'auth']);
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$defaultController = 'Snapp';
//$route['defaultController'] = $defaultController;
//$controller_exceptions = array('index','activity','diary','tasks','leaderboard','addObservation');
//
//foreach($controller_exceptions as $v){
//    $route[$v] = $defaultController.$v;
//    $route[$v.'/(.*)'] = "$defaultController/".$v.'/$1';
//}

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
