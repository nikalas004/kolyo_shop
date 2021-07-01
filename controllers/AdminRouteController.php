<?php

class AdminRouteController
{
    public $sm;

    public function __construct($sm)
    {
        $this->sm = $sm;
    }

    public function login($params) {
        $this->sm->assign('kolyo', 'kolyo');
        echo 'login';
    }
}