<?php

$routes = array(
    'login' => array('controller' => 'loginController', 'action' => 'index'),
    'manager' => array('controller' => 'loginController', 'action' => 'manager'),
    'newUser' => array('controller' => 'loginController', 'action' => 'new'),
    'authenticate' => array('controller' => 'loginController', 'action' => 'authenticate'),
    'addUser' => array('controller' => 'loginController', 'action' => 'add'),
    'removeuser' => array('controller' => 'loginController', 'action' => 'remove'),
    'gallery' => array('controller' => 'galleryStoreController', 'action' => 'index'),
    'addimage' => array('controller' => 'galleryStoreController', 'action' => 'add'),
    'removeimage' => array('controller' => 'galleryStoreController', 'action' => 'remove'),
    'logout' => array('controller' => 'loginController', 'action' => 'logout')
);

function route(array $routes) {
    $route = isset($_GET['route']) ? $_GET['route'] : 'login';

    if (array_key_exists($route, $routes)) {
        $controllerName = $routes[$route]['controller'];
        $actionName = $routes[$route]['action'];

        require_once 'app/controllers/' . $controllerName . '.php';

        $controller = new $controllerName();
        $controller->$actionName();
    } else {
        header('Location: ?route=login');
        exit;
    }
}
