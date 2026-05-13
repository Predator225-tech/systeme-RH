<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Routes Admin
$routes->group('admin', static function ($routes) {
    // Dashboard
    $routes->get('/', 'Admin::index');

    // Employés
    $routes->get('employes', 'Admin::employes');
    $routes->get('employes/create', 'Admin::createEmploye');
    $routes->post('employes/store', 'Admin::storeEmploye');
    $routes->get('employes/edit/(:num)', 'Admin::editEmploye/$1');
    $routes->post('employes/update/(:num)', 'Admin::updateEmploye/$1');
    $routes->get('employes/delete/(:num)', 'Admin::deleteEmploye/$1');

    // Départements
    $routes->get('departements', 'Admin::departements');
    $routes->get('departements/create', 'Admin::createDepartement');
    $routes->post('departements/store', 'Admin::storeDepartement');
    $routes->get('departements/edit/(:num)', 'Admin::editDepartement/$1');
    $routes->post('departements/update/(:num)', 'Admin::updateDepartement/$1');
    $routes->get('departements/delete/(:num)', 'Admin::deleteDepartement/$1');

    // Types de congé (CRUD)
    $routes->get('types_conge', 'TypeConge::index');
    $routes->get('types_conge/create', 'TypeConge::create');
    $routes->post('types_conge/store', 'TypeConge::store');
    $routes->get('types_conge/edit/(:num)', 'TypeConge::edit/$1');
    $routes->post('types_conge/update/(:num)', 'TypeConge::update/$1');
    $routes->get('types_conge/delete/(:num)', 'TypeConge::delete/$1');
});
