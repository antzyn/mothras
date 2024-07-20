<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('generate-qris', 'QrisController::generateQris');
$routes->post('generate', 'Home::generate');
$routes->post('send-request', 'QrisController::sendRequest');
