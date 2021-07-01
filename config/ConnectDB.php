<?php

class ConnectDB
{
    private static $instance = null;
    private $con;

    public function __construct()
    {
        global $db_conf;
        $this->con = new PDO("mysql:host={$db_conf['host']};
        dbname={$db_conf['name']}", $db_conf['user'], $db_conf['pass'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new ConnectDB();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->con;
    }
}