<?php

$conf = [];

// site info
$conf['site_name']      = 'shop';
$conf['site']           = 'localhost/shop';
$conf['site_url']       = 'http://' . $conf['site'] . '/';
$conf['admin_url']      = $conf['site_url'] . 'admin/';
$conf['default_page']   = 'home';
$conf['default_admin_page']   = 'login';

// paths
$conf['site_path']      = getcwd() . '/';
$conf['js_path']        = $conf['site_path'] . 'js/';
$conf['css_path']       = $conf['site_path'] . 'static/css/';
$conf['images_path']    = $conf['site_path'] . 'static/images/';