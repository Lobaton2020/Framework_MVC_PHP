<?php

class AuthController extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->authentication("SECONDARY");
    }

    public function index()
    {
        echo "Hola Mundo!";
        echo "<a href=" . route("auth/login") . ">Iniciar Session</a>";
    }

    public function login()
    {
        // simulacion de loggueo
        // en esta funcion se ponen las credenciales
        $this->setSession(["dato1" => "valor1", "dato2" => "valor2"]);
        $this->redirect("main");
    }
}
