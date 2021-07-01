<?php

error_reporting(E_ALL & ~E_NOTICE);
session_start();
require_once 'autoload.php';

$url = $_SERVER['REQUEST_URI'];
$url = explode('/', str_replace('/' . $conf['site_name'] . '/', '', $url));
if(end($url) == '') {
    array_pop($url);
}

if($url[0] == 'admin') {
    $route = new AdminRouteController($smarty);
    array_shift($url);

    if(empty($url)) {
        $url[0] = $conf['default_admin_page'];
    }
} else {
    $route = new RouteController();

    if(empty($url)) {
        $url[0] = $conf['default_page'];
    }
}

if($url[0] == 'request') {
    $target = $_REQUEST['target'] . 'Controller';
    $action = $_REQUEST['action'];

    $contrl = new $target();
    $contrl->$action($_REQUEST);
} else {
    $method = $url[0];
    $route->$method($_GET);
}
