<?php


class AdminUser
{
    private $id;
    private $username;
    private $password;
    private $privileges;

    public function __construct($username, $password, $privileges, $id = 0)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->privileges = $privileges;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPrivileges()
    {
        return $this->privileges;
    }

    public function setPrivileges($privileges)
    {
        $this->privileges = $privileges;
    }

    public static function passCrypt($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function passVerify($password, $hash) {
        return password_verify($password, $hash);
    }

    public static function selectOne($id) {
        return AdminUserRepository::getInstance()->selectOneClass($id);
    }

    public static function selectAll() {
        return AdminUserRepository::getInstance()->selectAllClass();
    }
}