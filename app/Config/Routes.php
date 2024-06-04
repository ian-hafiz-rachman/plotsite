<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/register', 'Auth::register');
$routes->post('/registerSave', 'Auth::registerSave');
$routes->get('/login', 'Auth::login');
$routes->post('/loginAuth', 'Auth::loginAuth');
$routes->get('/logout', 'Auth::logout');
$routes->get('/films', 'Film::index');
$routes->get('/films/detail/(:num)', 'Film::detail/$1');
$routes->get('/film/add', 'Film::add'); // route for adding film form
$routes->post('/film/store', 'Film::store'); // route for storing film data
$routes->get('/film/edit/(:num)', 'Film::edit/$1');
$routes->put('/film/update/(:num)', 'Film::update/$1'); // route for updating film data
$routes->get('/film/delete/(:num)', 'Film::delete/$1');
$routes->get('/image', 'ImageController::index');
$routes->post('/image/upload', 'ImageController::upload');
$routes->post('/films/like/(:num)', 'Film::like/$1');
$routes->post('/films/dislike/(:num)', 'Film::dislike/$1');
$routes->post('/films/rate/(:num)', 'Film::rate/$1');
$routes->post('/films/trailer/save', 'Film::saveTrailer');
$routes->get('/films/gettrailer/(:num)', 'Film::getTrailer/$1');
