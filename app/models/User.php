<?php
// modelo de ejemplo
class User extends Orm
{
    public function __construct()
    {
        parent::__construct("users");
    }
}
