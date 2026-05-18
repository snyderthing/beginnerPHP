<?php

function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require base_path($routes[$uri]);
    } else {
        abort();
    }
}


function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

$routes = require base_path('routes.php');
// Why is the above line at the top of the code page when the PHP Autoloading and Extraction video shows it at the bottom?
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
routeToController($uri, $routes);