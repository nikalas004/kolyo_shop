<?php


class AdminUserRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct('admin_user');
    }

    public function selectOneClass($id)
    {
        $one = $this->selectOne($id);

        return new AdminUser($one['username'], $one['password'], $one['privileges'], $one['id']);
    }
}