import sys
with open('app/Config/Routes.php', 'r') as f:
    content = f.read()

target = ");"

addition = """
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

$routes->group('user', static function($routes) {
    $routes->get('/', 'User::index');
    $routes->get('demander', 'User::demander');
    $routes->post('store', 'User::store');
});

$routes->group('rh', static function($routes) {
    $routes->get('/', 'Rh::index');
    $routes->post('traiter/(:num)', 'Rh::traiter/$1');
});
"""

# Append routes accurately at the end
with open('app/Config/Routes.php', 'a') as f:
    f.write(addition)

print("Done appending routes.")
