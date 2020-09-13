<?php

class MainController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->authentication();
    }

    public function index()
    {
        echo "Bienvenid@ A este Framework";
        echo "<a href=" . route("main/closeSession") . ">Cerrar Session</a>";
    }

    public function closeSession()
    {
        $this->destroySession();
        $this->redirect("auth");
    }
}
