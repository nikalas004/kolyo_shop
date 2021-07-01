<?php

require_once 'libs/smarty-master/libs/Smarty.class.php';
require_once 'config/db_conf.php';
require_once 'config/conf.php';
require_once 'config/smarty_conf.php';

spl_autoload_register(function ($class_name) {
    if($class_name == 'ConnectDB') {
        require_once 'config/ConnectDB.php';
    } elseif(substr($class_name, -10) == 'Repository') {
        require_once 'repositories/' . $class_name . '.php';
    } elseif(substr($class_name, -10) == 'Controller') {
        require_once 'controllers/' . $class_name . '.php';
    }else {
        require_once 'models/' . $class_name . '.php';
    }
});

