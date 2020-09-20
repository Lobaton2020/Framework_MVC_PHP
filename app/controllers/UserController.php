<?php
class UserController extends Controller
{
    public function __construct()
    {
        $this->autentication();
    }
    public function index()
    {
        echo "User index";
    }

    public function saludo()
    {
        echo "Hello";
    }
}
