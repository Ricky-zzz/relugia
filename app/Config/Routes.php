<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');
$routes->post('/login', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/admin/dashboard', 'AuthController::admin');

$routes->get('/admin/user', 'UserController::index');
$routes->post('/admin/user/store', 'UserController::store');
$routes->post('/admin/user/update/(:num)', 'UserController::update/$1');
$routes->post('/admin/user/delete/(:num)', 'UserController::destroy/$1');

$routes->get('/admin/airlineuser', 'AirlineUserController::index');
$routes->post('/admin/airlineuser/store', 'AirlineUserController::store');
$routes->post('/admin/airlineuser/update/(:num)', 'AirlineUserController::update/$1');
$routes->post('/admin/airlineuser/delete/(:num)', 'AirlineUserController::destroy/$1');

$routes->get('/admin/airline', 'AirlineController::index');
$routes->post('/admin/airline/store', 'AirlineController::store');
$routes->post('/admin/airline/update/(:num)', 'AirlineController::update/$1');
$routes->post('/admin/airline/delete/(:num)', 'AirlineController::destroy/$1');

$routes->get('/admin/aircraft', 'AircraftController::index');
$routes->post('/admin/aircraft/store', 'AircraftController::store');
$routes->post('/admin/aircraft/update/(:num)', 'AircraftController::update/$1');
$routes->post('/admin/aircraft/delete/(:num)', 'AircraftController::destroy/$1');

$routes->get('/admin/airport', 'AirportController::index');
$routes->post('/admin/airport/store', 'AirportController::store');
$routes->post('/admin/airport/update/(:num)', 'AirportController::update/$1');
$routes->post('/admin/airport/delete/(:num)', 'AirportController::destroy/$1');

$routes->get('/admin/flightroute', 'FlightRouteController::index');
$routes->post('/admin/flightroute/store', 'FlightRouteController::store');
$routes->post('/admin/flightroute/update/(:num)', 'FlightRouteController::update/$1');
$routes->post('/admin/flightroute/delete/(:num)', 'FlightRouteController::destroy/$1');

$routes->get('/admin/flightschedule/(:num)', 'FlightScheduleController::index/$1');
$routes->post('/admin/flightschedule/store', 'FlightScheduleController::store');
$routes->post('/admin/flightschedule/update/(:num)', 'FlightScheduleController::update/$1');
$routes->post('/admin/flightschedule/delete/(:num)', 'FlightScheduleController::destroy/$1');

$routes->get('/admin/seat/(:num)', 'SeatController::index/$1');

$routes->get('/airline/flightroute', 'FlightRouteController::index');
$routes->post('/airline/flightroute/store', 'FlightRouteController::store');
$routes->post('/airline/flightroute/update/(:num)', 'FlightRouteController::update/$1');
$routes->post('/airline/flightroute/delete/(:num)', 'FlightRouteController::destroy/$1');

$routes->get('/airline/flightschedule/(:num)', 'FlightScheduleController::index/$1');
$routes->post('/airline/flightschedule/store', 'FlightScheduleController::store');
$routes->post('/airline/flightschedule/update/(:num)', 'FlightScheduleController::update/$1');
$routes->post('/airline/flightschedule/delete/(:num)', 'FlightScheduleController::destroy/$1');

$routes->get('/airline/seat/(:num)', 'SeatController::index/$1');


