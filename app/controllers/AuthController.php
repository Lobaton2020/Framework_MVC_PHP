<?php

class AuthControlLer extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $path = route("auth/login");
        echo "<a href='{$path}'>Iniciar sesion</a>";
    }

    public function login()
    {
        $_SESSION["credentials"] = [
            "id" => 1
        ];
        redirect("main");
    }
}
